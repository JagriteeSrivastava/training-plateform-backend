<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Course::all();
    }

    public function store(Request $request) {
        return Course::create($request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]));
    }

    public function show(Course $course) {
        return $course;
    }

    public function update(Request $request, Course $course) {
        $course->update($request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]));
        return $course;
    }

    public function destroy(Course $course) {
        $course->delete();
        return response()->noContent();
    }

}
