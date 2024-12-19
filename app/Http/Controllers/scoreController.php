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

        // If competition_id is not selected, show the view with empty results
        if (!$competitionId) {
            return view('pages.score.index', [
                'competitions' => Competition::all(),
                'classes' => [],
                'criterias' => collect(),
                'results' => collect(),
            ]);
        }

        // Retrieve the classes based on selected competition_id
        $classes = Classes::where('competition_id', $competitionId)->get();

        // If class_id is not selected, display with empty results
        if (!$classId) {
            return view('pages.score.index', [
                'competitions' => Competition::all(),
                'classes' => $classes,
                'criterias' => collect(),
                'results' => collect(),
            ]);
        }

        // Retrieve criteria for the selected class
        $criterias = Criteria::whereHas('classes', function ($query) use ($classId) {
            $query->where('classes.id', $classId);
        })->get(); // This returns a collection

        // Retrieve scores and filter participants with "Active" status only
        $scores = Score::with(['participant', 'criteria'])
            ->where('class_id', $classId)
            ->whereIn('criteria_id', $criterias->pluck('id'))
            ->get();


        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada skor peserta untuk kelas ini.');
        }

        // Count number of judges
        $judgeCount = Class_Participants::where('class_id', $classId)->count();

        // Normalize scores per criteria
        $groupedScores = $scores->groupBy('criteria_id');
        $normalizedScores = [];

        foreach ($groupedScores as $criteriaId => $group) {
            // Filter hanya peserta dengan status 'Active'
            $filteredGroup = $group->filter(function ($score) {
                return $score->participant && $score->participant->status === 'Active';
            });

            // Hitung max dan min hanya dari peserta 'Active'
            $maxValue = $filteredGroup->max('score');
            $minValue = $filteredGroup->min('score');
            $criteriaType = $criterias->where('id', $criteriaId)->first()->type;

            foreach ($group as $score) {
                // Set score ke 0 jika peserta tidak 'Active'
                if (!$score->participant || $score->participant->status !== 'Active') {
                    $normalizedScores[$score->participant_id][$criteriaId] = 0;
                    continue;
                }

                // Gunakan skor dari peserta aktif
                $scoreValue = $score->score;
                if ($group->count() > 1) {
                    $averageScore = $group->where('participant_id', $score->participant_id)->avg('score');
                    $scoreValue = $averageScore;
                }

                // Normalisasi berdasarkan jenis kriteria
                $normalizedValue = ($criteriaType === 'benefit')
                    ? ($maxValue > 0 ? $scoreValue / $maxValue : 0)
                    : ($minValue > 0 ? $minValue / $scoreValue : 0);

                $normalizedScores[$score->participant_id][$criteriaId] = $normalizedValue;
            }
        }

        // Calculate final weighted scores
        $weightedScores = [];
        foreach ($normalizedScores as $participantId => $criteriaScores) {
            $total = 0;
            foreach ($criteriaScores as $criteriaId => $normalizedScore) {
                $weight = $criterias->where('id', $criteriaId)->first()->weight;
                $total += $normalizedScore * $weight;

                $weightedScores[$participantId]['scores'][$criteriaId] = $normalizedScore * $weight;
            }

            $weightedScores[$participantId]['total'] = $total;
            $weightedScores[$participantId]['participant'] = $scores->where('participant_id', $participantId)->first()->participant;
        }

        // Sort by total score descending and assign ranking
        $finalResults = collect($weightedScores)->sortByDesc('total')->values();
        $rank = 1;
        $finalResults = $finalResults->map(function ($result) use (&$rank) {
            $result['rank'] = $rank++;
            return $result;
        });

        return view('pages.score.index', [
            'criterias' => $criterias,
            'results' => $finalResults,
            'competitions' => Competition::all()->where('status', 'Berlangsung'),
            'classes' => $classes,
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
