<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr"
        x-data="{
            score: 0,
            maxMark: 0,
            get status() {
                return (this.score >= (this.maxMark / 2)) ? 'passed' : 'failed';
            },
            updateMax(e) {
                const selected = e.target.options[e.target.selectedIndex];
                this.maxMark = selected.dataset.max || 0;
            }
        }">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white text-left">Record Student Mark</h1>
            <p class="text-sm text-gray-500">Assign a grade to a student for a specific exam.</p>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('marks.store') }}" method="POST" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Enrollment Selection --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Student
                            (Enrollment)</label>
                        <select name="enrollment_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            <option value="">Select Student</option>
                            @foreach ($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}"
                                    {{ old('enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                    {{ $enrollment->student->name }} - (ID: {{ $enrollment->id }})
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Exam Selection --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Exam &
                            Subject</label>
                        <select name="exam_id" @change="updateMax($event)"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            <option value="">Select Exam</option>
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}" data-max="{{ $exam->max_mark }}"
                                    {{ old('exam_id') == $exam->id ? 'selected' : '' }}>
                                    {{ $exam->subject->name }} - {{ $exam->exam_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_id')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Score --}}
                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Score</label>
                        <div class="relative">
                            <input type="number" step="0.1" name="score" x-model="score"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            <div class="absolute right-4 top-3 text-gray-400 font-bold">
                                / <span x-text="maxMark">0</span>
                            </div>
                        </div>
                        @error('score')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hidden Max Mark Field (to match your schema) --}}
                    <input type="hidden" name="max_mark" :value="maxMark">

                    {{-- Status Display --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Result
                            Status</label>
                        <div class="flex gap-4">
                            <input type="hidden" name="status" :value="status">
                            <template x-if="status == 'passed'">
                                <div
                                    class="w-full p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-600 font-bold flex items-center justify-center">
                                    <i class="fas fa-check-circle mr-2 text-xl"></i> PASSED
                                </div>
                            </template>
                            <template x-if="status == 'failed'">
                                <div
                                    class="w-full p-4 rounded-xl bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-600 font-bold flex items-center justify-center">
                                    <i class="fas fa-times-circle mr-2 text-xl"></i> FAILED
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i> Save Grade
                    </button>
                    <a href="{{ route('marks.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
