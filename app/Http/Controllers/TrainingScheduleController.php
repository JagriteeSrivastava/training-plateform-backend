<?php

namespace App\Http\Controllers;

use App\Models\TrainingSchedule;
use Illuminate\Http\Request;

class TrainingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return TrainingSchedule::with('course')->get();
    }

    public function store(Request $request) {
        return TrainingSchedule::create($request->validate([
            'course_id' => 'required',
            'training_date' => 'nullable',
            'location' => 'nullable',
        ]));
    }

    public function show(TrainingSchedule $schedule) {
        return $schedule;
    }

    public function update(Request $request, TrainingSchedule $schedule) {
        $schedule->update($request->validate([
            'course_id' => 'required',
            'training_date' => 'nullable',
            'location' => 'nullable',
        ]));
        return $schedule;
    }

    public function destroy(TrainingSchedule $schedule) {
        $schedule->delete();
        return response()->noContent();
    }
}
