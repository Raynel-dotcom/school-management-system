<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_student_registration_creates_account_and_profile(): void
    {
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'jane.doe@school.ac.ug',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'programme' => 'Bachelor of Business Computing',
            'year_of_study' => 1,
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();

        $user = User::where('email', 'jane.doe@school.ac.ug')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('student'));

        $student = Student::where('user_id', $user->id)->first();
        $this->assertNotNull($student);
        $this->assertEquals('Bachelor of Business Computing', $student->programme);
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@school.ac.ug',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_can_access_student_management(): void
    {
        $admin = User::where('email', 'admin@school.ac.ug')->first();

        $response = $this->actingAs($admin)->get('/students');

        $response->assertStatus(200);
        $response->assertSee('Raynel Natukunda');
    }

    public function test_admin_can_access_course_management(): void
    {
        $admin = User::where('email', 'admin@school.ac.ug')->first();

        $response = $this->actingAs($admin)->get('/courses');

        $response->assertStatus(200);
        $response->assertSee('CSC101');
    }

    public function test_student_cannot_access_student_management(): void
    {
        $studentUser = User::where('email', 'student@school.ac.ug')->first();

        $response = $this->actingAs($studentUser)->get('/students');

        // Should be forbidden (403) due to permission:manage students
        $response->assertStatus(403);
    }

    public function test_student_can_view_courses_and_their_registrations(): void
    {
        $studentUser = User::where('email', 'student@school.ac.ug')->first();

        $response = $this->actingAs($studentUser)->get('/courses');
        $response->assertStatus(200);

        $responseMy = $this->actingAs($studentUser)->get('/my/courses');
        $responseMy->assertStatus(200);
    }

    public function test_lecturer_can_view_teaching_dashboard(): void
    {
        $lecturer = User::where('email', 'dr.smith@school.ac.ug')->first();

        $response = $this->actingAs($lecturer)->get('/teaching');
        $response->assertStatus(200);
        $response->assertSee('CSC101');
    }
}
