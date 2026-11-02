<?php

namespace App\Actions;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateStudent
{
    /**
     * Create a user account and associated student record in a single transaction.
     *
     * @param  array<string, mixed>  $data
     */
    public function __invoke(array $data): Student
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::needsRehash($data['password'])
                    ? Hash::make($data['password'])
                    : $data['password'],
            ]);

            // Assign the student role
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('student');
            }

            $studentNumber = $this->generateStudentNumber();

            return Student::create([
                'user_id' => $user->id,
                'student_number' => $studentNumber,
                'programme' => $data['programme'],
                'year_of_study' => (int) $data['year_of_study'],
            ]);
        });
    }

    /**
     * Generate a unique student number.
     * Example format: 26/U/12345
     */
    protected function generateStudentNumber(): string
    {
        $prefix = date('y') . '/U/';

        do {
            $number = sprintf('%05d', mt_rand(10000, 99999));
            $candidate = $prefix . $number;
        } while (Student::where('student_number', $candidate)->exists());

        return $candidate;
    }
}

