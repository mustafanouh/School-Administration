<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Define New Exam</h1>
            <p class="text-sm text-gray-500">Assign exam types to specific subjects and semesters.</p>
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
                            <option value="">Select Subject</option>
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
                            <option value="">Select Semester</option>
                            @foreach ($semesters as $semester)
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
                        <input type="text" name="exam_type" placeholder="e.g. Midterm, Final, Quiz"
                            value="{{ old('exam_type') }}"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('exam_type') border-rose-500 @enderror">
                        @error('exam_type')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Max Mark --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Maximum
                            Mark</label>
                        <div class="relative">
                            <input type="number" step="0.1" name="max_mark" placeholder="100"
                                value="{{ old('max_mark') }}"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('max_mark') border-rose-500 @enderror">
                            <div class="absolute right-4 top-3.5 text-gray-400 font-bold text-xs uppercase">Pts</div>
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
