<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\Driver;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\StudentAbsence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class studentController extends Controller
{


    public function index()
    {
        $firstDurationStudents = Student::where([
            'is_archive' => 0,
            'duration' => 'صباحي',
        ])->get();
        $secondDurationStudents = Student::where([
            'is_archive' => 0,
            'duration' => "مسائي",
        ])->get();
        $archiveStudents = Student::where([
            'is_archive' => 1,
        ])->get();

        return view('students.index', compact('firstDurationStudents', 'secondDurationStudents', 'archiveStudents'));
    }



    public function create(Request $request)
    {
        $classDuration = $request->input('duration');


        $activeClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => $classDuration,
        ])->where('available_seats', '>', 0)->get();

        $availableDrivers = Driver::where([
            ['available_seats', '>', 0],
        ])->get();


        return view('students.create', compact('activeClasses', 'classDuration', 'availableDrivers'));
    }



    public function store(Request $request)
    {



        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'father_phone' => ['required'],
            'alt_father_phone' => ['nullable'],
            'address' => ['required', 'string'],
            'submission_date' => ['required', 'date'],
            'duration' => ['string'],
            'academy_class_id' => ['required'],
            'driver_id' => ['nullable'],
            'pricing_plan' => ['required', 'string'],
        ]);



        if (!$validatedData['driver_id'] === null) {
            $driver = Driver::find($validatedData['driver_id']);
            $driver->available_seats--;
            $driver->taken_seats++;
            $driver->save();
        }

        $selectedClass = AcademyClass::find($validatedData['academy_class_id']);
        $selectedClass->taken_seats = $selectedClass->taken_seats + 1;
        $selectedClass->available_seats = $selectedClass->available_seats - 1;

        $selectedClass->save();

        Student::create([
            'name' => $validatedData['name'],
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate'],
            'father_phone' => $validatedData['father_phone'],
            'alt_father_phone' => $validatedData['alt_father_phone'],
            'address' => $validatedData['address'],
            'submission_date' => $validatedData['submission_date'],
            'duration' => $validatedData['duration'],
            'academy_class_id' => $validatedData['academy_class_id'],
            'driver_id' => $validatedData['driver_id'],
            'pricing_plan' => $validatedData['pricing_plan'],
        ]);
        session()->flash('student_created', true);

        return redirect()->route('students.index');
    }



    public function show(Student $student)
    {
        $currentMonth = Carbon::now();
        $monthlyAbsence = $student->absences->filter(function ($absence) use ($currentMonth) {
            return Carbon::parse($absence->date)->month == $currentMonth->month;
        });

        $attendanceDaysNum = 0;
        $absenceDaysNum = 0;

        $grades = $student->grades;


        return view('students.show', compact('student', 'currentMonth', 'monthlyAbsence', 'attendanceDaysNum', 'absenceDaysNum', 'grades'));
    }



    public function edit(Student $student)
    {
        $activeClasses = AcademyClass::where([
            'status' => 'active',
        ])->where('available_seats', '>', 0)->get();


        $availableDrivers = Driver::where([
            ['available_seats', '>', 0],
        ])->get();


        return view('students.edit', compact('student', 'activeClasses', 'availableDrivers'));

    }



    public function update(Request $request, $student)
    {
        $currentStudent = Student::find($student);



        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'father_phone' => ['required', 'numeric'],
            'alt_father_phone' => ['nullable'],
            'address' => ['required', 'string'],
            'submission_date' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'academy_class_id' => ['required', 'integer'],
            'driver_id' => ['required', 'string'],
            'pricing_plan' => ['required', 'string'],
            'is_archive' => ['required', 'integer'],
        ]);

        // @dd($validatedData);

        if($validatedData['driver_id'] != $currentStudent->driver_id){


            if($currentStudent->driver_id != null){
                $oldDriver = Driver::find($currentStudent->driver_id);
                $oldDriver->available_seats = $oldDriver->available_seats + 1;
                $oldDriver->taken_seats = $oldDriver->taken_seats - 1;
                $oldDriver->save();
            }


            $validatedData['driver_id'] = $validatedData['driver_id'] == 'null' ? null : $validatedData['driver_id'];

            if($validatedData['driver_id'] != null){
                $newDriver = Driver::find($validatedData['driver_id']);
                $newDriver->available_seats = $newDriver->available_seats - 1;
                $newDriver->taken_seats = $newDriver->taken_seats + 1;
                $newDriver->save();
            }

        }

        if($validatedData['academy_class_id'] != $currentStudent->academy_class_id){

            $oldClass = AcademyClass::find($currentStudent->academy_class_id);
            $oldClass->available_seats = $oldClass->available_seats + 1;
            $oldClass->taken_seats = $oldClass->taken_seats - 1;
            $oldClass->save();



            $newClass = AcademyClass::find($validatedData['academy_class_id']);
            $newClass->available_seats = $newClass->available_seats - 1;
            $newClass->taken_seats = $newClass->taken_seats + 1;
            $newClass->save();
        }

        if($validatedData['is_archive'] != $currentStudent->is_archive){
            if($validatedData['is_archive']){
                $currentStudent->academyClass()->update([
                    'available_seats' => $currentStudent->academyClass->available_seats + 1,
                    'taken_seats' => $currentStudent->academyClass->taken_seats - 1
                ]);
            } else {
                $currentStudent->academyClass()->update([
                    'available_seats' => $currentStudent->academyClass->available_seats - 1,
                    'taken_seats' => $currentStudent->academyClass->taken_seats + 1,
                ]);
            }
        }

        $currentStudent->name = $validatedData['name'];
        $currentStudent->gender = $validatedData['gender'];
        $currentStudent->birthdate = $validatedData['birthdate'];
        $currentStudent->father_phone = $validatedData['father_phone'];
        $currentStudent->alt_father_phone = $validatedData['alt_father_phone'];
        $currentStudent->address = $validatedData['address'];
        $currentStudent->submission_date = $validatedData['submission_date'];
        $currentStudent->duration = $validatedData['duration'];
        $currentStudent->academy_class_id = $validatedData['academy_class_id'];
        $currentStudent->driver_id = $validatedData['driver_id'];
        $currentStudent->pricing_plan = $validatedData['pricing_plan'];
        $currentStudent->is_archive = $validatedData['is_archive'];

        $currentStudent->save();

        session()->flash('student_updated', true);

        return redirect()->route('students.index');
    }


    public function destroy(Student $student)
    {

        $studentClass = $student->academyClass;

        $studentClass->available_seats = $studentClass->available_seats + 1;
        $studentClass->taken_seats = $studentClass->taken_seats - 1;

        $studentClass->save();



        $student->delete();
        session()->flash('student_deleted', true);

        return redirect()->route('students.index');
    }


    public function createInvoice(Student $student)
    {
        $studentId = $student->id;
        return view('students.invoices.create', compact('studentId' ));
    }

    public function storeInvoice(Student $student)
    {
        // protected $fillable = ['student_id', 'term', 'kind', 'bus_subscription', 'uniform_subscription', 'discount', 'amount', 'status'];

        $validatedData = request()->validate([
            'term' => ['required', 'string'],
            'kind' => ['required', 'string'],
            'bus_subscription' => ['required', 'integer'],
            'uniform_subscription' => ['required', 'integer'],
            'discount' => ['required', 'integer'],
            'main_subscription' => ['required', 'integer'],
        ]);

        Invoice::create([
            'student_id' => $student->id,
            'term' => $validatedData['term'],
            'kind' => $validatedData['kind'],
            'bus_subscription' => $validatedData['bus_subscription'],
            'uniform_subscription' => $validatedData['uniform_subscription'],
            'discount' => $validatedData['discount'],
            'main_subscription' => $validatedData['main_subscription'],
            'total_amount' => ($validatedData['bus_subscription'] + $validatedData['uniform_subscription'] + $validatedData['main_subscription'] - $validatedData['discount']) ,
            'paied_amount' => '0',
            'remaining_amount' => ($validatedData['bus_subscription'] + $validatedData['uniform_subscription'] + $validatedData['main_subscription'] - $validatedData['discount']) ,

            'status' => '0',
        ]);

        session()->flash('invoice_created', true);

        return redirect()->route('students.show', $student->id);
    }


    public function editInvoice(Student $student, Invoice $invoice)
    {
        $studentId = $student->id;
        return view('students.invoices.edit', compact('studentId', 'invoice'));
    }

    public function updateInvoice(Student $student, Invoice $invoice, Request $request) {
        $validatedData = $request->validate([
            'term' => 'required|string|in:الاول,الثاني',
            'kind' => 'required|string|in:شهري,سنوي,الترم الاول,الترم الثاني',
            'bus_subscription' => 'required|numeric|min:0',
            'uniform_subscription' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'main_subscription' => 'required|numeric|min:0',
        ]);

        // Calculate total and remaining amounts
        $totalAmount = $validatedData['bus_subscription'] + $validatedData['uniform_subscription'] + $validatedData['main_subscription'] - $validatedData['discount'];
        $remainingAmount = $totalAmount - $invoice->paied_amount;

        // Update the invoice with the new data
        $invoice->update([
            'term' => $validatedData['term'],
            'kind' => $validatedData['kind'],
            'bus_subscription' => $validatedData['bus_subscription'],
            'uniform_subscription' => $validatedData['uniform_subscription'],
            'discount' => $validatedData['discount'],
            'main_subscription' => $validatedData['main_subscription'],
            'total_amount' => $totalAmount,
            'remaining_amount' => $remainingAmount, // Now always updates the remaining amount
        ]);

        session()->flash('invoice_updated', true);

        return redirect()->route('students.show', $student->id);
    }

    public function destroyInvoice(Student $student, Invoice $invoice) {
        $invoice->delete();

        session()->flash('invoice_deleted', true);

        return redirect()->route('students.show', $student->id);
    }

    public function showInvoice(Student $student, Invoice $invoice) {
        return view('students.invoices.show', compact('student', 'invoice'));
    }


}


