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

        // Ambil ID user yang sedang login
        $userId = Auth::id();
        $user = Auth::user();  // Untuk mengambil semua data pengguna
        $role = $user->role;  // Pastikan ada field 'role' dalam model User

        // Variabel yang akan diisi berdasarkan kebutuhan
        $classes = null;
        $groupedScores = null;

        // Jika ada competition_id, filter kelas berdasarkan competition_id
        if ($request->has('competition_id')) {
            if ($role == 'admin') {
                // Jika admin, tampilkan semua kelas sesuai competition_id
                $classes = Classes::where('competition_id', $request->competition_id)->get();
            } else if ($role == 'juri') {
                // Jika juri, tampilkan kelas hanya yang berkaitan dengan judge_id (user)
                $classes = Classes::whereHas('class_participants', function ($query) use ($userId) {
                    $query->where('judge_id', $userId); // Pastikan hanya kelas yang dihakimi oleh juri yang ditampilkan
                })
                    ->where('competition_id', $request->competition_id)
                    ->get();
            }
        }

        // Jika ada class_id, ambil data skor dan kelompokkan berdasarkan participant_id
        if ($request->has('class_id')) {
            $groupedScores = Score::with(['participant', 'class'])
                ->where('class_id', $request->class_id)
                ->get()
                ->groupBy(function ($item) {
                    return $item->participant_id; // Kelompokkan berdasarkan participant_id
                });
        }

        // Kembalikan view dengan data yang telah difilter
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

        // Ambil data berdasarkan participant_id dan class_id
        $scores = Score::where('participant_id', $id)
            ->where('class_id', $request->class_id)  // Pastikan class_id juga terisi
            ->with(['participant', 'class', 'criteria']) // Ambil relasi criteria
            ->get();

        // Cek apakah data ditemukan
        if ($scores->isEmpty()) {
            return redirect()->route('penilaian.index')->with('error', 'Tidak ada data penilaian untuk peserta ini di kelas ini.');
        }

        return view('pages.penilaian.edit', compact('scores'));
    }



    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
        ]);

        // Cari data score berdasarkan ID
        $score = Score::findOrFail($id);

        // Update nilai score
        $score->score = $request->score;
        $score->save();

        // Ambil class berdasarkan class_id dari score yang diupdate
        $class = Classes::find($score->class_id); // Ambil data class berdasarkan class_id

        // Jika class tidak ditemukan, beri respons error
        if (!$class) {
            return redirect()->route('penilaian.index')->with('error', 'Kelas tidak ditemukan.');
        }

        // Redirect kembali ke halaman penilaian dengan membawa query parameter
        return redirect()->route('penilaian.index', [
            'competition_id' => $class->competition_id,  // Ambil competition_id dari class
            'class_id' => $score->class_id,               // class_id dari score yang diupdate
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
