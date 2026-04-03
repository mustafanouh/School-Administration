<x-app-layout>
    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. Profile Hero Card --}}
            <div
                class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">

                {{-- Header Background --}}
                <div class="bg-gray-50/80 dark:bg-gray-900/50 px-8 md:px-10 pt-8 pb-0 flex items-end gap-6">

                    {{-- Avatar with Upload --}}
                    <div x-data="{ open: false, imageUrl: null }" class="relative mb-[-1rem]">
                        <div class="flex-none relative group">
                            <div
                                class="h-24 w-24 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg ring-4 ring-white dark:ring-gray-800 overflow-hidden">
                                @if ($user->employee && $user->employee->hasMedia('employee_profile_photos'))
                                    <img src="{{ $user->employee->getFirstMediaUrl('employee_profile_photos') }}"
                                        class="h-full w-full object-cover">
                                @elseif ($roleName === 'student')
                                    {{ substr($user->student->first_name, 0, 1) }}
                                @else
                                    {{ substr($user->employee->first_name, 0, 1) }}
                                @endif
                            </div>
                            <button type="button" @click="open = true"
                                class="absolute -bottom-2 -right-2 p-2 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-600 text-emerald-600 hover:scale-110 transition-transform z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>

                        {{-- Upload Modal --}}
                        <div x-show="open" x-cloak style="display: none;"
                            class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                            <div @click.away="open = false"
                                class="bg-white dark:bg-gray-800 rounded-3xl p-6 w-full max-w-md shadow-2xl border border-white/10">
                                <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-white text-center">Update
                                    Profile Picture</h3>
                                <form action="{{ route('employees.updatePhoto', $user->employee->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-6 flex justify-center">
                                        <div
                                            class="h-44 w-44 rounded-2xl border-2 border-dashed border-emerald-500/30 dark:border-gray-600 flex items-center justify-center overflow-hidden bg-emerald-50/30 dark:bg-gray-900 relative">
                                            <template x-if="imageUrl"><img :src="imageUrl"
                                                    class="h-full w-full object-cover"></template>
                                            <template x-if="!imageUrl">
                                                <div class="text-center p-4">
                                                    <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor"
                                                        fill="none" viewBox="0 0 48 48">
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
                                            @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { imageUrl = e.target.result; }; reader.readAsDataURL(file); }"
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

                    {{-- Name & Badges --}}
                    <div class="pb-6 flex-grow">
                        <div class="flex flex-col md:flex-row md:items-center gap-3 flex-wrap">
                            <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">
                                @if ($roleName === 'student')
                                    {{ $user->student->first_name }} {{ $user->student->last_name }}
                                @else
                                    {{ $user->employee->first_name }} {{ $user->employee->last_name }}
                                @endif
                            </h1>
                            <span
                                class="inline-flex items-center px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase rounded-full w-fit">
                                {{ $roleName }}
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase rounded-full w-fit">
                                {{ $roleName === 'student' ? 'Academic Record' : $user->employee->job_title ?? 'Staff Member' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">{{ $user->email }}</p>
                    </div>

                    {{-- Edit Buttons --}}
                    <div class="pb-6 flex gap-2 flex-none">
                        @php $editRoute = $roleName === 'student' ? route('students.edit', $user->student->id ?? 0) : route('employees.edit', $user->employee->id ?? 0); @endphp
                        <a href="{{ $editRoute }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-black hover:bg-gray-200 transition-all uppercase tracking-widest gap-1">
                            <i class="fas fa-user-edit"></i> Edit
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-black hover:bg-gray-200 transition-all uppercase tracking-widest gap-1">
                            <i class="fas fa-key"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="px-8 md:px-10 py-6 grid grid-cols-2 md:grid-cols-4 gap-y-6 gap-x-8">
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                class="fas fa-venus-mars mr-1"></i> Gender</p>
                        <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                            {{ $user->student->gender ?? ($user->employee->gender ?? 'N/A') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                            <i class="fas fa-calendar-check mr-1"></i>
                            {{ $roleName === 'student' ? 'Birth Date' : 'Hire Date' }}
                        </p>
                        <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                            {{ $user->student->date_of_birth ?? ($user->employee->hire_data ?? 'N/A') }}
                        </p>
                    </div>
                    <div>
                        @if ($roleName === 'student')
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                    class="fas fa-tint mr-1"></i> Blood Group</p>
                            <p class="text-sm font-bold text-red-500 mt-1">{{ $user->student->blood_group ?? 'N/A' }}
                            </p>
                        @else
                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                    class="fas fa-money-bill-wave mr-1"></i> Net Salary</p>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1">
                                ${{ number_format($user->employee->salary ?? 0, 0) }}</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                class="fas fa-circle mr-1"></i> Status</p>
                        <p
                            class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1 flex items-center gap-1">
                            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ $roleName === 'student' ? 'Enrolled' : $user->employee->status ?? 'Active' }}
                        </p>
                    </div>
                </div>

                {{-- Contact & Location --}}
                <div class="bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $user->student->phone_number ?? ($user->employee->phone ?? 'N/A') }}
                                </p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white mt-2">Email Address</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
                            </div>
                        </div>

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
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $user->student->address ?? ($user->employee->address ?? 'N/A') }}
                                </p>
                                @if ($roleName === 'student')
                                    <p class="text-xs text-gray-400 mt-1 italic">Place of birth:
                                        {{ $user->student->place_of_birth }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Family Info (Students Only) --}}
            @if ($roleName === 'student')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="flex items-start gap-4 p-6 bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-700">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-none">
                            <i class="fas fa-user-tie text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">Father's
                                Details</p>
                            <p class="text-base font-bold text-gray-800 dark:text-white">
                                {{ $user->student->father_name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                {{ $user->student->father_phone_number }}</p>
                            <p class="text-xs text-blue-400 mt-1">{{ $user->student->father_email }}</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start gap-4 p-6 bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-700">
                        <div
                            class="w-12 h-12 rounded-2xl bg-pink-50 dark:bg-pink-900/30 flex items-center justify-center text-pink-500 dark:text-pink-400 flex-none">
                            <i class="fas fa-female text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-pink-500 uppercase tracking-widest mb-1">Mother's
                                Details</p>
                            <p class="text-base font-bold text-gray-800 dark:text-white">
                                {{ $user->student->mother_name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                {{ $user->student->mother_phone_number }}</p>
                            <p class="text-xs text-pink-400 mt-1">{{ $user->student->mother_email }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Attendance Stats --}}
            @if ($roleName !== 'student')
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div
                        class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-green-50 dark:bg-green-900/30 rounded-full flex items-center justify-center text-green-500">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Present</p>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $user->employee->staffAttendances->where('status', 'present')->count() }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-yellow-50 dark:bg-yellow-900/30 rounded-full flex items-center justify-center text-yellow-500">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Late</p>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $user->employee->staffAttendances->where('status', 'late')->count() }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-red-50 dark:bg-red-900/30 rounded-full flex items-center justify-center text-red-500">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Absent</p>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $user->employee->staffAttendances->where('status', 'absent')->count() }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-500">
                            <i class="fas fa-plane-departure"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">On Leave</p>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $user->employee->staffAttendances->where('status', 'on_leave')->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Attendance Table --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div
                        class="px-6 py-4 border-b border-gray-50 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30">
                        <h3 class="text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-widest">
                            Employee Attendance Log</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-gray-900/30">
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Check In</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Check Out</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase text-center">
                                        Status</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @forelse($user->employee->staffAttendances as $attendance)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <span
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ $attendance->attendance_date }}</span>
                                            <span
                                                class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('l') }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600 dark:text-gray-300">
                                            {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('g:i A') : '—' }}
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-600 dark:text-gray-300">
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
                                            No attendance records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
