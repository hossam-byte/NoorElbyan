<?php

namespace App\Http\Controllers;

use App\Models\AcademyClass;
use Illuminate\Http\Request;

class AcademyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $inActiveClasses = AcademyClass::where('status', 'inactive')->get();
        return view('classes.index', compact( 'inActiveClasses', 'morningClasses', 'afternoonClasses'));
    }

    public function create()
    {
        return view('classes.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'number_of_seats' => ['required', 'numeric'],
            'taken_seats' => ['required', 'numeric'],
            'available_seats' => ['required', 'numeric'],
            'duration' => 'required',
            'status' => 'required',
        ]);

        AcademyClass::create([
            'name' => $validatedData['name'],
            'number_of_seats' => $validatedData['number_of_seats'],
            'taken_seats' => $validatedData['taken_seats'],
            'available_seats' => $validatedData['available_seats'],
            'duration' => $validatedData['duration'],
            'status' => $validatedData['status'],
        ]);

        session()->flash('class_added', true);

        return redirect()->route('classes.index');
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
    public function edit(AcademyClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $class)
    {

        $wantedClass = AcademyClass::findOrFail($class);

        $validatedData = $request->validate([
            'name' => 'required',
            'number_of_seats' => ['required', 'numeric'],
            'taken_seats' => ['required', 'numeric'],
            'available_seats' => ['required', 'numeric'],
            'duration' => 'required',
            'status' => 'required',
        ]);

        $wantedClass->name = $validatedData['name'];
        $wantedClass->number_of_seats = $validatedData['number_of_seats'];
        $wantedClass->taken_seats = $validatedData['taken_seats'];
        $wantedClass->available_seats = $validatedData['available_seats'];
        $wantedClass->duration = $validatedData['duration'];
        $wantedClass->status = $validatedData['status'];

        $wantedClass->save();

        session()->flash('class_updated', true);

        return redirect()->route('classes.index');
    }



    public function destroy(AcademyClass $class)
    {
        $class->delete();
        session()->flash('class_deleted', true);

        return redirect()->route('classes.index');
    }
}
