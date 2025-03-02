<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\Teacher;
use Carbon\Carbon;
use App\Models\Salary;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {

        $firstDurationTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => 'صباحي',
        ])->get();
        $secondDurationTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => "مسائي",
        ])->get();
        $archiveTeachers = Teacher::where([
            'is_archive' => 1,
        ])->get();


        return view('teachers.index', compact('firstDurationTeachers', 'secondDurationTeachers', 'archiveTeachers'));
    }

    public function create(Request $request)
    {
        $classDuration = $request->input('duration');

        $activeClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => $classDuration,
        ])->where('available_seats', '>', 0)->get();


        return view('teachers.create', compact('activeClasses', 'classDuration'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone_number' => ['required', 'string'],
            'education' => ['required', 'string'],
            'address' => ['required', 'string'],
            'hiring_date' => ['required', 'date'],
            'subject' => ['required'],
            'duration' => ['required'],
            'academy_class_id' => ['required', 'integer'],
            'salary' => ['required', 'numeric'],
        ]);

        Teacher::create([
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate'],
            'phone_number' => $validatedData['phone_number'],
            'education' => $validatedData['education'],
            'address' => $validatedData['address'],
            'hiring_date' => $validatedData['hiring_date'],
            'subject' => $validatedData['subject'],
            'duration' => $validatedData['duration'],
            'academy_class_id' => $validatedData['academy_class_id'],
            'salary' => $validatedData['salary'],
        ]);


        session()->flash('teacher_created', true);

        return redirect()->route('teachers.index');
    }


    public function show(Teacher $teacher)
    {
        $currentMonth = Carbon::now();
        $monthlyAbsence = $teacher->absences->filter(function ($absence) use ($currentMonth) {
            return Carbon::parse($absence->date)->month == $currentMonth->month;
        });

        $attendanceDaysNum = 0;
        $absenceDaysNum = 0;
        return view('teachers.show', compact('teacher', 'currentMonth', 'monthlyAbsence', 'attendanceDaysNum', 'absenceDaysNum'));
    }

    public function edit(Teacher $teacher)
    {
        $activeClasses = AcademyClass::where('status', 'active')->get();
        return view('teachers.edit', compact('teacher', 'activeClasses'));
    }

    public function update(Request $request, Teacher $teacher)
    {


        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone_number' => ['required', 'string'],
            'education' => ['required', 'string'],
            'address' => ['required', 'string'],
            'hiring_date' => ['required', 'date'],
            'subject' => ['required'],
            'duration' => ['required'],
            'academy_class_id' => ['required', 'integer'],
            'salary' => ['required', 'numeric'],
            'is_archive' => ['required', 'integer'],
        ]);



        $teacher->name = $validatedData['name'];
        $teacher->gender = $validatedData['gender'];
        $teacher->birthdate = $validatedData['birthdate'];
        $teacher->phone_number = $validatedData['phone_number'];
        $teacher->education = $validatedData['education'];
        $teacher->address = $validatedData['address'];
        $teacher->hiring_date = $validatedData['hiring_date'];
        $teacher->subject = $validatedData['subject'];
        $teacher->duration = $validatedData['duration'];
        $teacher->academy_class_id = $validatedData['academy_class_id'];
        $teacher->salary = $validatedData['salary'];
        $teacher->is_archive = $validatedData['is_archive'];

        $teacher->save();

        session()->flash('teacher_updated', true);

        return redirect()->route('teachers.index');

    }

    public function destroy(Teacher $teacher)
    {


        $teacher->delete();
        session()->flash('teacher_deleted', true);

        return redirect()->route('teachers.index');
    }

    public function absence()
    {
        // Logic to manage teacher absence
        return view('teachers.absence');
    }

    public function absenceHistory()
    {
        // Logic to show teacher absence history
        return view('teachers.absence-h');
    }



    public function createSalary(Teacher $teacher)
    {
        return view('teachers.salaries.create', compact('teacher'));
    }

    public function storeSalary(Request $request, Teacher $teacher) {

        // return $request->all();

        $request->validate([
            'base_salary' => 'required|integer|min:0',
            'bonus' => 'nullable|integer|min:0',
            'loan_amount' => 'nullable|integer|min:0',
            'deduction' => 'nullable|integer|min:0',
            'total_salary' => 'required|integer|min:0',
            'month' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Check if a salary record already exists for the teacher and the given month
        $exists = Salary::where('teacher_id', $teacher->id)
            ->where('month', $request->month)
            ->exists();

        if ($exists) {
            session()->flash('salary_duplicate', true);
            return back();
        }

        Salary::create([
            'teacher_id' => $teacher->id,
            'base_salary' => $request->base_salary,
            'bonus' => $request->bonus ?? 0,
            'loan_amount' => $request->loan_amount ?? 0,
            'deduction' => $request->deduction ?? 0,
            'total_salary' => $request->total_salary,
            'month' => $request->month,
            'status' => $request->status,
        ]);

        session()->flash('salary_addeded', true);

        return redirect()->route('teachers.show', $teacher->id);
    }



    public function editSalary(Teacher $teacher, Salary $salary)
{
    return view('teachers.salaries.edit', compact('teacher', 'salary'));
}

public function updateSalary(Request $request, Teacher $teacher, Salary $salary)
{
    $request->validate([
        'base_salary' => 'required|integer|min:0',
        'bonus' => 'required|integer|min:0',
        'loan_amount' => 'required|integer|min:0',
        'deduction' => 'required|integer|min:0',
        'total_salary' => 'required|integer|min:0',
        'month' => 'required|string',
        'status' => 'required|integer|in:0,1,2',
    ]);

    $salary->update([
        'base_salary' => $request->base_salary,
        'bonus' => $request->bonus,
        'loan_amount' => $request->loan_amount,
        'deduction' => $request->deduction,
        'total_salary' => $request->total_salary,
        'month' => $request->month,
        'status' => $request->status,
    ]);

    session()->flash('salary_updated', true);

    return redirect()->route('teachers.show', $teacher->id);
}
public function destroySalary(Teacher $teacher, Salary $salary)
{
    $salary->delete();

    session()->flash('salary_deleted', true);

    return redirect()->route('teachers.show', $teacher->id);
}


}
