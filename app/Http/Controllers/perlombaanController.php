<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerlombaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competitions = Competition::all();
        return view('pages.perlombaan.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.perlombaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'pdf_link' => 'required|url',
            'status' => 'required|in:Akan Datang,Berlangsung,Selesai',
        ]);

        // Menyimpan data ke dalam database
        Competition::create([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'pdf_link' => $validated['pdf_link'],
            'status' => $validated['status'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('perlombaan.index')->with('success', 'Perlombaan berhasil dibuat.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $competition = Competition::findOrFail($id);
        return view('pages.perlombaan.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $competition = Competition::findOrFail($id);
        return view('pages.perlombaan.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'pdf_link' => 'required|url',
            'status' => 'required|in:Selesai,Berlangsung,Akan Datang',
            'date' => 'required|date',
        ]);

        // Menemukan data perlombaan berdasarkan ID dan memperbarui data
        $competition = Competition::findOrFail($id);
        $competition->update([
            'name' => $validated['name'],
            'pdf_link' => $validated['pdf_link'],
            'status' => $validated['status'],
            'date' => $validated['date'],
        ]);

        return redirect()->route('perlombaan.index')->with('success', 'Perlombaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menemukan dan menghapus perlombaan berdasarkan ID
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('perlombaan.index')->with('success', 'Perlombaan berhasil dihapus.');
    }
}
