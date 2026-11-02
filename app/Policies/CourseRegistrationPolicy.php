<?php

namespace App\Policies;

use App\Models\CourseRegistration;
use App\Models\User;

class CourseRegistrationPolicy
{
    /**
     * Determine whether the user can delete the course registration.
     */
    public function delete(User $user, CourseRegistration $registration): bool
    {
        if ($user->hasRole('administrator')) {
            return true;
        }

        return $user->student !== null && $user->student->id === $registration->student_id;
    }
}

