<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen rounded-2xl text-left"
        dir="ltr">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Enrollment</h1>
            <p class="text-sm text-gray-500">Update record for <span
                    class="text-indigo-600 font-bold">{{ $enrollment->student->name }}</span></p>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Student (Disabled in edit usually) --}}
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Student</label>
                        <select name="student_id"
                            class="w-full bg-gray-100 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed"
                            disabled>
                            <option value="{{ $enrollment->student_id }}">{{ $enrollment->student->first_name }}
                            </option>
                        </select>
                        <input type="hidden" name="student_id" value="{{ $enrollment->student_id }}">
                    </div>

                    {{-- Academic Year --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Academic
                            Year</label>
                        <select name="academic_year_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            @foreach ($academicYears as $year)
                                <option value="{{ $year->id }}"
                                    {{ $enrollment->academic_year_id == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Enrollment Date --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Enrollment
                            Date</label>
                        <input type="date" name="enrollment_date"
                            value="{{ $enrollment->enrollment_date->format('Y-m-d') }}"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>

                    {{-- Section --}}
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Section</label>
                        <select name="section_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            @foreach ($sections as $section)
                                @foreach ($grades as $grade)
                                    <option value="{{ $section->id }}"
                                        {{ $enrollment->section_id == $section->id ? 'selected' : '' }}>
                                        {{ $section->name }} ({{ $grade->name }})
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    {{-- Track --}}
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Track</label>
                        <select name="track_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            @foreach ($tracks as $track)
                                <option value="{{ $track->id }}"
                                    {{ $enrollment->track_id == $track->id ? 'selected' : '' }}>
                                    {{ $track->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Cards --}}
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status</label>
                        <div class="flex gap-4">
                            @foreach (['enrolled', 'graduated', 'dropped'] as $status)
                                <label class="flex-1">
                                    <input type="radio" name="status" value="{{ $status }}"
                                        class="hidden peer" {{ $enrollment->status == $status ? 'checked' : '' }}>
                                    <div
                                        class="text-center p-3 rounded-xl border border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400 peer-checked:border-indigo-600 peer-checked:text-indigo-600 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/20 transition-all cursor-pointer font-bold text-sm">
                                        {{ ucfirst($status) }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-24 flex gap-5">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        Update Enrollment
                    </button>
                    <a href="{{ route('enrollments.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 transition-all">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
