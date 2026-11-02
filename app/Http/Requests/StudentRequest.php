<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    /** Access is decided by the permission middleware on the route. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $student = $this->route('student');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                // On update, the student keeping their own address is not a duplicate.
                Rule::unique('users', 'email')->ignore($student?->user_id),
            ],
            // Required when creating; optional when editing, where a blank
            // field means "leave the password alone".
            'password' => [$student ? 'nullable' : 'required', 'string', 'min:8'],
            'programme' => ['required', 'string', 'max:255'],
            'year_of_study' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }
}
