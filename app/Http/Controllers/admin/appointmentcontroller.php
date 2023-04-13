<?php

namespace App\Http\Controllers\admin;

use App\Models\appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class appointmentcontroller extends Controller
{

    public function index()
    {
        $appointments = appointment::orderByDesc('id')->paginate(10);

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = appointment::all();
        return view('admin.appointments.create' , compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email' => 'required',
            'coursetype'   => 'required',
            'cartype'   => 'required',
            'message'   => 'required',
        ]);
        // Upload icons
                  // Store To Database
        appointment::create([
            'name'   =>  $request->name,
            'email' =>  $request->email,
            'coursetype'   =>  $request->coursetype,
            'cartype'   =>  $request->cartype,
            'message'   =>  $request->message,
            ]);

         // Redirect
         return redirect()->route('admin.appointments.index')->with('msg', 'appointment added successfully')->with('type', 'success');

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
        $appointment = appointment::findOrFail($id);
        $appointments = appointment::all();

        return view('admin.appointments.edit', compact('appointment', 'appointments'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'name'   => 'required',
            'email' => 'required',
            'coursetype'   => 'required',
            'cartype'   => 'required',
            'message'   => 'required',
            ]);

        $appointment = appointment::findOrFail($id);

          // Store To Database
          $appointment->update([
            'name'   =>  $request->name,
            'email' =>  $request->email,
            'coursetype'   =>  $request->coursetype,
            'cartype'   =>  $request->cartype,
            'message'   =>  $request->message,
            ]);

          // Redirect
          return redirect()->route('admin.appointments.index')->with('msg', 'appointment updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = appointment::findOrFail($id);


        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('msg', 'appointment deleted successfully')->with('type', 'danger');

    }

    public function trash()
    {
        $appointments = appointment::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.appointments.trash', compact('appointments'));
    }

    public function restore($id)
    {
        appointment::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.appointments.index')->with('msg', 'appointment restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        appointment::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.appointments.index')->with('msg', 'appointment deleted permanintly successfully')->with('type', 'danger');
    }
}
