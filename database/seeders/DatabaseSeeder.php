<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create permissions
        $permissions = [
            'view courses',
            'manage courses',
            'view assigned courses',
            'view course students',
            'view own registrations',
            'register courses',
            'manage students',
            'manage registrations',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // 2. Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'administrator', 'guard_name' => 'web']);
        $adminRole->syncPermissions($permissions);

        $lecturerRole = Role::firstOrCreate(['name' => 'lecturer', 'guard_name' => 'web']);
        $lecturerRole->syncPermissions([
            'view courses',
            'view assigned courses',
            'view course students',
        ]);

        $studentRole = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $studentRole->syncPermissions([
            'view courses',
            'view own registrations',
            'register courses',
        ]);

        // 3. Create Administrator
        $admin = User::firstOrCreate(
            ['email' => 'admin@school.ac.ug'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles([$adminRole]);

        // 4. Create Lecturers
        $lecturer1 = User::firstOrCreate(
            ['email' => 'dr.smith@school.ac.ug'],
            [
                'name' => 'Dr. John Smith',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $lecturer1->syncRoles([$lecturerRole]);

        $lecturer2 = User::firstOrCreate(
            ['email' => 'prof.mukasa@school.ac.ug'],
            [
                'name' => 'Prof. Sarah Mukasa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $lecturer2->syncRoles([$lecturerRole]);

        // 5. Create Sample Courses
        $course1 = Course::firstOrCreate(
            ['code' => 'CSC101'],
            [
                'title' => 'Introduction to Computer Science',
                'description' => 'Fundamental concepts of computer science, algorithms, and computational thinking.',
                'credit_units' => 4,
                'lecturer_id' => $lecturer1->id,
            ]
        );

        $course2 = Course::firstOrCreate(
            ['code' => 'CSC201'],
            [
                'title' => 'Data Structures & Algorithms',
                'description' => 'Core data structures: lists, stacks, trees, heaps, graphs, sorting, and algorithmic complexity.',
                'credit_units' => 4,
                'lecturer_id' => $lecturer1->id,
            ]
        );

        $course3 = Course::firstOrCreate(
            ['code' => 'BIT101'],
            [
                'title' => 'Information Technology Fundamentals',
                'description' => 'Computer architecture, networking fundamentals, databases, and enterprise systems.',
                'credit_units' => 3,
                'lecturer_id' => $lecturer2->id,
            ]
        );

        $course4 = Course::firstOrCreate(
            ['code' => 'BIT201'],
            [
                'title' => 'Web Applications Development',
                'description' => 'Building responsive, database-driven web applications with modern frameworks and tools.',
                'credit_units' => 4,
                'lecturer_id' => $lecturer2->id,
            ]
        );

        $course5 = Course::firstOrCreate(
            ['code' => 'MTH101'],
            [
                'title' => 'Calculus for Computing',
                'description' => 'Differential and integral calculus with applications in computer science and data science.',
                'credit_units' => 3,
                'lecturer_id' => null,
            ]
        );

        // 6. Create Students
        $studentUser1 = User::firstOrCreate(
            ['email' => 'student@school.ac.ug'],
            [
                'name' => 'Raynel Natukunda',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $studentUser1->syncRoles([$studentRole]);

        $student1 = Student::firstOrCreate(
            ['user_id' => $studentUser1->id],
            [
                'student_number' => '26/U/10001',
                'programme' => 'Bachelor of Science in Computer Science',
                'year_of_study' => 2,
            ]
        );

        $studentUser2 = User::firstOrCreate(
            ['email' => 'ivan@school.ac.ug'],
            [
                'name' => 'Ivan Tumwine',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $studentUser2->syncRoles([$studentRole]);

        $student2 = Student::firstOrCreate(
            ['user_id' => $studentUser2->id],
            [
                'student_number' => '26/U/10002',
                'programme' => 'Bachelor of Information Technology',
                'year_of_study' => 1,
            ]
        );

        // 7. Seed Sample Registrations
        CourseRegistration::firstOrCreate([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
        ]);

        CourseRegistration::firstOrCreate([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
        ]);

        CourseRegistration::firstOrCreate([
            'student_id' => $student2->id,
            'course_id' => $course3->id,
        ]);
    }
}
