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
                        <div class="flex-none">
                            <div
                                class="h-28 w-28 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg shadow-indigo-200 dark:shadow-none ring-4 ring-white dark:ring-gray-700">
                                {{ substr($student->first_name, 0, 1) }}
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

            {{-- 3. السجل الأكاديمي - Academic Journey --}}
            <div class="space-y-10">
                <div class="flex items-center gap-4 px-2">
                    <h2 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight italic">Academic Journey
                    </h2>
                    <div class="flex-grow h-px bg-gradient-to-r from-gray-200 to-transparent dark:from-gray-700"></div>
                </div>

                @forelse ($student->enrollments->sortByDesc('academicYear.name') as $enrollment)
                    <div
                        class="bg-white dark:bg-gray-900 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden mb-12">
                        {{-- ترويسة السنة - هادئة وبسيطة --}}
                        <div
                            class="px-8 py-5 border-b border-gray-50 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <span class="w-1 h-8 bg-indigo-500 rounded-full"></span>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white">
                                        {{ $enrollment->academicYear->name }}</h4>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest">
                                        {{ $enrollment->section->grade->name }} — {{ $enrollment->section->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-0"> {{-- إزالة الحواف الداخلية للسماح للجدول بالتمدد --}}
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
                                                                @php $percent = ($mark->score / ($mark->max_mark ?? 100)) * 100; @endphp
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
