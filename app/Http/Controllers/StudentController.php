<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Student::all();
    }

    public function store(Request $request) {
        return Student::create($request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable',
        ]));
    }

    public function show(Student $student) {
        return $student;
    }

    public function update(Request $request, Student $student) {
        $student->update($request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'nullable',
        ]));
        return $student;
    }

    public function destroy(Student $student) {
        $student->delete();
        return response()->noContent();
    }
}
