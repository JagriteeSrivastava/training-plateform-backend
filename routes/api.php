<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainingOptController;
use App\Http\Controllers\TrainingScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Course, Student, Schedule, Optin APIs
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('schedules', TrainingScheduleController::class);
    Route::get('trainings/student-opted', [TrainingOptController::class, 'studentOpted']);
    Route::post('trainings/opt', [TrainingOptController::class, 'opt']);
    Route::post('trainings/out', [TrainingOptController::class, 'out']);
});

