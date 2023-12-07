<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userId = $user->id;
        $userEmail = $user->email;

        $employer = Employer::where('email', $userEmail)->first();
        $employerId = $employer ? $employer->employer_id : null;

        $appointments = $employerId ? Appointment::where('salesperson_id', $employerId)->get() : collect();

        return view('appointment.index', compact('appointments', 'userId', 'userEmail', 'employerId'));
    }


    public function dashboard()
    {
        $user = Auth::user();
        $userEmail = $user->email;
    
        $employer = Employer::where('email', $userEmail)->first();
        $employerId = $employer ? $employer->employer_id : null;
    
        // Récupérer les trois prochains rendez-vous qui ne sont pas 'Realized'
        $appointments = $employerId
            ? Appointment::where('salesperson_id', $employerId)
                ->where('status', '!=', 'Realized') // Exclure les rendez-vous 'Realized'
                ->orderBy('date_time', 'asc')
                ->take(3)
                ->get()
            : collect();
    
        return view('dashboard', compact('appointments'));
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
    public function show($appointment_id)
    {
        // Utilisez 'appointment_id' au lieu de 'id'
        $appointment = Appointment::where('appointment_id', $appointment_id)->first();

        if (!$appointment) {
            return redirect('/appointment')->with('error', 'Rendez-vous non trouvé');
        }

        // Assurez-vous que la variable passée à la vue est correctement nommée
        return view('appointment.show', compact('appointment'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Le statut du rendez-vous a été mis à jour.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
