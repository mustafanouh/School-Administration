<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Define New Exam</h1>
            <p class="text-sm text-gray-500">Assign exam types to specific subjects and semesters.</p>
        </div>
        <div class="max-w-4xl mx-auto mt-4 px-4">
            {{-- رسالة النجاح --}}
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm transition-all duration-500"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-semibold">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        onclick="this.parentElement.remove()" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- رسالة الخطأ --}}
            @if (session('error'))
                <div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 border border-red-200 shadow-sm transition-all duration-500"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-semibold">
                        {{ session('error') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        onclick="this.parentElement.remove()" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

        </div>
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('exams.store') }}" method="POST" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Subject Selection --}}
                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Subject</label>
                        <select name="subject_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('subject_id') border-rose-500 @enderror">
                            <option disabled>Select Subject</option>
                            @foreach ($subjects as $subject)
                                @foreach ($grades as $grade)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ "$subject->name ($grade->name)" }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Semester Selection --}}
                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Semester</label>
                        <select name="semester_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('semester_id') border-rose-500 @enderror">
                            <option disabled>Select Semester</option>
                            @foreach ($semesters->where('is_active', true) as $semester)
                                @foreach ($academicYears as $academicYear)
                                    <option value="{{ $semester->id }}"
                                        {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                        {{ "$semester->name ($academicYear->name)" }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('semester_id')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Exam Type --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Exam
                            Type</label>



                        <select name="exam_type"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('exam_type') border-rose-500 @enderror">
                            <option disabled>Select Exam Type</option>
                            <option value="final" {{ old('exam_type') == 'final' ? 'selected' : '' }}>Final</option>
                            <option disabled value="project" {{ old('exam_type') == 'project' ? 'selected' : '' }}>
                                project</option>
                            <option disabled value="quiz" {{ old('exam_type') == 'quiz' ? 'selected' : '' }}>Quiz
                            </option>
                        </select>

                        @error('exam_type')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Max Mark --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Maximum
                            Mark</label>
                        <div class="relative">
                            <input type="number" name="max_mark" placeholder="100" value="{{ old('max_mark') }}"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('max_mark') border-rose-500 @enderror">

                        </div>
                        @error('max_mark')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-10 flex gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Save Exam
                    </button>
                    <a href="{{ route('exams.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
