<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingOptController extends Controller
{
    /**
     * Opt in for a training schedule.
     */
    public function studentOpted()
    {
        $data = \App\Models\StudentTraining::with('student', 'trainingSchedule.course')
            ->get()
            ->map(function ($item) {
                return [
                    'student_id' => $item->student->id,
                    'student_name' => $item->student->name,
                    'training_schedule_id' => $item->trainingSchedule->id,
                    'training_date' => $item->trainingSchedule->training_date,
                    'location' => $item->trainingSchedule->location,
                    'course_title' => $item->trainingSchedule->course->title,
                ];
            });

        return response()->json($data);
    }

    public function opt(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_schedule_id' => 'required|exists:training_schedules,id',
        ]);

        \App\Models\StudentTraining::firstOrCreate($request->only('student_id', 'training_schedule_id'));

        return response()->json(['message' => 'Opted in']);
    }

    public function out(Request $request) {
        $request->validate([
            'student_id' => 'required',
            'training_schedule_id' => 'required',
        ]);

        \App\Models\StudentTraining::where($request->only('student_id', 'training_schedule_id'))->delete();

        return response()->json(['message' => 'Opted out']);
    }

}
