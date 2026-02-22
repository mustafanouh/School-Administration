<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl border border-gray-100 dark:border-white/5 overflow-hidden">

                <div class="p-8 md:p-12">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black text-gray-800 dark:text-white italic">Assign New Teacher</h2>
                        <i class="fas fa-chalkboard-teacher text-3xl text-blue-500"></i>
                    </div>

                    <form action="{{ route('teacher_subjects.store') }}" method="POST">
                        @csrf

                        {{-- الحقول المخفية الممررة من صفحة الـ Show --}}
                        <input type="hidden" name="section_id" value="{{ request('section_id') }}">
                        <input type="hidden" name="academic_year_id" value="{{ request('academic_year_id') }}">

                        <div class="space-y-6">
                            {{-- عرض معلومات الشعبة والسنة (للتأكيد فقط) --}}
                            <div
                                class="grid grid-cols-2 gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100">
                                <div>
                                    <span class="block text-[10px] font-bold text-blue-400 uppercase">Section</span>
                                    <span
                                        class="font-bold text-blue-700 dark:text-blue-300">{{ App\Models\Section::find(request('section_id'))->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold text-blue-400 uppercase">Academic
                                        Year</span>
                                    <span
                                        class="font-bold text-blue-700 dark:text-blue-300">{{ App\Models\AcademicYear::find(request('academic_year_id'))->name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            {{-- اختيار المعلم --}}
                            <div>
                                <label
                                    class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Select
                                    Teacher</label>
                                <select name="teacher_id" required
                                    class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-blue-500/10 outline-none">
                                    <option value="">-- Choose a Teacher --</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->employee->first_name }}
                                            {{ $teacher->employee->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- اختيار المادة --}}
                            <div>
                                <label
                                    class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Subject</label>
                                <select name="subject_id" required
                                    class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-blue-500/10 outline-none">
                                    <option value="">-- Choose a Subject --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-10 flex gap-4">
                            <button type="submit"
                                class="flex-1 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-1">
                                Confirm Assignment
                            </button>
                            <a href="{{ route('sections.show', request('section_id')) }}"
                                class="px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-500 font-bold rounded-2xl text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
