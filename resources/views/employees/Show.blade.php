<x-app-layout>
    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. بطاقة بيانات الموظف - Employee Hero Card --}}
            <div
                class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
                {{-- خلفية جمالية --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full -mr-16 -mt-16"></div>

                <div class="relative p-8 md:p-10">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">

                        {{-- الصورة الشخصية (الحرف الأول) --}}
                        <div class="flex-none">
                            <div
                                class="h-28 w-28 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg shadow-emerald-200 dark:shadow-none ring-4 ring-white dark:ring-gray-700">
                                {{ substr($employee->first_name, 0, 1) }}
                            </div>
                        </div>

                        {{-- المعلومات الأساسية --}}
                        <div class="flex-grow text-center md:text-left rtl:md:text-right">
                            <div class="flex flex-col md:flex-row md:items-center gap-3">
                                <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </h1>
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase rounded-full w-fit mx-auto md:mx-0">
                                    {{ $employee->user->getRoleNames()->implode(', ') }}
                                </span>
                            </div>

                            {{-- شبكة البيانات التفصيلية --}}
                            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-6">
                                {{-- الرقم الوطني --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-id-card mr-1"></i> National ID
                                    </p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $employee->notional_id }}
                                    </p>
                                </div>

                                {{-- تاريخ التعيين --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-calendar-check mr-1"></i> Hire Date
                                    </p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $employee->hire_data }}
                                    </p>
                                </div>

                                {{-- المسمى الوظيفي --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-briefcase mr-1"></i> Position
                                    </p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $employee->job_title }}
                                    </p>
                                </div>

                                {{-- الراتب --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-money-bill-wave mr-1"></i> Salary
                                    </p>
                                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1">
                                        ${{ number_format($employee->salary, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- أزرار التحكم --}}
                        <div class="flex-none">
                            <a href="{{ url()->previous() }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-2xl text-xs font-black hover:bg-gray-200 transition-all uppercase tracking-widest">
                                <i class="fas fa-arrow-left mr-2 rtl:ml-2"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 2. قسم معلومات التواصل والموقع - Contact & Location --}}
                <div class="bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- بيانات الهاتف --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-none">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Contact
                                    Information</p>

                                <h3 class="text-sm font-black text-gray-800 dark:text-white">Phone Number</h3>
                                <div class="flex flex-col gap-1 mt-2 mb-2">
                                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $employee->phone }}</span>
                                </div>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">Email Address</h3>
                                <div class="flex flex-col gap-1 mt-2">
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-300">{{ $employee->user->email }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- بيانات العنوان --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-none">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Location
                                    Details</p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">Residential Address</h3>
                                <div class="flex flex-col gap-1 mt-2">
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-300">{{ $employee->address }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Attendance Overview --}}
            </div>
            <div class="mt-8 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center">
                        <div
                            class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-500 mr-3">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Present</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $employee->staffAttendances->where('status', 'present')->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center">
                        <div
                            class="w-10 h-10 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-500 mr-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Late</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $employee->staffAttendances->where('status', 'late')->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center">
                        <div
                            class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center text-red-500 mr-3">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Absent</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $employee->staffAttendances->where('status', 'absent')->count() }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center">
                        <div
                            class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-500 mr-3">
                            <i class="fas fa-plane-departure"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">On Leave</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $employee->staffAttendances->where('status', 'on_leave')->count() }}</p>
                        </div>
                    </div>





                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                        <h3 class="text-xs font-bold text-gray-600 uppercase tracking-widest">Employee Attendance
                            Log
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Check In
                                    </th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Check Out
                                    </th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase text-center">
                                        Status
                                    </th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($employee->staffAttendances as $attendance)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span
                                                class="block text-sm font-medium text-gray-700">{{ $attendance->attendance_date }}</span>
                                            <span
                                                class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('l') }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600">
                                            {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('g:i A') : '—' }}
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600">
                                            {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('g:i A') : '—' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $badgeClasses = [
                                                    'present' => 'bg-green-50 text-green-600 border-green-100',
                                                    'absent' => 'bg-red-50 text-red-500 border-red-100',
                                                    'on_leave' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                    'late' => 'bg-yellow-50 text-yellow-600 border-yellow-100',
                                                ];
                                                $class =
                                                    $badgeClasses[$attendance->status] ??
                                                    'bg-gray-50 text-gray-500 border-gray-100';
                                            @endphp
                                            <span
                                                class="px-2 py-1 rounded border text-[10px] font-bold uppercase {{ $class }}">
                                                {{ str_replace('_', ' ', $attendance->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-400 italic">
                                            {{ Str::limit($attendance->notes, 30) ?? '—' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-300 text-sm italic">
                                            No attendance records found for this employee.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
