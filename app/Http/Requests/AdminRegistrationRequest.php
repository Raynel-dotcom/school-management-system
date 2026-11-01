<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegistrationRequest extends FormRequest
{
    /** Access is decided by the permission middleware on the route. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'course_id' => [
                'required',
                'integer',
                'exists:courses,id',
                // Same duplicate rule the students use, scoped to the
                // submitted student rather than the signed-in one.
                RegistrationRequest::notAlreadyRegistered((int) $this->input('student_id')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.unique' => 'That student is already registered for that course.',
        ];
    }
}
