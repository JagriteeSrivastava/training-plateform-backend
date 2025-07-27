<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Course;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_course()
    {
        $course = Course::factory()->create([
            'title' => 'Laravel Testing',
            'description' => 'Test-driven development in Laravel.'
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'Laravel Testing',
            'description' => 'Test-driven development in Laravel.'
        ]);
    }

    /** @test */
    public function it_can_read_course_data()
    {
        $course = Course::factory()->create();

        $this->assertEquals($course->title, Course::find($course->id)->title);
    }

    /** @test */
    public function it_can_update_a_course()
    {
        $course = Course::factory()->create();

        $course->update(['title' => 'Updated Title']);

        $this->assertDatabaseHas('courses', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_course()
    {
        $course = Course::factory()->create();

        $course->delete();

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
