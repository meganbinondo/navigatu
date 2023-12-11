<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;



class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Appointment::all();
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();

        $appointment = Appointment::create($validated);

        return $appointment;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Appointment::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, string $id)
    {
        $appointment = Appointment::findOrfail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();
 
        $appointment->update([
            'area' => $validated['area'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);
        
        $appointment->save();

        return $appointment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrfail($id);

        $appointment->delete();

        return $appointment;
    }
}