<x-app-layout>
    <div class="py-12 bg-[#F9FBFE] dark:bg-gray-950 min-h-screen font-sans text-slate-800 dark:text-gray-200 max-w-5xl mx-auto sm:px-6 lg:px-8  rounded-2xl "
        dir="ltr">
        <div class=" max-w-6xl mx-auto sm:px-6 lg:px-8  space-y-6">

            {{-- السجل الأكاديمي - Academic Journey --}}
            <div class="space-y-10">
                <div class="flex items-center gap-4 px-2">
                    <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight italic uppercase">
                        Academic Journey
                    </h2>
                    <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-700"></div>
                </div>

                @forelse ($student->enrollments->sortByDesc('academicYear.name') as $enrollment)
                    <div
                        class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden mb-12">

                        {{-- رأس السنة الدراسية --}}
                        <div
                            class="px-8 py-5 border-b border-gray-50 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex flex-wrap justify-between items-center gap-6">
                            <div class="flex items-center gap-6">
                                <span class="w-1 h-8 bg-indigo-500 rounded-full"></span>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white">
                                        {{ $enrollment->academicYear->name ?? 'N/A' }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">
                                        {{ $enrollment->section->grade->name ?? '' }} —
                                        {{ $enrollment->section->name ?? '' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-10 items-center">
                                <div class="text-center">
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1">Average
                                    </p>
                                    <h4 class="text-lg font-black text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($enrollment->average, 2) }}
                                    </h4>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1">Status
                                    </p>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $enrollment->status == 'passed' ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20' : 'text-rose-600 bg-rose-50 dark:bg-rose-900/20' }}">
                                        {{ $enrollment->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-0">
                            @php
                                // تجميع العلامات بناءً على الـ semester_id من علاقة الـ exam
                                $groupedBySemester = $enrollment->marks->groupBy('exam.semester_id');
                            @endphp

                            @forelse($groupedBySemester as $semesterId => $marksInThisSemester)
                                @php
                                    $semesterInfo = $marksInThisSemester->first()->exam->semester;
                                    $semesterName = $semesterInfo ? $semesterInfo->name : 'General Semester';
                                @endphp

                                <div class="mt-4 border-b last:border-0 border-gray-50 dark:border-gray-800">
                                    {{-- عنوان الفصل --}}
                                    <div class="px-8 py-2 bg-indigo-50/30 dark:bg-indigo-900/10">
                                        <span
                                            class="text-[11px] font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
                                            {{ $semesterName }}
                                        </span>
                                    </div>

                                    {{-- جدول العلامات --}}
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left rtl:text-right">
                                            <thead>
                                                <tr
                                                    class="bg-white dark:bg-gray-900 border-b border-gray-50 dark:border-gray-800">
                                                    <th
                                                        class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                                        Subject</th>
                                                    <th
                                                        class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                                        Exam Type</th>
                                                    <th
                                                        class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                                        Score</th>
                                                    <th
                                                        class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                                        Status</th>
                                                    <th
                                                        class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider min-w-[150px]">
                                                        Performance</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                                                @foreach ($marksInThisSemester as $mark)
                                                    <tr
                                                        class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                                        <td class="px-8 py-4">
                                                            <span
                                                                class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                                                {{ $mark->exam->subject->name ?? 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="px-8 py-4 text-xs text-gray-500 dark:text-gray-400 font-medium italic">
                                                            {{ $mark->exam->name ?? 'Final Exam' }}
                                                        </td>
                                                        <td class="px-8 py-4 text-center">
                                                            <span
                                                                class="text-sm font-bold dark:text-white">{{ $mark->score }}</span>
                                                            <span
                                                                class="text-[10px] text-gray-400">/{{ $mark->exam->max_mark ?? 100 }}</span>
                                                        </td>
                                                        <td class="px-8 py-4 text-center">
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $mark->status == 'passed' ? 'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20' : 'text-rose-600 bg-rose-50 dark:bg-rose-900/20' }}">
                                                                {{ $mark->status }}
                                                            </span>
                                                        </td>
                                                        <td class="px-8 py-4">
                                                            <div
                                                                class="w-full h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                                                @php
                                                                    $maxMark =
                                                                        ($mark->exam->max_mark ?? 100) > 0
                                                                            ? $mark->exam->max_mark ?? 100
                                                                            : 100;
                                                                    $percent = ($mark->score / $maxMark) * 100;
                                                                @endphp
                                                                <div class="h-full {{ $mark->status == 'passed' ? 'bg-indigo-500/80' : 'bg-rose-500/80' }} transition-all duration-500"
                                                                    style="width: {{ $percent }}%"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <p class="text-sm text-gray-400 italic">No academic marks recorded for this period.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <div
                        class="bg-white dark:bg-gray-800 rounded-[3rem] p-20 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-400 font-black uppercase tracking-widest text-xs">No enrollment records
                            available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
