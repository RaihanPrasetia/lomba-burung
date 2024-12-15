<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Competition;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Class_;

class penilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua kompetisi dengan status Berlangsung
        $competitions = Competition::where('status', 'Berlangsung')->get();

        // Ambil ID user dan role user
        $userId = Auth::id();
        $user = Auth::user();
        $role = $user->role;

        // Variabel default
        $classes = null;
        $groupedScores = null;

        // Filter kelas berdasarkan competition_id
        if ($request->has('competition_id')) {
            if ($role === 'admin') {
                $classes = Classes::where('competition_id', $request->competition_id)->get();
            } else if ($role === 'juri') {
                $classes = Classes::whereHas('class_participants', function ($query) use ($userId) {
                    $query->where('judge_id', $userId);
                })->where('competition_id', $request->competition_id)->get();
            }
        }

        // Jika user adalah juri, hanya ambil skor yang berkaitan dengan judge_id
        if ($role === 'juri' && $request->has('class_id')) {
            $groupedScores = Score::with(['participant', 'class', 'judge'])
                ->where('class_id', $request->class_id)
                ->where('judge_id', $userId) // Hanya ambil skor dengan judge_id = userId
                ->get()
                ->groupBy('participant_id'); // Kelompokkan berdasarkan participant_id
        }

        // Kembalikan view
        return view('pages.penilaian.index', compact('competitions', 'classes', 'groupedScores'));
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
    public function edit(Request $request, $id)
    {
        // Pastikan class_id diterima melalui request
        if (!$request->has('class_id')) {
            return redirect()->route('penilaian.index')->with('error', 'Class ID tidak ditemukan.');
        }

        // Ambil data user yang sedang login
        $user = Auth::user();
        $role = $user->role;
        $userId = $user->id;

        // Query dasar untuk skor berdasarkan participant_id dan class_id
        $query = Score::where('participant_id', $id)
            ->where('class_id', $request->class_id)
            ->with(['participant', 'class', 'criteria', 'judge']); // Tambahkan relasi judge untuk admin

        // Jika role juri, tambahkan filter berdasarkan judge_id
        if ($role === 'juri') {
            $query->where('judge_id', $userId);
        }

        // Ambil data skor
        $scores = $query->get();

        // Cek apakah data ditemukan
        if ($scores->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Tidak ada data penilaian untuk peserta ini di kelas ini.');
        }

        // Jika admin, kelompokkan skor berdasarkan judge_id
        $groupedScores = ($role === 'admin')
            ? $scores->groupBy('judge_id')
            : null;

        // Kembalikan view sesuai role
        return view('pages.penilaian.edit', [
            'scores' => $scores,
            'groupedScores' => $groupedScores
        ]);
    }




    public function update(Request $request, $id)
    {
        // Validasi setiap skor berdasarkan ID yang diberikan dalam input
        $request->validate([
            'score' => 'required|array',    // score harus dalam array
            'score.*' => 'required|numeric|min:0|max:100', // nilai untuk setiap skor harus berupa angka
        ]);

        // Loop untuk update semua score berdasarkan ID dan data dari input
        foreach ($request->score as $scoreId => $newScore) {
            // Temukan masing-masing score berdasarkan ID
            $score = Score::findOrFail($scoreId);

            // Update nilai score
            $score->score = $newScore;
            $score->save();
        }

        // Ambil class berdasarkan class_id dari score yang diupdate
        $class = Classes::find($score->class_id); // Ambil data class berdasarkan class_id

        // Jika class tidak ditemukan, beri respons error
        if (!$class) {
            return redirect()->route('penilaian.index')->with('error', 'Kelas tidak ditemukan.');
        }

        // Redirect kembali ke halaman penilaian dengan membawa query parameter
        return redirect()->route('penilaian.index', [
            'competition_id' => $class->competition_id,  // Ambil competition_id dari class
            'class_id' => $class->id,               // class_id dari score yang diupdate
        ])->with('success', 'Penilaian berhasil diperbarui.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
