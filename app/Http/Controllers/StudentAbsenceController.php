<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\Student;
use App\Models\StudentAbsence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function absence ()
    {

    }



    public function index()
    {

        $morningClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'صباحي',
        ])->get();

        $afternoonClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'مسائي',
        ])->get();



        return view('students.absence', compact('morningClasses', 'afternoonClasses'));
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
        $academyClassId = $request->input('academy_class_id');
        $duration = $request->input('duration');
        $today = Carbon::today();
        $date = $request->input('date');
        $sessionMsg = '';

        // Loop over each student
        foreach ($request->input('students') as $student) {
            $studentId = $student['student_id'];

            // Check if 'is_present' was sent, if not, set it to false
            $isPresent = isset($student['is_present']) && $student['is_present'] === 'true' ? 1 : 0;

            // Check if the student already has an absence record for today
            $existingAbsence = StudentAbsence::where('student_id', $studentId)
                ->where('academy_class_id', $academyClassId)
                ->whereDate('date', $date)
                ->first();

            // If an absence record already exists, skip to the next student
            if ($existingAbsence) {
                // Update the existing record
                $existingAbsence->update([
                    'is_present' => $isPresent,
                ]);
                $sessionMsg = 'absence_updated';
            } else {
                // Create a new absence record
                StudentAbsence::create([
                    'student_id' => $studentId,
                    'academy_class_id' => $academyClassId,
                    'duration' => $duration,
                    'date' => $today,
                    'is_present' => $isPresent,
                ]);
                $sessionMsg = 'absence_stored';
            }
        }

        // Flash a session message to notify success
        session()->flash($sessionMsg, true);

        return redirect()->route('students.absence.index');
    }


    /**
     * Display the specified resource.
     */

    public function show (Request $request)
    {

        $duration = $request->query('duration');
        $class = $request->query('class');

        $selectedClass = AcademyClass::find($class);
        $students = $selectedClass->students->where('duration', $duration);




        $absencesByMonth = [
            'Jan' => [
                'monthName' => 'Jan',
                'absences' => collect(), // use a collection for absences
            ],
            'Feb' => [
                'monthName' => 'Feb',
                'absences' => collect(),
            ],
            'Mar' => [
                'monthName' => 'Mar',
                'absences' => collect(),
            ],
            'Apr' => [
                'monthName' => 'Apr',
                'absences' => collect(),
            ],
            'May' => [
                'monthName' => 'May',
                'absences' => collect(),
            ],
            'Jun' => [
                'monthName' => 'Jun',
                'absences' => collect(),
            ],
            'Jul' => [
                'monthName' => 'Jul',
                'absences' => collect(),
            ],
            'Aug' => [
                'monthName' => 'Aug',
                'absences' => collect(),
            ],
            'Sep' => [
                'monthName' => 'Sep',
                'absences' => collect(),
            ],
            'Oct' => [
                'monthName' => 'Oct',
                'absences' => collect(),
            ],
            'Nov' => [
                'monthName' => 'Nov',
                'absences' => collect(),
            ],
            'Dec' => [
                'monthName' => 'Dec',
                'absences' => collect(),
            ],
        ];

        $absences = StudentAbsence::where('academy_class_id', $class)->get();

        foreach ($absences as $absence) {
            $month = Carbon::parse($absence->date)->format('M'); // Get the month abbreviation
            if (isset($absencesByMonth[$month])) {
                $absencesByMonth[$month]['absences']->push($absence); // Push the absence to the correct month
            }
        }

//        @dd($absencesByMonth);


        return view('students.absence-h', compact('absencesByMonth' ,'selectedClass', 'students'));
    }


    /**
     * Show the form for editing the specified resource.
     */
//    public function edit()
//    {
//
//        $morningClasses = AcademyClass::where([
//            'status' => 'active',
//            'duration' => 'صباحي',
//        ])->get();
//
//        $afternoonClasses = AcademyClass::where([
//            'status' => 'active',
//            'duration' => 'مسائي',
//        ])->get();
//
//
//
//        return view('students.edit-absence', compact('morningClasses', 'afternoonClasses'));
//    }

    public function edit(Request $request) {
        $morningClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'صباحي',
        ])->get();

        $afternoonClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'مسائي',
        ])->get();


        $selectedClassId = $request->input('absence-filter-className');
        $selectedDate = $request->input('absence-filter-Date');
        $absenceFilterDuration = $request->input('absence-filter-duration');
        $selectedMorningAbsence = [];
        $selectedAfternoonAbsence = [];
        if($selectedClassId && $selectedDate) {
            if($absenceFilterDuration === 'صباحي'){
                $selectedMorningAbsence = StudentAbsence::where([
                    'academy_class_id' => $selectedClassId,
                    'date' => $selectedDate,
                    'duration' => $absenceFilterDuration,
                ])->get();
            } else{
                $selectedAfternoonAbsence = StudentAbsence::where([
                    'academy_class_id' => $selectedClassId,
                    'date' => $selectedDate,
                    'duration' => $absenceFilterDuration,
                ])->get();
            }
        } else {
            $selectedMorningAbsence = null;
            $selectedAfternoonAbsence = null;
        }


        return view('students.edit-absence', compact('morningClasses', 'afternoonClasses', 'selectedMorningAbsence', 'selectedAfternoonAbsence', 'morningClasses', 'afternoonClasses'));



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
