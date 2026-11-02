@csrf

<div class="space-y-5">
    <div>
        <label for="code" class="field-label">Course code</label>
        <input type="text" name="code" id="code" required
               value="{{ old('code', $course->code ?? '') }}"
               placeholder="CSC301"
               class="input-field">
        <p class="field-hint">Three capital letters then three digits, for example CSC301.</p>
    </div>

    <div>
        <label for="title" class="field-label">Title</label>
        <input type="text" name="title" id="title" required
               value="{{ old('title', $course->title ?? '') }}"
               class="input-field">
    </div>

    <div>
        <label for="description" class="field-label">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="input-field">{{ old('description', $course->description ?? '') }}</textarea>
    </div>

    <div class="grid gap-5 sm:grid-cols-2">
        <div>
            <label for="credit_units" class="field-label">Credit units</label>
            <input type="number" name="credit_units" id="credit_units" required min="1" max="6"
                   value="{{ old('credit_units', $course->credit_units ?? 3) }}"
                   class="input-field">
        </div>

        <div>
            <label for="lecturer_id" class="field-label">Lecturer</label>
            <select name="lecturer_id" id="lecturer_id" class="input-field">
                <option value="">Unassigned</option>
                @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->id }}"
                        @selected((int) old('lecturer_id', $course->lecturer_id ?? null) === $lecturer->id)>
                        {{ $lecturer->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex items-center gap-3 border-t border-slate-200 pt-5">
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>
