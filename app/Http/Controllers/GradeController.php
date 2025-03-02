<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Quiz;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Quiz $quiz)
    {

        $quizId = $quiz->id;

        $thisQuizStudentsGrades = Grade::where([
            'quiz_id' => $quiz->id,
        ])->get();

        return view('grades.index', compact('thisQuizStudentsGrades', 'quizId'));
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
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {

        $thisQuizStudentsGrades = Grade::where([
            'quiz_id' => $quiz->id,
        ])->get();

        return view('grades.edit', compact('thisQuizStudentsGrades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the submitted data
        $validatedData = $request->validate([
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:0', // Ensure grades are numeric and non-negative
        ]);

        // Loop through the submitted grades and update them in the database
        foreach ($validatedData['grades'] as $id => $grade) {
            // Find the grade record
            $gradeRecord = Grade::find($id);

            if ($gradeRecord) {
                // Ensure the grade does not exceed the final grade
                if ($grade > $gradeRecord->quiz->final_grade) {
                    $grade = $gradeRecord->quiz->final_grade;
                }

                // Update the grade
                $gradeRecord->grade = $grade;
                $gradeRecord->save();
            }
        }

        session()->flash('grades_updated', true);

        return redirect()->route('grades.index', $request->input('quizId'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
