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
                        <div x-data="{ open: false, imageUrl: null }" class="relative">
                            <div class="flex-none relative group">
                                <div
                                    class="h-28 w-28 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg ring-4 ring-white dark:ring-gray-700 overflow-hidden">
                                    @if ($employee->hasMedia('employee_profile_photos'))
                                        <img src="{{ $employee->getFirstMediaUrl('employee_profile_photos') }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        {{ substr($employee->first_name, 0, 1) }}
                                    @endif
                                </div>

                                <button type="button" @click="open = true"
                                    class="absolute -bottom-2 -right-2 p-2 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-600 text-emerald-600 hover:scale-110 transition-transform z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>

                            <div x-show="open" x-cloak style="display: none;"
                                class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">

                                <div @click.away="open = false"
                                    class="bg-white dark:bg-gray-800 rounded-3xl p-6 w-full max-w-md shadow-2xl border border-white/10">

                                    <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-white text-center">Update
                                        Profile Picture</h3>

                                    <form action="{{ route('employees.updatePhoto', $employee->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="mb-6 flex justify-center">
                                            <div
                                                class="h-44 w-44 rounded-2xl border-2 border-dashed border-emerald-500/30 dark:border-gray-600 flex items-center justify-center overflow-hidden bg-emerald-50/30 dark:bg-gray-900 relative">
                                                <template x-if="imageUrl">
                                                    <img :src="imageUrl" class="h-full w-full object-cover">
                                                </template>

                                                <template x-if="!imageUrl">
                                                    <div class="text-center p-4">
                                                        <svg class="mx-auto h-12 w-12 text-gray-300"
                                                            stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                            <path
                                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 005.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                        <span class="text-gray-400 text-xs mt-2 block">Waiting for image
                                                            selection</span>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <div class="mb-6">
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                                                source image</label>
                                            <input type="file" name="photo" accept="image/*"
                                                @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => { imageUrl = e.target.result; };
                                    reader.readAsDataURL(file);
                                }
                           "
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor-pointer">
                                        </div>

                                        <div class="flex gap-3 mt-8">
                                            <button type="submit"
                                                class="flex-1 bg-emerald-600 text-white py-3 rounded-2xl font-bold hover:bg-emerald-700 transition-all active:scale-95">Save
                                                Changes</button>
                                            <button type="button" @click="open = false; imageUrl = null"
                                                class="flex-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 py-3 rounded-2xl font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">Cancel</button>
                                        </div>
                                    </form>
                                </div>
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
                                    <span
                                        class="text-sm text-gray-600 dark:text-gray-300">{{ $employee->phone }}</span>
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
                                        <td colspan="5"
                                            class="px-6 py-12 text-center text-gray-300 text-sm italic">
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
