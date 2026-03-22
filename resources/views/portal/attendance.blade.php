<x-app-layout>
    <div class="py-12 bg-[#F9FBFE] dark:bg-gray-950 min-h-screen font-sans text-slate-800 dark:text-gray-200 max-w-6xl mx-auto sm:px-6 lg:px-8  rounded-2xl "
        dir="ltr">
        <div class="max-w-7xl mx-auto px-6 space-y-10">

            {{-- عنوان السجل --}}
            <div class="flex items-center gap-4 px-2">
                <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight italic uppercase">
                    Attendance Registry
                </h2>
                <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-700"></div>
            </div>

            @forelse ($student->enrollments->sortByDesc('academicYear.name') as $enrollment)
                <div
                    class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden mb-12">

                    {{-- رأس السنة الدراسية مع إحصائيات سريعة --}}
                    <div
                        class="px-8 py-5 border-b border-gray-50 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex flex-wrap justify-between items-center gap-6">
                        <div class="flex items-center gap-6">
                            <span class="w-1 h-8 bg-emerald-500 rounded-full"></span>
                            <div>
                                <h4 class="text-lg font-bold text-gray-800 dark:text-white">
                                    {{ $enrollment->academicYear->name ?? 'Academic Year' }}
                                </h4>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">
                                    {{ $enrollment->section->grade->name ?? '' }} —
                                    {{ $enrollment->section->name ?? '' }}
                                </p>
                            </div>
                        </div>

                        {{-- ملخص الحضور للسنة --}}
                        <div class="flex gap-6 items-center">
                            @php
                                $totalDays = $enrollment->attendances->count();
                                $presentDays = $enrollment->attendances->where('status', 'present')->count();
                                $absentDays = $enrollment->attendances->where('status', 'absent')->count();
                                $lateDays = $enrollment->attendances->where('status', 'late')->count();
                            @endphp
                            <div class="text-center px-4 border-r border-gray-100 dark:border-gray-700">
                                <p class="text-[9px] text-gray-400 font-bold uppercase mb-1">Present</p>
                                <span class="text-sm font-black text-emerald-600">{{ $presentDays }}</span>
                            </div>
                            <div class="text-center px-4 border-r border-gray-100 dark:border-gray-700">
                                <p class="text-[9px] text-gray-400 font-bold uppercase mb-1">Absent</p>
                                <span class="text-sm font-black text-rose-600">{{ $absentDays }}</span>
                            </div>
                            <div class="text-center px-4">
                                <p class="text-[9px] text-gray-400 font-bold uppercase mb-1">Late</p>
                                <span class="text-sm font-black text-amber-600">{{ $lateDays }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left rtl:text-right">
                                <thead>
                                    <tr class="bg-white dark:bg-gray-900 border-b border-gray-50 dark:border-gray-800">
                                        <th
                                            class="px-10 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                            Date</th>
                                        <th
                                            class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                            Day</th>
                                        <th
                                            class="px-8 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                            Status</th>
                                        <th
                                            class="px-10 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-right">
                                            Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                                    @forelse ($enrollment->attendances->sortByDesc('attendance_date') as $attendance)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/50 transition-colors">
                                            <td class="px-10 py-5">
                                                <div class="flex flex-col">
                                                    <span class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                        {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-center">
                                                <span class="text-[11px] text-gray-400 font-medium italic">
                                                    {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('l') }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-5 text-center">
                                                @php
                                                    $statusClasses = [
                                                        'present' =>
                                                            'text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20',
                                                        'absent' => 'text-rose-600 bg-rose-50 dark:bg-rose-900/20',
                                                        'late' => 'text-amber-600 bg-amber-50 dark:bg-amber-900/20',
                                                        'excused' => 'text-blue-600 bg-blue-50 dark:bg-blue-900/20',
                                                    ];
                                                    $currentClass =
                                                        $statusClasses[$attendance->status] ??
                                                        'text-gray-600 bg-gray-50';
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $currentClass }}">
                                                    {{ $attendance->status }}
                                                </span>
                                            </td>
                                            <td class="px-10 py-5 text-right">
                                                <span class="text-[11px] text-gray-500 italic">
                                                    {{ $attendance->remarks ?? '---' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-12 text-gray-400 italic text-xs">
                                                No attendance logs found for this year.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
</x-app-layout>
