<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    /** Access is decided by the permission middleware on the route. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => [
                'required',
                'integer',
                // Turns a bad course id into a readable validation error
                // instead of a foreign key crash.
                'exists:courses,id',
                self::notAlreadyRegistered($this->user()->student?->id),
            ],
        ];
    }

    /**
     * The duplicate-registration rule, scoped to one student.
     *
     * Shared with the administrator's registration form, which scopes it to
     * the submitted student rather than the signed-in one.
     */
    public static function notAlreadyRegistered(?int $studentId): \Illuminate\Validation\Rules\Unique
    {
        return Rule::unique('course_registrations', 'course_id')
            ->where(fn ($query) => $query->where('student_id', $studentId));
    }

    public function messages(): array
    {
        return [
            'course_id.unique' => 'You are already registered for that course.',
            'course_id.exists' => 'That course does not exist.',
        ];
    }
}
