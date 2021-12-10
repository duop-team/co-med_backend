<?php

namespace App\Http\Controllers;

use App\Models\VisitRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index($patient)
    {
        if (Auth::user()->role_id != 4 || Auth::id() == $patient) {
            return VisitRecord::all()->where('patient_id', $patient);
        }

        return response(null, 403);
    }

    public function store($patient, Request $request)
    {
        if (Auth::user()->role_id != 3) {
            return response(null, 403);
        }

        $record = VisitRecord::create([
            'doctor_id' => Auth::id(),
            'patient_id' => intval($patient),
            'reason' => $request->reason
        ]);

        return response($record, 201);
    }

    public function show(VisitRecord $visit)
    {
        $id = Auth::id();

        if ($id == $visit->doctor_id || $id == $visit->patient_id || Auth::user()->role_id == 1 || Auth::user()->role_id == 2) {
            return $visit;
        }

        return response(null, $id ? 403 : 401);
    }

    public function destroy(VisitRecord $visit)
    {
        if (Auth::user()->role_id == 1 || Auth::id() == $visit->doctor_id) {
            if ($visit->delete()) {
                return response(null, 204);
            }
        }
        return response(null, 403);

    }
}
