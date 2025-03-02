<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'number_of_seats' => ['required', 'numeric'],
            'taken_seats' => ['required', 'numeric'],
            'available_seats' => ['required', 'numeric'],
        ]);

        Driver::create([
            'name' => $validatedData['name'],
            'number_of_seats' => $validatedData['number_of_seats'],
            'taken_seats' => $validatedData['taken_seats'],
            'available_seats' => $validatedData['available_seats'],
        ]);

        session()->flash('driver_added', true);

        return redirect()->route('drivers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        $driverStudents = $driver->students;
        return view('drivers.show', compact('driverStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $driver)
    {
        $wantedDriver = Driver::findOrFail($driver);

        $validatedData = $request->validate([
            'name' => 'required',
            'number_of_seats' => ['required', 'numeric'],
            'taken_seats' => ['required', 'numeric'],
            'available_seats' => ['required', 'numeric'],
        ]);

        $wantedDriver->name = $validatedData['name'];
        $wantedDriver->number_of_seats = $validatedData['number_of_seats'];
        $wantedDriver->taken_seats = $validatedData['taken_seats'];
        $wantedDriver->available_seats = $validatedData['available_seats'];

        $wantedDriver->save();

        session()->flash('driver_updated', true);

        return redirect()->route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        session()->flash('driver_deleted', true);

        return redirect()->route('drivers.index');
    }
}
