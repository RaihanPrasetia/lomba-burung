<?php

namespace App\Http\Controllers;

use App\Models\Class_Criteria;
use App\Models\Class_Participants;
use App\Models\Classes;
use App\Models\ClassPeserta;
use App\Models\Competition;
use App\Models\Participant;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $competitionId = $request->input('competition_id');
        $classId = $request->input('class_id');

        $competitions = Competition::all();
        $classes = $competitionId
            ? Classes::where('competition_id', $competitionId)->get()
            : collect(); // Filter classes based on competition

        // Fetch the participants in the selected class if competition_id and class_id are chosen
        $classPesertas = collect(); // Default empty collection

        if ($competitionId && $classId) {
            // Get the participants for the selected class
            $classPesertas = ClassPeserta::with('participant')
                ->where('class_id', $classId)
                ->get();
        }

        return view('pages.peserta.index', [
            'competitions' => $competitions,
            'classes' => $classes,
            'classPesertas' => $classPesertas,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Handle POST submission to fetch related data
        $competitions = Competition::whereIn('status', ['Akan Datang', 'Berlangsung'])->get();
        $classes = [];

        if ($request->has('competition_id')) {
            $competitionId = $request->input('competition_id');
            $classes = Classes::where('competition_id', $competitionId)->get();
        }

        return view('pages.peserta.create', compact('competitions', 'classes'));
    }

    public function getClasses(Request $request)
    {
        $competitionId = $request->input('competition_id');

        $classes = Classes::where('competition_id', $competitionId)->get();

        return response()->json(['classes' => $classes]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bird_name' => 'required|string|max:255',
            'no_gantang' => 'required|numeric',
            'contact_info' => 'required|string',
            'class_id' => 'required|array|min:1', // Class is an array of selected classes
        ]);

        // Create participant record
        $participant = Participant::create([
            'name' => $validatedData['name'],
            'bird_name' => $validatedData['bird_name'],
            'no_gantang' => $validatedData['no_gantang'],
            'contact_info' => $validatedData['contact_info'],
            'status' => 'Active',
        ]);

        // Insert selected classes into ClassPeserta table
        foreach ($validatedData['class_id'] as $class_id) {
            // Create the relationship in ClassPeserta (participant and class link)
            $classPeserta = ClassPeserta::create([
                'class_id' => $class_id,
                'participant_id' => $participant->id,
            ]);

            // Get associated judges for the class from Class_Participants table
            $classParticipants = Class_Participants::where('class_id', $class_id)->get();

            // Get associated criteria for the class from Class_Criteria table
            $classCriteria = Class_Criteria::where('class_id', $class_id)->get();

            // Create score entries for each judge and criteria combination
            foreach ($classParticipants as $classParticipant) {
                foreach ($classCriteria as $classCriterion) {
                    // Create a score entry for each judge and criteria combination
                    Score::create([
                        'class_id' => $class_id,
                        'participant_id' => $participant->id,
                        'judge_id' => $classParticipant->judge_id, // Use the judge_id from Class_Participants
                        'criteria_id' => $classCriterion->criteria_id, // Use the criteria_id from Class_Criteria
                        'score' => 0, // Default score
                        'comments' => 'Not scored yet', // Default comment
                    ]);
                }
            }
        }

        // Redirect back to the peserta list or show a success message
        return redirect()->route('peserta.index')->with('success', 'Peserta created successfully!');
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
        $peserta = Participant::findOrFail($id);
        return view('pages.peserta.edit', compact('peserta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bird_name' => 'required|string',
            'no_gantang' => 'required|numeric|unique:participants,no_gantang',
            'contact_info' => 'required|string',
        ], [
            'no_gantang.unique' => 'Nomor gantang sudah terdaftar.',
        ]);

        // Menemukan data perlombaan berdasarkan ID dan memperbarui data
        $participant = Participant::findOrFail($id);
        $participant->update([
            'name' => $validated['name'],
            'bird_name' => $validated['bird_name'],
            'no_gantang' => $validated['no_gantang'],
            'contact_info' => $validated['contact_info'],
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
