<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Student Attendance</h1>
                <p class="text-sm text-gray-500 font-medium">Section: <span
                        class="text-indigo-600 dark:text-indigo-400">{{ $section->name }}</span> | Date:
                    {{ now()->format('M d, Y') }}</p>
            </div>
            <a href="{{ route('attendance.sections.index') }}"
                class="px-5 py-2.5 bg-gray-200 dark:bg-white/5 hover:bg-gray-300 dark:hover:bg-white/10 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-xl transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Back to Sections
            </a>
        </div>

        {{-- Alert Messages --}}
        <div class="max-w-5xl mx-auto mt-4">
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
                    <button type="button"
                        class="ms-auto bg-green-50 text-green-500 p-1.5 hover:bg-green-200 rounded-lg h-8 w-8"
                        onclick="this.parentElement.remove()">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        @if ($isAttendanceTaken)
            <div
                class="mb-6 flex items-center p-4 text-blue-800 rounded-2xl bg-blue-50 dark:bg-blue-900/20 dark:text-blue-400 border border-blue-100 dark:border-blue-800 shadow-sm">
                <div class="flex-shrink-0 bg-blue-500 text-white rounded-full p-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ms-3 text-sm font-bold">
                    Attendance for today ({{ now()->format('d M, Y') }}) has already been recorded.
                    <span class="font-normal opacity-80 italic">| You can still update the records below.</span>
                </div>
            </div>
        @endif

        {{-- Attendance Form --}}
        <form action="{{ route('attendance.student.store') }}" method="POST">
            @csrf
            <input type="hidden" name="section_id" value="{{ $section->id }}">
            <input type="hidden" name="attendance_date" value="{{ now()->format('Y-m-d') }}">

            <div
                class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider w-1/3">
                                    Student Details</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Status</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Notes
                                    / Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                            @forelse($section->enrollments as $enrollment)
                                @php
                                    // جلب سجل الحضور المسجل مسبقاً للطالب من العلاقة
                                    // تأكد أن الموديل Student لديه علاقة اسمها attendances
                                    $todayRecord = $enrollment->student->attendances->first();

                                    // تحديد الحالة الحالية (الأولوية للبيانات القديمة في حال الخطأ، ثم قاعدة البيانات، ثم الافتراضي)
                                    $currentStatus = old("attendance.{$enrollment->id}", $todayRecord?->status);
                                    $note = old("notes.{$enrollment->id}", $todayRecord?->notes);
                                @endphp

                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    {{-- Student Info --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-9 h-9 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($enrollment->student->first_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800 dark:text-white">
                                                    {{ $enrollment->student->first_name }}
                                                    {{ $enrollment->student->last_name }}
                                                </div>
                                                <div class="text-[10px] text-gray-400 uppercase tracking-tight">ID:
                                                    #{{ $enrollment->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Attendance Status Options --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-4">
                                            {{-- Present --}}
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="attendance[{{ $enrollment->id }}]"
                                                    value="present" class="w-4 h-4 text-emerald-500 ..."
                                                    @checked($currentStatus === 'present' || is_null($currentStatus))>
                                                <span
                                                    class="text-xs font-semibold ... group-hover:text-emerald-500">Present</span>
                                            </label>

                                            {{-- Absent --}}
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="attendance[{{ $enrollment->id }}]"
                                                    value="absent" class="w-4 h-4 text-rose-500 ..."
                                                    @checked($currentStatus === 'absent')>
                                                <span
                                                    class="text-xs font-semibold ... group-hover:text-rose-500">Absent</span>
                                            </label>

                                            {{-- Late --}}
                                            <label class="flex items-center gap-2 cursor-pointer group">
                                                <input type="radio" name="attendance[{{ $enrollment->id }}]"
                                                    value="late" class="w-4 h-4 text-amber-500 ..."
                                                    @checked($currentStatus === 'late')>
                                                <span
                                                    class="text-xs font-semibold ... group-hover:text-amber-500">Late</span>
                                            </label>
                                        </div>
                                    </td>


                                    {{-- Notes Input --}}
                                    <td class="px-6 py-4">
                                        <input type="text" name="notes[{{ $enrollment->id }}]"
                                            value="{{ $note ?? '' }}" placeholder="Reason for absence..."
                                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-2 text-xs text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-400 italic">
                                        No students enrolled in this section.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer Action --}}
                <div
                    class="p-6 bg-gray-50/50 dark:bg-white/5 border-t border-gray-100 dark:border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all flex items-center gap-2">
                        {{ $isAttendanceTaken ? 'Update Attendance Sheet' : 'Submit Attendance Sheet' }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
