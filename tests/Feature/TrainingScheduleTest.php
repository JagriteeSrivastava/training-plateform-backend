<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TrainingSchedule;
use App\Models\Course;

class TrainingScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_training_schedule()
    {
        $course = Course::factory()->create();

        $data = [
            'course_id' => $course->id,
            'training_date' => now()->addDays(5)->format('Y-m-d'),
            'location' => 'Lucknow',
        ];

        $schedule = TrainingSchedule::create($data);

        $this->assertDatabaseHas('training_schedules', $data);
    }

    /** @test */
    public function it_reads_a_training_schedule()
    {
        $schedule = TrainingSchedule::factory()->create();

        $fetched = TrainingSchedule::find($schedule->id);

        $this->assertEquals($schedule->location, $fetched->location);
    }

    /** @test */
    public function it_updates_a_training_schedule()
    {
        $schedule = TrainingSchedule::factory()->create();

        $schedule->update(['location' => 'Delhi']);

        $this->assertDatabaseHas('training_schedules', [
            'id' => $schedule->id,
            'location' => 'Delhi',
        ]);
    }

    /** @test */
    public function it_deletes_a_training_schedule()
    {
        $schedule = TrainingSchedule::factory()->create();

        $schedule->delete();

        $this->assertDatabaseMissing('training_schedules', [
            'id' => $schedule->id,
        ]);
    }
}
