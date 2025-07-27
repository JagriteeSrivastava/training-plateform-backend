<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use App\Models\TrainingSchedule;
use App\Models\Course;
use App\Models\StudentTraining;

class TrainingOptTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create mock course
        $this->course = \App\Models\Course::factory()->create();

        // Create mock student
        $this->student = Student::factory()->create();

        // Create mock training schedule
        $this->schedule = TrainingSchedule::factory()->create([
            'course_id' => $this->course->id,
            'training_date' => now()->addDays(3),
            'location' => 'Lucknow'
        ]);
    }

    /** @test */
    public function student_can_opt_in()
    {
        $response = $this->postJson('/api/trainings/opt', [
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('student_trainings', [
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id,
        ]);
    }

    /** @test */
    public function student_can_opt_out()
    {
        // First opt-in
        StudentTraining::create([
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id,
        ]);

        // Then opt-out
        $response = $this->postJson('/api/trainings/out', [
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('student_trainings', [
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id,
        ]);
    }

    /** @test */
    public function it_returns_list_of_opted_students()
    {
        StudentTraining::create([
            'student_id' => $this->student->id,
            'training_schedule_id' => $this->schedule->id,
        ]);

        $response = $this->getJson('/api/trainings/student-opted');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'student_name' => $this->student->name,
                     'course_title' => $this->course->title,
                 ]);
    }
}
