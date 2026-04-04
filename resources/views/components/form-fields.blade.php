<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Subject Name --}}
    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Subject Name</label>
        <input type="text" name="name" value="{{ old('name', $subject->name ?? '') }}"
            class="rounded-xl border-gray-200 dark:bg-white/5 dark:border-white/10 dark:text-white focus:ring-indigo-500"
            required>
    </div>

    {{-- Semester --}}
    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Semester</label>
        <select name="semester"
            class="rounded-xl border-gray-200 dark:bg-[#1a1d29] dark:border-white/10 dark:text-white focus:ring-indigo-500">
            <option value="first semester"
                {{ old('semester', $subject->semester ?? '') == 'first semester' ? 'selected' : '' }}>First Semester
            </option>
            <option value="second semester"
                {{ old('semester', $subject->semester ?? '') == 'second semester' ? 'selected' : '' }}>Second Semester
            </option>
            <option value="other" {{ old('semester', $subject->semester ?? '') == 'other' ? 'selected' : '' }}>Other
            </option>
        </select>
    </div>

    {{-- Marks --}}
    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Minimum Mark</label>
        <input type="number" step="0.1" name="min_mark" value="{{ old('min_mark', $subject->min_mark ?? '') }}"
            class="rounded-xl border-gray-200 dark:bg-white/5 dark:border-white/10 dark:text-white focus:ring-indigo-500"
            required>
    </div>

    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Maximum Mark</label>
        <input type="number" step="0.1" name="max_mark" value="{{ old('max_mark', $subject->max_mark ?? '') }}"
            class="rounded-xl border-gray-200 dark:bg-white/5 dark:border-white/10 dark:text-white focus:ring-indigo-500"
            required>
    </div>

    {{-- Track Selection --}}
    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Track</label>
        <select name="track_id"
            class="rounded-xl border-gray-200 dark:bg-[#1a1d29] dark:border-white/10 dark:text-white focus:ring-indigo-500"
            required>
            <option value="">Select Track</option>
            @foreach ($tracks as $track)
                <option value="{{ $track->id }}"
                    {{ old('track_id', $subject->track_id ?? '') == $track->id ? 'selected' : '' }}>
                    {{ $track->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Grade Selection --}}
    <div class="flex flex-col">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Grade</label>
        <select name="grade_id"
            class="rounded-xl border-gray-200 dark:bg-[#1a1d29] dark:border-white/10 dark:text-white focus:ring-indigo-500"
            required>
            <option value="">Select Grade</option>
            @foreach ($grades as $grade)
                <option value="{{ $grade->id }}"
                    {{ old('grade_id', $subject->grade_id ?? '') == $grade->id ? 'selected' : '' }}>
                    {{ $grade->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Description --}}
    <div class="flex flex-col md:col-span-2">
        <label class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Description</label>
        <textarea name="description" rows="3"
            class="rounded-xl border-gray-200 dark:bg-white/5 dark:border-white/10 dark:text-white focus:ring-indigo-500">{{ old('description', $subject->description ?? '') }}</textarea>
    </div>
</div>
