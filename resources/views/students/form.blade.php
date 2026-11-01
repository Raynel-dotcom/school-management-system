@csrf

@php($editing = isset($student))

<div class="space-y-5">
    @if ($editing)
        <div class="rounded-md bg-slate-50 px-4 py-3">
            <p class="text-sm text-slate-500">Student number</p>
            <p class="mt-0.5 font-semibold text-slate-900">{{ $student->student_number }}</p>
            <p class="field-hint">Generated on creation and never changed.</p>
        </div>
    @endif

    <div>
        <label for="name" class="field-label">Full name</label>
        <input type="text" name="name" id="name" required
               value="{{ old('name', $editing ? $student->user->name : '') }}"
               class="input-field">
    </div>

    <div>
        <label for="email" class="field-label">Email</label>
        <input type="email" name="email" id="email" required
               value="{{ old('email', $editing ? $student->user->email : '') }}"
               class="input-field">
    </div>

    <div>
        <label for="password" class="field-label">
            Password @if ($editing)<span class="font-normal text-slate-400">(leave blank to keep)</span>@endif
        </label>
        <input type="password" name="password" id="password" @unless ($editing) required @endunless
               autocomplete="new-password" class="input-field">
        <p class="field-hint">At least 8 characters.</p>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="programme" class="field-label">Programme</label>
            <input type="text" name="programme" id="programme" required
                   value="{{ old('programme', $editing ? $student->programme : '') }}"
                   placeholder="BSc Computer Science"
                   class="input-field">
        </div>

        <div>
            <label for="year_of_study" class="field-label">Year of study</label>
            <input type="number" name="year_of_study" id="year_of_study" required min="1" max="5"
                   value="{{ old('year_of_study', $editing ? $student->year_of_study : 1) }}"
                   class="input-field">
        </div>
    </div>

    <div class="flex items-center gap-3 border-t border-slate-200 pt-5">
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>
