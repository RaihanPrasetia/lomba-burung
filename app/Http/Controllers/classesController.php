<?php

namespace App\Http\Controllers;

use App\Models\Class_Participants;
use App\Models\Classes;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Http\Request;

class classesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data kelas beserta partisipan dan kompetisi
        $classes = Classes::with(['class_participants.judge', 'competition'])->get();

        // Kelompokkan berdasarkan 'class_id'
        $groupedClasses = $classes->groupBy('id');

        return view('pages.classes.index', compact('groupedClasses'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $competitions = Competition::where('status', 'Akan Datang')->get();
        $judges = User::where('role', 'juri')->get();
        return view('pages.classes.create', compact('competitions', 'judges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'competition_id' => 'required|integer',
            'judge_id' => 'required|array', // Validasi array juri
            'judge_id.*' => 'integer|exists:users,id', // Setiap judge_id harus valid
        ]);

        // Menyimpan data kelas ke dalam database
        $newClass = Classes::create([
            'name' => $validated['name'],
            'competition_id' => $validated['competition_id'],
        ]);

        // Menyimpan data peserta kelas (juri)
        foreach ($validated['judge_id'] as $judgeId) {
            Class_Participants::create([
                'class_id' => $newClass->id,
                'judge_id' => $judgeId,
                'participants_id' => null,  // Tidak ada peserta untuk saat ini
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('class.index')->with('success', 'Perlombaan berhasil dibuat.');
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
    public function edit($id)
    {
        // Ambil kelas, juri, dan perlombaan berdasarkan ID kelas
        $class = Classes::with(['class_participants.judge', 'competition'])->findOrFail($id);
        $competitions = Competition::all(); // Ambil semua kompetisi
        $judges = User::where('role', 'juri')->get(); // Ambil semua juri

        return view('pages.classes.edit', compact('class', 'competitions', 'judges'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'competition_id' => 'required|integer',
            'judge_id' => 'required|array',  // Pastikan judge_id adalah array
            'judge_id.*' => 'integer', // Setiap elemen dalam judge_id harus berupa integer
        ]);

        // Ambil kelas yang akan diperbarui
        $class = Classes::findOrFail($id);

        // Perbarui data kelas
        $class->name = $validated['name'];
        $class->competition_id = $validated['competition_id'];
        $class->save(); // Simpan perubahan kelas

        // Hapus partisipan lama (juri yang terkait dengan kelas ini)
        Class_Participants::where('class_id', $id)->delete();

        // Simpan juri baru
        foreach ($validated['judge_id'] as $judgeId) {
            Class_Participants::create([
                'class_id' => $class->id,
                'judge_id' => $judgeId,
                'participant_id' => null, // Karena tidak ada partisipan yang terlibat
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('class.index')->with('success', 'Class berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classes = Classes::findOrFail($id);
        $classes->delete();

        return redirect()->route('class.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
