<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data criteria
        $criterias = Criteria::all();
        return view('pages.criteria.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengembalikan view untuk form tambah kriteria
        return view('pages.criteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:100', // Mendukung float dalam rentang 0-100
            'type' => 'required|in:benefit,cost', // Tambahkan pilihan sesuai kebutuhan
        ]);


        // Simpan data ke database
        Criteria::create($request->only(['name', 'weight', 'type']));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('criteria.index')->with('success', 'Criteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mendapatkan detail criteria berdasarkan id
        $criteria = Criteria::findOrFail($id);

        return view('pages.criteria.show', compact('criteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data kriteria berdasarkan ID
        $criteria = Criteria::findOrFail($id);

        // Kirim data ke view edit
        return view('pages.criteria.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0|max:100',
            'type' => 'required|in:benefit,cost',
        ]);

        // Temukan criteria berdasarkan ID dan perbarui
        $criteria = Criteria::findOrFail($id);
        $criteria->update($request->only(['name', 'weight', 'type']));

        // Redirect dengan pesan sukses
        return redirect()->route('criteria.index')->with('success', 'Criteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan dan hapus data berdasarkan ID
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('criteria.index')->with('success', 'Criteria berhasil dihapus.');
    }
}
