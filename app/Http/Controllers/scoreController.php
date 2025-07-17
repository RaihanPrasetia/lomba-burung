<?php

namespace App\Http\Controllers;

use App\Models\Class_Participants;
use App\Models\Classes;
use App\Models\Competition;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Http\Request;

class scoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $competitionId = $request->input('competition_id');
        $classId = $request->input('class_id');
        $judgeId = $request->input('judge_id');

        // If competition_id is not selected, show the view with empty results
        $competitions = Competition::where('status', 'Berlangsung')->get();
        $classes = collect();
        $judges = collect(); // Inisialisasi koleksi juri

        if ($competitionId) {
            $classes = Classes::where('competition_id', $competitionId)->get();
        }

        // Jika tidak ada competition_id atau class_id, kembalikan view dengan data dasar
        if (!$competitionId || !$classId) {
            return view('pages.score.index', [
                'competitions' => $competitions,
                'classes' => $classes,
                'judges' => $judges,
                'criterias' => collect(),
                'results' => collect(),
            ]);
        }

        $judgeIds = Score::where('class_id', $classId)->distinct()->pluck('judge_id');
        $judges = \App\Models\User::whereIn('id', $judgeIds)->get();

        // Retrieve criteria for the selected class
        $criterias = Criteria::whereHas('classes', function ($query) use ($classId) {
            $query->where('classes.id', $classId);
        })->get(); // This returns a collection

        // Retrieve scores and filter participants with "Active" status only
        $scoreQuery = Score::with(['participant', 'criteria'])
            ->where('class_id', $classId)
            ->whereIn('criteria_id', $criterias->pluck('id'))
            // Filter hanya peserta dengan status 'Active'
            ->whereHas('participant', function ($query) {
                $query->where('status', 'Active');
            });



        if ($judgeId && $judgeId !== 'all') {
            $scoreQuery->where('judge_id', $judgeId);
        }

        $scores = $scoreQuery->get();

        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data skor yang ditemukan untuk filter yang dipilih.');
        }

        // Count number of judges
        // $judgeCount = Class_Participants::where('class_id', $classId)->count();

        // Normalize scores per criteria
        $groupedScores = $scores->groupBy('criteria_id');
        $normalizedScores = [];

        foreach ($groupedScores as $criteriaId => $criteriaScores) {
            $maxValue = $criteriaScores->max('score');
            $minValue = $criteriaScores->min('score');
            $criteria = $criterias->firstWhere('id', $criteriaId);

            // Agregasi skor per peserta untuk kriteria ini
            $participantScores = $criteriaScores->groupBy('participant_id');

            foreach ($participantScores as $participantId => $pScores) {
                $scoreValue = $pScores->avg('score'); // Rata-rata skor dari juri yang relevan

                if ($criteria->type === 'benefit') {
                    $normalizedValue = ($maxValue > 0) ? ($scoreValue / $maxValue) : 0;
                } else { // 'cost'
                    $normalizedValue = ($scoreValue > 0) ? ($minValue / $scoreValue) : 0;
                }
                $normalizedScores[$participantId][$criteriaId] = $normalizedValue;
            }
        }

        // foreach ($groupedScores as $criteriaId => $group) {
        //     // Filter hanya peserta dengan status 'Active'
        //     $filteredGroup = $group->filter(function ($score) {
        //         return $score->participant && $score->participant->status === 'Active';
        //     });

        //     // Hitung max dan min hanya dari peserta 'Active'
        //     $maxValue = $filteredGroup->max('score');
        //     $minValue = $filteredGroup->min('score');
        //     $criteriaType = $criterias->where('id', $criteriaId)->first()->type;

        //     foreach ($group as $score) {
        //         // Set score ke 0 jika peserta tidak 'Active'
        //         if (!$score->participant || $score->participant->status !== 'Active') {
        //             $normalizedScores[$score->participant_id][$criteriaId] = 0;
        //             continue;
        //         }

        //         // Gunakan skor dari peserta aktif
        //         $scoreValue = $score->score;
        //         if ($group->count() > 1) {
        //             $averageScore = $group->where('participant_id', $score->participant_id)->avg('score');
        //             $scoreValue = $averageScore;
        //         }

        //         // Normalisasi berdasarkan jenis kriteria
        //         $normalizedValue = ($criteriaType === 'benefit')
        //             ? ($maxValue > 0 ? $scoreValue / $maxValue : 0)
        //             : ($minValue > 0 ? $minValue / $scoreValue : 0);

        //         $normalizedScores[$score->participant_id][$criteriaId] = $normalizedValue;
        //     }
        // }

        // Calculate final weighted scores
        $weightedScores = [];


        $weightedScores = [];
        $participants = $scores->pluck('participant')->unique('id');

        // foreach ($normalizedScores as $participantId => $criteriaScores) {
        //     $total = 0;
        //     foreach ($criteriaScores as $criteriaId => $normalizedScore) {
        //         $weight = $criterias->where('id', $criteriaId)->first()->weight;
        //         $total += $normalizedScore * $weight;

        //         $weightedScores[$participantId]['scores'][$criteriaId] = $normalizedScore * $weight;
        //     }

        //     $weightedScores[$participantId]['total'] = $total;
        //     $weightedScores[$participantId]['participant'] = $scores->where('participant_id', $participantId)->first()->participant;
        // }

        // Sort by total score descending and assign ranking
        $finalResults = collect($weightedScores)->sortByDesc('total')->values();
        // $rank = 1;
        // $finalResults = $finalResults->map(function ($result) use (&$rank) {
        //     $result['rank'] = $rank++;
        //     return $result;
        // });

        foreach ($participants as $participant) {
            if (!isset($normalizedScores[$participant->id])) continue;

            $total = 0;
            $weightedScores[$participant->id]['scores'] = [];
            foreach ($criterias as $criteria) {
                $normalizedScore = $normalizedScores[$participant->id][$criteria->id] ?? 0;
                $weightedScore = $normalizedScore * $criteria->weight;
                $total += $weightedScore;
                $weightedScores[$participant->id]['scores'][$criteria->id] = $weightedScore;
            }

            $weightedScores[$participant->id]['total'] = $total;
            $weightedScores[$participant->id]['participant'] = $participant;
        }

        // Urutkan hasil
        $finalResults = collect($weightedScores)->sortByDesc('total')->values()->map(function ($result, $key) {
            $result['rank'] = $key + 1;
            return $result;
        });


        return view('pages.score.index', [
            'criterias' => $criterias,
            'results' => $finalResults,
            'competitions' => $competitions,
            'classes' => $classes,
            'judges' => $judges, // 4. Kirim data juri ke view
        ]);
    }








    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
