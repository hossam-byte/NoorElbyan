<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use App\Models\Student;
use App\Models\StudentAbsence;
use App\Models\Teacher;
use App\Models\TeacherAbsence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $morningStudents = Student::where([
            'is_archive' => 0,
            'duration' => 'صباحي'
        ])->get();
        $afternoonStudents = Student::where([
            'is_archive' => 0,
            'duration' => 'مسائي'
        ])->get();

        $archiveStudents = Student::where([
            'is_archive' => 1,
        ])->get();

        $morningTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => 'صباحي'
        ])->get();
        $afternoonTeachers = Teacher::where([
            'is_archive' => 0,
            'duration' => 'مسائي'
        ])->get();
        $archiveTeachers = Teacher::where([
            'is_archive' => 1,
        ])->get();

        $morningClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'صباحي'
        ])->get();
        $afternoonClasses = AcademyClass::where([
            'status' => 'active',
            'duration' => 'مسائي'
        ])->get();

        $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

        $morningPresentStudents = StudentAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 1,
                'duration' => 'صباحي'
            ])
            ->get();
        $morningAbsentStudents = StudentAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 0,
                'duration' => 'صباحي'
            ])
            ->get();

        $afternoonPresentStudents = StudentAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 1,
                'duration' => 'مسائي'
            ])->get();
        $afternoonAbsentStudents = StudentAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 0,
                'duration' => 'مسائي'
            ])->get();

        $morningPresentTeachers = TeacherAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 1,
                'duration' => 'صباحي'
            ])
            ->get();
        $morningAbsentTeachers = TeacherAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 0,
                'duration' => 'صباحي'
            ])
            ->get();

        $afternoonPresentTeachers = TeacherAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 1,
                'duration' => 'مسائي'
            ])->get();
        $afternoonAbsentTeachers = TeacherAbsence::whereDate('date', $today)
            ->where([
                'is_present' => 0,
                'duration' => 'مسائي'
            ])->get();

        return view('dashboard', compact(
            'morningStudents',
            'afternoonStudents',
            'archiveStudents',
            'archiveTeachers',
            'morningTeachers',
            'afternoonTeachers',
            'morningClasses',
            'afternoonClasses',
            'morningAbsentStudents',
            'morningPresentStudents',
            'afternoonPresentStudents',
            'afternoonAbsentStudents',
            'afternoonPresentTeachers',
            'afternoonAbsentTeachers',
            'morningPresentTeachers',
            'morningAbsentTeachers',
        ));
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
