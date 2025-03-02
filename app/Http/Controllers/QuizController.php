<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\Grade;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weaklyQuizzes = Quiz::where('kind', 'اسبوعي')->get();
        $monthlyQuizzes = Quiz::where('kind', 'شهري')->get();
        $biannualQuizzes = Quiz::where('kind', 'نصف سنوي')->get();

        return view('quizzes.index', compact('weaklyQuizzes', 'monthlyQuizzes', 'biannualQuizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kind = $request->input('kind');

        $classes = AcademyClass::Where([
            'status' => 'active'
        ])->get();

        return view('quizzes.create', compact('classes', 'kind'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'academy_class_id' => 'required',
            'final_grade' => 'required',
            'date' => 'required',
            'kind' => 'required',
        ]);

        Quiz::create([
            'title' => $validatedData['title'],
            'academy_class_id' => $validatedData['academy_class_id'],
            'final_grade' => $validatedData['final_grade'],
            'date' => $validatedData['date'],
            'kind' => $validatedData['kind'],
        ]);

        $quiz = Quiz::latest()->first();
        $students = $quiz->academyClass->students;
        foreach ($students as $student) {
            Grade::create([
                'quiz_id' => $quiz->id,
                'student_id' => $student->id
            ]);
        }

        session()->flash('quiz_added', true);


        return redirect()->route('quizzes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        return view('quizzes.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $classes = AcademyClass::Where([
            'status' => 'active'
        ])->get();

        return view('quizzes.edit', compact('quiz', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'academy_class_id' => 'required',
            'final_grade' => 'required',
            'date' => 'required',
            'kind' => 'required',
        ]);

        $quiz->title = $validatedData['title'];
        $quiz->academy_class_id = $validatedData['academy_class_id'];
        $quiz->final_grade = $validatedData['final_grade'];
        $quiz->date = $validatedData['date'];
        $quiz->kind = $validatedData['kind'];

        $quiz->save();

        session()->flash('quiz_updated', true);


        return redirect()->route('quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        if ($quiz->grades()->exists()) {
            // If there are related grades, display a warning message
            session()->flash('delete_warning', true);

            // Redirect back to the quiz index page or any other appropriate page
            return redirect()->route('quizzes.index');
        }
        $quiz->delete();
        session()->flash('quiz_deleted', true);

        return redirect()->route('quizzes.index');
    }
}
