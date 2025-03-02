<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\StudentAbsence;
use App\Models\Teacher;
use App\Models\TeacherAbsence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeacherAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $morningTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => 'صباحي'
        ])->get();

        $afternoonTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => 'مسائي'
        ])->get();

        return view('teachers.absence', compact('morningTeachers', 'afternoonTeachers'));
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
        $today = Carbon::today();
        $duration = $request->input('duration');
        $sessionMsg = '';

        // Loop over each teacher
        foreach ($request->input('teachers') as $teacher) {
            $teacherId = $teacher['teacher_id'];

            // Check if 'is_present' was sent, if not, set it to false
            $isPresent = isset($teacher['is_present']) && $teacher['is_present'] === 'true' ? 1 : 0;

            // Check if the teacher already has an absence record for today
            $existingAbsence = TeacherAbsence::where('teacher_id', $teacherId)
                ->whereDate('date', $today)
                ->first();

            // If an absence record already exists, skip to the next teacher
            if ($existingAbsence) {
                // Update the existing record
                $existingAbsence->update([
                    'is_present' => $isPresent,
                ]);
                $sessionMsg = 'absence_updated';
            } else {
                // Create a new absence record
                TeacherAbsence::create([
                    'teacher_id' => $teacherId,
                    'date' => $today,
                    'duration' => $duration,
                    'is_present' => $isPresent,
                ]);
                $sessionMsg = 'absence_stored';
            }
        }

        // Flash a session message to notify success
        session()->flash($sessionMsg, true);

        return redirect()->route('teachers.absence.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
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
        $duration = $request->query('duration');

        if (!in_array($duration, ['صباحي', 'مسائي'])) {
            return redirect()->route('errors.404');
        }

        $teachers = Teacher::where([
            'is_archive' => 0,
            'duration' => $duration
        ])->get();

//        $morningTeachers = Teacher::where([
//            'is_archive' => 0,
//            'duration' => 'صباحي'
//        ])->get();
//
//        $afternoonTeachers = Teacher::where([
//            'is_archive' => 0,
//            'duration' => 'مسائي'
//        ])->get();

        return view('teachers.absence-h', compact('absencesByMonth', 'teachers'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request) {
        $selectedDate = $request->input('absence-filter-Date');
        $absenceFilterDuration = $request->input('absence-filter-duration');
        $morningTeachers = null;
        $afternoonTeachers = null;

        if($selectedDate) {
            if($absenceFilterDuration === 'صباحي') {
                $morningTeachers = TeacherAbsence::where([
                    'date' => $selectedDate,
                    'duration' => $absenceFilterDuration
                ])->get();
            }

            if($absenceFilterDuration === 'مسائي') {
                $afternoonTeachers = TeacherAbsence::where([
                    'date' => $selectedDate,
                    'duration' => $absenceFilterDuration
                ])->get();
            }
        }





        return view('teachers.edit-absence', compact('selectedDate', 'morningTeachers', 'afternoonTeachers'));


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
