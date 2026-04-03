<x-app-layout>
    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. بطاقة الهوية الشخصية - Student Hero Card --}}
            <div
                class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full -mr-16 -mt-16"></div>

                <div class="relative p-8 md:p-10">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        {{-- الصورة الشخصية أو الحرف الأول --}}
                      
                        <div x-data="{ open: false, imageUrl: null }" class="relative">
                            <div class="flex-none relative group">
                                <div
                                    class="h-28 w-28 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg ring-4 ring-white dark:ring-gray-700 overflow-hidden">
                                    @if ($student->hasMedia('student_profile_photos'))
                                        <img src="{{ $student->getFirstMediaUrl('student_profile_photos') }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        {{ substr($student->first_name, 0, 1) }}
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

                                    <form action="{{ route('students.updatePhoto', $student->id) }}" method="POST"
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
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </h1>
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase rounded-full w-fit mx-auto md:mx-0">
                                    Active Student
                                </span>
                            </div>

                            {{-- شبكة البيانات التفصيلية --}}
                            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-6">
                                {{-- جنس الطالب --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-venus-mars mr-1"></i> Gender</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1 uppercase">
                                        {{ $student->gender }}</p>
                                </div>
                                {{-- تاريخ الميلاد --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-calendar-alt mr-1"></i> Birth Date</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->date_of_birth }}</p>
                                </div>
                                {{-- مكان الميلاد --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-map-marker-alt mr-1"></i> Place of Birth</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->place_of_birth }}</p>
                                </div>
                                {{-- الجنسية --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-flag mr-1"></i> Nationality</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->nationality }}</p>
                                </div>
                                {{-- فصيلة الدم --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-tint mr-1"></i> Blood Group</p>
                                    <p class="text-sm font-bold text-rose-600 dark:text-rose-400 mt-1">
                                        {{ $student->blood_group ?? 'N/A' }}</p>
                                </div>
                                {{-- هاتف الطالب --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-phone mr-1"></i> Personal Phone</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->phone_number }}</p>
                                </div>
                                {{-- العنوان --}}
                                <div class="col-span-2">
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-home mr-1"></i> Address</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->address }}</p>
                                </div>

                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest"><i
                                            class="fas fa-envelope mr-1"></i> Email</p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $student->user->email }}</p>
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

                {{-- 2. قسم بيانات الوالدين - Family Contacts Section --}}
                <div class="bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- بيانات الأب --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 flex-none">
                                <i class="fas fa-user-tie text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">Father's
                                    Information</p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">
                                    {{ $student->father_name }}</h3>
                                <div class="flex flex-col gap-1 mt-2">
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><i
                                            class="fas fa-phone-alt mr-2"></i>
                                        {{ $student->father_phone_number }}</span>
                                    @if ($student->father_email)
                                        <span class="text-xs text-gray-500 dark:text-gray-400"><i
                                                class="fas fa-envelope mr-2"></i> {{ $student->father_email }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- بيانات الأم --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-rose-50 dark:bg-rose-900/30 flex items-center justify-center text-rose-600 dark:text-rose-400 flex-none">
                                <i class="fas fa-female text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest">Mother's
                                    Information</p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">
                                    {{ $student->mother_name }}</h3>
                                <div class="flex flex-col gap-1 mt-2">
                                    <span class="text-xs text-gray-500 dark:text-gray-400"><i
                                            class="fas fa-phone-alt mr-2"></i>
                                        {{ $student->mother_phone_number }}</span>
                                    @if ($student->mother_email)
                                        <span class="text-xs text-gray-500 dark:text-gray-400"><i
                                                class="fas fa-envelope mr-2"></i> {{ $student->mother_email }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- و ========================== --}}
            <div class="mt-8 space-y-6">
                <div class="flex items-center gap-4 px-2">
                    <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight italic">
                        Attendance student
                    </h2>
                    <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-700"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">


                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center">
                        <div
                            class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-500 mr-3">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase">Present</p>
                            <p class="text-lg font-bold text-gray-800">
                                {{ $student->attendances->where('status', 'present')->count() }}</p>
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
                                {{ $student->attendances->where('status', 'late')->count() }}</p>
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
                                {{ $student->attendances->where('status', 'absent')->count() }}</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 shadow-sm rounded-lg">
                        <div class="flex items-center">
                            <div class="text-center">
                                <p class="text-sm text-blue-700 font-bold">Total Dayes</p>
                                <p class="text-2xl font-black text-blue-900">
                                    {{ $student->attendances?->count() ?? 0 }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Attendance Details</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-sm">
                                    <th class="px-6 py-3 font-bold uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 font-bold uppercase tracking-wider">Day</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 font-bold uppercase tracking-wider">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($student->attendances?->sortByDesc('attendance_date') ?? [] as $attendance)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-gray-900 font-medium">
                                            {{ $attendance->attendance_date }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 text-sm">
                                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('l') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if ($attendance->status == 'present')
                                                <span
                                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold capitalize">Present</span>
                                            @elseif($attendance->status == 'absent')
                                                <span
                                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold capitalize">Absent</span>
                                            @else
                                                <span
                                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold capitalize">{{ $attendance->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-400 text-sm italic">
                                            {{ $attendance->notes ?? 'No notes' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-user-slash mb-2 fa-2x"></i>
                                                <p>No attendance records found for this student in the current term.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- 3. السجل الأكاديمي - Academic Journey --}}
            <div class="space-y-10">
                <div class="flex items-center gap-4 px-2">
                    <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight italic">Academic
                        Journey
                    </h2>
                    <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-700"></div>
                </div>


                @forelse ($student->enrollments->sortByDesc('academicYear.name') as $enrollment)
                    <div
                        class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden mb-12">

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
                                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-1">
                                        Average
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
                            @php $groupedBySemester = $enrollment->marks->groupBy('exam.semester_id'); @endphp

                            @forelse($groupedBySemester as $semesterId => $marksInThisSemester)
                                @php
                                    $semesterInfo = $marksInThisSemester->first()->exam->semester;
                                    $semesterName = $semesterInfo ? $semesterInfo->name : 'General Semester';
                                @endphp

                                <div class="mt-4">
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
                                            <thead class="bg-white dark:bg-gray-900">
                                                <tr>
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
                                                            {{ $mark->exam->exam_type }}
                                                        </td>
                                                        <td class="px-8 py-4 text-center">
                                                            <span
                                                                class="text-sm font-bold dark:text-white">{{ $mark->score }}</span>
                                                            <span
                                                                class="text-[10px] text-gray-400">/{{ $mark->max_mark ?? 100 }}</span>
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
                                                                        $mark->max_mark > 0 ? $mark->max_mark : 100;
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
                        <p class="text-gray-400 font-black uppercase tracking-widest">No enrollment records available.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
