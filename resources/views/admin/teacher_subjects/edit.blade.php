<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl border border-gray-100 dark:border-white/5 overflow-hidden">
                <div class="p-8 md:p-12">

                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <h2 class="text-2xl font-black text-gray-800 dark:text-white italic">Edit Assignment</h2>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-tighter mt-1">Modify teacher and
                                subject link</p>
                        </div>
                        <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-2xl text-amber-600">
                            <i class="fas fa-edit text-2xl"></i>
                        </div>
                    </div>

                    <form action="{{ route('teacher_subjects.update', $teacherSubject) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">

                            {{-- Teacher Selection --}}
                            <div>
                                <label
                                    class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Teacher</label>
                                <select name="teacher_id"
                                    class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $teacherSubject->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->employee->first_name }} {{ $teacher->employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Subject Selection --}}
                                <div>
                                    <label
                                        class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Subject</label>
                                    <select name="subject_id"
                                        class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $teacherSubject->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Section Selection --}}
                                <div>
                                    <label
                                        class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Section</label>
                                    <select name="section_id"
                                        class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ $teacherSubject->section_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Academic Year --}}
                            <div>
                                <label
                                    class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Academic
                                    Year</label>
                                <select name="academic_year_id"
                                    class="w-full p-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none">
                                    @foreach ($academicYears as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $teacherSubject->academic_year_id == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="mt-12 flex flex-col sm:flex-row gap-4">
                            <button type="submit"
                                class="flex-1 px-8 py-4 bg-gray-900 dark:bg-indigo-600 text-white font-black rounded-2xl shadow-xl hover:bg-black dark:hover:bg-indigo-700 transition-all transform hover:-translate-y-1">
                                Save Changes
                            </button>
                            <a href="{{ route('sections.show', $teacherSubject->section_id) }}"
                                class="px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300 font-bold rounded-2xl text-center transition-all hover:bg-gray-200">
                                Discard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
