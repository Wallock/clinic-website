<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Doctor::active()->ordered();

        // Filter by specialization if provided
        if ($request->has('specialization') && $request->specialization) {
            $query->where('specialization', 'like', '%' . $request->specialization . '%');
        }

        $doctors = $query->paginate(12);

        // Get unique specializations for filter
        $specializations = Doctor::active()
                                ->distinct()
                                ->pluck('specialization')
                                ->filter()
                                ->sort();

        return view('doctors.index', compact('doctors', 'specializations'));
    }

    /**
     * Display the specified doctor.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        // Check if doctor is active
        if (!$doctor->is_active) {
            abort(404);
        }

        // Get related doctors with same specialization
        $relatedDoctors = Doctor::active()
                               ->where('id', '!=', $doctor->id)
                               ->where('specialization', $doctor->specialization)
                               ->ordered()
                               ->take(3)
                               ->get();

        return view('doctors.show', compact('doctor', 'relatedDoctors'));
    }

    /**
     * Search doctors by name or specialization.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q');

        $doctors = Doctor::active()
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%{$searchTerm}%")
                                  ->orWhere('specialization', 'like', "%{$searchTerm}%")
                                  ->orWhere('description', 'like', "%{$searchTerm}%");
                        })
                        ->ordered()
                        ->paginate(12);

        return view('doctors.search', compact('doctors', 'searchTerm'));
    }
}
