<?php

namespace App\Http\Controllers;

use App\Models\OptIn;
use Illuminate\Http\Request;

class OptInController extends Controller
{

    public function optIn(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_schedule_id' => 'required|exists:training_schedules,id',
        ]);

        $optIn = OptIn::create($validatedData);

        return response()->json($optIn, 201);
    }


    public function optOut(Request $request)
    {
        $optIn = OptIn::where('student_id', $request->student_id)
            ->where('training_schedule_id', $request->training_schedule_id)
            ->first();

        if ($optIn) {
            $optIn->delete();
            return response()->json(['message' => 'Opted out successfully'], 204);
        }

        return response()->json(['message' => 'Record not found'], 404);
    }
}
