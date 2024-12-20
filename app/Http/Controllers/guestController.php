<?php

namespace App\Http\Controllers;

use App\Models\Class_Participants;
use App\Models\Classes;
use App\Models\Competition;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Http\Request;

class guestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function rank(Request $request)
    {
        $competitionId = $request->input('competition_id');
        $classId = $request->input('class_id');

        // If competition_id is not selected, show the view with empty results
        if (!$competitionId) {
            return view('pages.user.rankTable', [
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
            return view('pages.user.rankTable', [
                'competitions' => Competition::all(),
                'classes' => $classes,
                'criterias' => collect(),
                'results' => collect(),
            ]);
        }

        // If competition_id and class_id are selected, proceed with the calculation
        $criterias = Criteria::whereHas('classes', function ($query) use ($classId) {
            $query->where('classes.id', $classId);
        })->get(); // This returns a collection

        // Ambil data skor peserta berdasarkan class_id dan criteria_id
        $scores = Score::with(['participant', 'criteria'])
            ->where('class_id', $classId)
            ->whereIn('criteria_id', $criterias->pluck('id'))
            ->get(); // This returns a collection

        if ($scores->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada skor peserta untuk kelas ini.');
        }

        // Hitung jumlah juri pada kelas tersebut
        $judgeCount = Class_Participants::where('class_id', $classId)->count();

        // Normalisasi nilai per kriteria
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


        // Hitung nilai akhir berdasarkan bobot
        $weightedScores = [];
        foreach ($normalizedScores as $participantId => $criteriaScores) {
            $total = 0;
            foreach ($criteriaScores as $criteriaId => $normalizedScore) {
                $weight = $criterias->where('id', $criteriaId)->first()->weight;
                $total += $normalizedScore * $weight;

                // Simpan nilai kriteria ter-normalisasi dengan bobot
                $weightedScores[$participantId]['scores'][$criteriaId] = $normalizedScore * $weight;
            }

            // Simpan total nilai
            $weightedScores[$participantId]['total'] = $total;
            $weightedScores[$participantId]['participant'] = $scores->where('participant_id', $participantId)->first()->participant;
        }

        // Urutkan berdasarkan total nilai secara descending dan tambahkan ranking
        $finalResults = collect($weightedScores)->sortByDesc('total')->values();
        $rank = 1;
        $finalResults = $finalResults->map(function ($result) use (&$rank) {
            $result['rank'] = $rank++;
            return $result;
        });

        return view('pages.user.rankTable', [
            'criterias' => $criterias,
            'results' => $finalResults,
            'competitions' => Competition::all(),
            'classes' => $classes,
        ]);
    }

    public function index()
    {
        $competitions = Competition::all()->where('status', 'Akan Datang');
        return view('pages.user.index', compact('competitions'));
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
