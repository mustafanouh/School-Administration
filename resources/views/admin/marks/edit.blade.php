<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr"
        x-data="{
            score: {{ old('score', $mark->score) }},
            maxMark: {{ old('max_mark', $mark->max_mark) }},
            get status() {
                return (this.score >= (this.maxMark / 2)) ? 'passed' : 'failed';
            },
            updateMax(e) {
                const selected = e.target.options[e.target.selectedIndex];
                this.maxMark = selected.dataset.max || 0;
            }
        }">

        <div class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Student Grade</h1>
                <p class="text-sm text-gray-500 italic">Updating record for: <span
                        class="text-indigo-600 font-bold">{{ $mark->enrollment->student->name }}</span></p>
            </div>
            <div class="text-right">
                <span class="text-[10px] font-black uppercase text-gray-400 block tracking-widest">Record ID</span>
                <span class="text-lg font-mono font-bold text-gray-700 dark:text-gray-300">#{{ $mark->id }}</span>
            </div>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('marks.update', $mark->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Student (Disabled in edit for data integrity) --}}
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Student</label>
                        <select name="enrollment_id"
                            class="w-full bg-gray-100 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed"
                            disabled>
                            <option value="{{ $mark->enrollment_id }}">{{ $mark->enrollment->student->name }}</option>
                        </select>
                        <input type="hidden" name="enrollment_id" value="{{ $mark->enrollment_id }}">
                    </div>

                    {{-- Exam Selection --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Exam &
                            Subject</label>
                        <select name="exam_id" @change="updateMax($event)"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}" data-max="{{ $exam->max_mark }}"
                                    {{ old('exam_id', $mark->exam_id) == $exam->id ? 'selected' : '' }}>
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

                    {{-- Hidden Max Mark Field --}}
                    <input type="hidden" name="max_mark" :value="maxMark">

                    {{-- Result Status UI --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Result
                            Status</label>
                        <input type="hidden" name="status" :value="status">
                        <div class="flex items-center gap-4">
                            <template x-if="status == 'passed'">
                                <div
                                    class="flex-1 p-4 rounded-xl bg-emerald-500 text-white font-bold flex items-center justify-center shadow-lg shadow-emerald-500/20">
                                    <i class="fas fa-medal mr-2"></i> PASSED
                                </div>
                            </template>
                            <template x-if="status == 'failed'">
                                <div
                                    class="flex-1 p-4 rounded-xl bg-rose-500 text-white font-bold flex items-center justify-center shadow-lg shadow-rose-500/20">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> FAILED
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/20 transition-all flex items-center justify-center">
                        <i class="fas fa-sync-alt mr-2"></i> Update Record
                    </button>
                    <a href="{{ route('marks.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 transition-all">
                        Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
