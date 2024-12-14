<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class scoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data score dengan relasi participant dan class
        $scores = Score::with(['participant', 'class'])
            ->get();

        // Kelompokkan berdasarkan class_id
        $groupedScores = $scores->groupBy(function ($item) {
            return $item->class->name; // Misalnya, berdasarkan nama kelas (atau field lain)
        });

        return view('pages.score.index', compact('groupedScores'));
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
