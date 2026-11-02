<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /** Access is decided by the permission middleware on the route. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'regex:/^[A-Z]{3}[0-9]{3}$/',
                // On update, the course keeping its own code is not a duplicate.
                Rule::unique('courses', 'code')->ignore($this->route('course')),
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'credit_units' => ['required', 'integer', 'min:1', 'max:6'],
            'lecturer_id' => [
                'nullable',
                'integer',
                'exists:users,id',
                // The form only offers lecturers, but a hand-made POST could
                // name any account. A course taught by a student is nonsense.
                function (string $attribute, mixed $value, callable $fail): void {
                    if ($value !== null && ! User::find($value)?->hasRole('lecturer')) {
                        $fail('The selected account is not a lecturer.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.regex' => 'The course code must be three capital letters followed by three digits, for example CSC301.',
            'code.unique' => 'Another course already uses that code.',
        ];
    }
}
