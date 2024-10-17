<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSchedule;

class TrainingScheduleController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
        ]);

        //  dd($validatedData);

        $trainingSchedule = TrainingSchedule::create($validatedData);

        return response()->json($trainingSchedule, 201);
    }
}
