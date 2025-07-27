<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_student()
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    /** @test */
    public function it_reads_a_student()
    {
        $student = Student::factory()->create();

        $fetchedStudent = Student::find($student->id);

        $this->assertEquals($student->email, $fetchedStudent->email);
    }

    /** @test */
    public function it_updates_a_student()
    {
        $student = Student::factory()->create();

        $student->update(['name' => 'Jane Updated']);

        $this->assertDatabaseHas('students', ['name' => 'Jane Updated']);
    }

    /** @test */
    public function it_deletes_a_student()
    {
        $student = Student::factory()->create();

        $student->delete();

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
