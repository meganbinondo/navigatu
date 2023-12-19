<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Support\Facades\Auth;



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
        // $validated = $request->validated();

        // $appointment = Appointment::create($validated);

        // return $appointment;

        $validated = $request->validated();
    
        // Create the appointment
        $appointment = new Appointment;
        $appointment->area = trim($request->area);
        $appointment->details = trim($request->details);
        $appointment->start_time = trim($request->start_time);
        $appointment->end_time = trim($request->end_time);
        $appointment->event_date = trim($request->event_date);
        $appointment->id = Auth::user()->id;
    
        // Save the appointment to the database
        $appointment->save();
    
        return response()->json(['message' => 'Appointment successfully created', 'appointment' => $appointment], 201);
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
            'details' => $validated['details'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);
        
        $appointment->save();

        return $appointment;
    }

    public function update_status(AppointmentRequest $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Retrieve the validated input data...
        $validated = $request->validated();

        $appointment->update(['status' => $validated['status']]);

        return $appointment;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $appointment = Appointment::findOrfail($id);

        // $appointment->delete();

        // return $appointment;

        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();
    
            return response()->json(['message' => 'Appointment successfully deleted'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }
    }

    public function customerlist()
    {
        
        $data = Appointment::facultygetRecord();
        return $data;
    }
}