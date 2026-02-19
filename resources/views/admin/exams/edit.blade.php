<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Exam Definition</h1>
            <p class="text-sm text-gray-500">Modify the parameters for this specific assessment.</p>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Subject Selection --}}
                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Subject</label>
                        <select name="subject_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('subject_id') border-rose-500 @enderror">
                            @foreach ($subjects as $subject)
                            @foreach ($grades as $grade)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
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
                            @foreach ($semesters as $semester)
                              @foreach ($academicYears as $academicYear)
                                <option value="{{ $semester->id }}"
                                    {{ old('semester_id', $exam->semester_id) == $semester->id ? 'selected' : '' }}>
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
                        <input type="text" name="exam_type" value="{{ old('exam_type', $exam->exam_type) }}"
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
                            <input type="number" step="0.1" name="max_mark"
                                value="{{ old('max_mark', $exam->max_mark) }}"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all @error('max_mark') border-rose-500 @enderror">
                            <div class="absolute right-4 top-3.5 text-gray-400 font-bold text-xs uppercase">Pts</div>
                        </div>
                        @error('max_mark')
                            <p class="text-rose-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-10 flex gap-4 border-t border-gray-50 dark:border-white/5 pt-8">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all flex items-center justify-center">
                        <i class="fas fa-sync-alt mr-2"></i> Update Exam
                    </button>
                    <a href="{{ route('exams.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 transition-all">
                        Discard Changes
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
