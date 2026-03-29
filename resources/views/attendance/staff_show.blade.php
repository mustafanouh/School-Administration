<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Staff Attendance Registry</h1>
                <p class="text-sm text-gray-500 font-medium">Daily check-in for all employees |
                    {{ now()->format('M d, Y') }}</p>
            </div>
            <div class="flex gap-2">
                <span
                    class="px-4 py-2 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 text-xs font-bold rounded-xl flex items-center">
                    <i class="fas fa-clock mr-2"></i> Current Time: {{ now()->format('H:i') }}
                </span>
            </div>
        </div>


        {{-- Alerts --}}
        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm"
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
                <button type="button" class="ms-auto bg-green-50 text-green-500 p-1.5 hover:bg-green-200 rounded-lg"
                    onclick="this.parentElement.remove()">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- رسالة تأكيد أخذ الحضور --}}
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

        <form action="{{ route('attendance.staff.store') }}" method="POST">
            @csrf
            <input type="hidden" name="attendance_date" value="{{ now()->format('Y-m-d') }}">

            <div
                class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    Employee</th>
                                <th
                                    class="px-8 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                    Status</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Time
                                    In/Out</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider w-1/4">
                                    Notes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                            @forelse($staff as $employee)
                                @php
                                    $todayRecord = $employee->staffAttendances->first();

                                    $currentStatus = old("attendance.{$employee->id}", $todayRecord?->status);
                                    $checkIn = old("check_in.{$employee->id}", $todayRecord?->check_in ?? '08:00');
                                    $checkOut = old("check_out.{$employee->id}", $todayRecord?->check_out ?? '16:00');
                                    $note = old("notes.{$employee->id}", $todayRecord?->notes);
                                @endphp

                                <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 font-bold">
                                                {{ substr($employee->first_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800 dark:text-white">
                                                    {{ $employee->first_name }} {{ $employee->last_name }}</div>
                                                <div class="text-[10px] text-gray-500 uppercase">
                                                    {{ $employee->position ?? 'Staff Member' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-1 py-4 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $employee->id }}]"
                                                    value="present" class="hidden peer" @checked($currentStatus === 'present' || is_null($currentStatus))>
                                                <span
                                                    class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-white/5 peer-checked:bg-emerald-500 peer-checked:text-white text-gray-500 transition-all">Present</span>
                                            </label>

                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $employee->id }}]"
                                                    value="absent" class="hidden peer" @checked($currentStatus === 'absent')>
                                                <span
                                                    class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-white/5 peer-checked:bg-rose-500 peer-checked:text-white text-gray-500 transition-all">Absent</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $employee->id }}]"
                                                    value="late" class="hidden peer" @checked($currentStatus === 'late')>
                                                <span
                                                    class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-white/5 peer-checked:bg-amber-500 peer-checked:text-white text-gray-500 transition-all">Late</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="attendance[{{ $employee->id }}]"
                                                    value="on_leave" class="hidden peer" @checked($currentStatus === 'on_leave' || (is_null($todayRecord) && $employee->status === 'on_leave'))>
                                                <span
                                                    class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-white/5 peer-checked:bg-blue-500 peer-checked:text-white text-gray-500 transition-all">On
                                                    Leave</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <input type="time" name="check_in[{{ $employee->id }}]"
                                                value="{{ $checkIn }}"
                                                class="bg-gray-50 dark:bg-white/5 border-none rounded-lg text-[11px] text-gray-600 dark:text-gray-300 focus:ring-1 focus:ring-indigo-500">
                                            <input type="time" name="check_out[{{ $employee->id }}]"
                                                value="{{ $checkOut }}"
                                                class="bg-gray-50 dark:bg-white/5 border-none rounded-lg text-[11px] text-gray-600 dark:text-gray-300 focus:ring-1 focus:ring-indigo-500">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="text" name="notes[{{ $employee->id }}]"
                                            value="{{ $note }}" placeholder="Remarks..."
                                            class="w-full bg-gray-50 dark:bg-white/5 border-none rounded-lg text-xs py-2 px-3 text-gray-600 dark:text-gray-300 focus:ring-1 focus:ring-indigo-500">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">No employees found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div
                    class="p-6 bg-gray-50/50 dark:bg-white/5 border-t border-gray-100 dark:border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        {{ $isAttendanceTaken ? 'Update Attendance Records' : 'Save Staff Attendance' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
