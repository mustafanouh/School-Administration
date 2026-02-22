<x-app-layout>


    <div class="py-12">
        <div class=" max-w-6xl mx-auto sm:px-6 lg:px-8  space-y-6">

            {{-- header --}}
            <div class=" space-y-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">

                    {{-- Header --}}
                    <div
                        class="p-6 border-b border-gray-50 dark:border-white/5 flex justify-between items-center bg-gray-50/30 dark:bg-white/[0.01]">
                        <div class="flex items-center">
                            <span class="w-2 h-7 bg-indigo-600 rounded-full mr-3 rtl:ml-3"></span>
                            <div>
                                <div class="flex items-center gap-3">
                                    <h3 class="text-xl font-black text-gray-800 dark:text-white italic">
                                        General Section Information
                                    </h3>

                                    {{-- نظام الـ Badge الذكي --}}
                                    @php
                                        $count = $section->enrollments->count();
                                        $cap = $section->capacity;
                                        $isFull = $count >= $cap;
                                        $isNearFull = !$isFull && $count / $cap >= 0.8;
                                    @endphp

                                    @if ($isFull)
                                        <span
                                            class="px-3 py-1 bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-rose-200 dark:border-rose-800/50 flex items-center shadow-sm">
                                            <i class="fas fa-lock mr-1.5 rtl:ml-1.5"></i> Full Capacity
                                        </span>
                                    @elseif($isNearFull)
                                        <span
                                            class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-amber-200 dark:border-amber-800/50 flex items-center animate-pulse">
                                            <i class="fas fa-exclamation-triangle mr-1.5 rtl:ml-1.5"></i> Almost Full
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-emerald-200 dark:border-emerald-800/50 flex items-center">
                                            <i class="fas fa-check-circle mr-1.5 rtl:ml-1.5"></i> Available
                                        </span>
                                    @endif
                                </div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Overview &
                                    Class Logistics</p>
                            </div>
                        </div>

                        <a href="{{ route('sections.index') }}"
                            class="flex items-center px-4 py-2 bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-200 text-xs font-black rounded-xl border border-gray-200 dark:border-gray-600 hover:bg-gray-50 transition-all shadow-sm group">
                            <i
                                class="fas fa-arrow-left mr-2 rtl:ml-2 group-hover:-translate-x-1 transition-transform"></i>
                            Back to List
                        </a>
                    </div>

                    {{-- Grid Details --}}
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                            {{-- Grade Information --}}
                            <div
                                class="flex items-start p-4 bg-indigo-50/50 dark:bg-indigo-900/10 rounded-2xl border border-indigo-100/50 dark:border-indigo-500/10">
                                <div
                                    class="w-12 h-12 bg-indigo-100 dark:bg-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-600 mr-4 rtl:ml-4 shadow-sm">
                                    <i class="fas fa-layer-group text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-tighter">Current
                                        Grade</p>
                                    <p class="text-lg font-black text-gray-800 dark:text-gray-100">
                                        {{ $section->grade->name }}</p>
                                </div>
                            </div>
                            {{-- section Information --}}
                            <div
                                class="flex items-start p-4 bg-indigo-50/50 dark:bg-indigo-900/10 rounded-2xl border border-indigo-100/50 dark:border-indigo-500/10">
                                <div
                                    class="w-12 h-12 bg-indigo-100 dark:bg-indigo-500/20 rounded-xl flex items-center justify-center text-indigo-600 mr-4 rtl:ml-4 shadow-sm">
                                    <i class="fas fa-layer-group text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-tighter">Current
                                        section</p>
                                    <p class="text-lg font-black text-gray-800 dark:text-gray-100">
                                        {{ $section->name }}</p>
                                </div>
                            </div>
                            {{-- Academic Year Information --}}
                            <div
                                class="flex items-start p-4 bg-amber-50/50 dark:bg-amber-900/10 rounded-2xl border border-amber-100/50 dark:border-amber-500/10">
                                <div
                                    class="w-12 h-12 bg-amber-100 dark:bg-amber-500/20 rounded-xl flex items-center justify-center text-amber-600 mr-4 rtl:ml-4 shadow-sm">
                                    <i class="fas fa-calendar-check text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-amber-500/70 uppercase tracking-tighter">
                                        Academic Session</p>
                                    <p class="text-lg font-black text-gray-800 dark:text-gray-100">
                                        {{ $section->academicYear->name }}</p>
                                </div>
                            </div>

                            {{-- Capacity Information with Progress --}}
                            <div
                                class="flex flex-col p-4 bg-emerald-50/50 dark:bg-emerald-900/10 rounded-2xl border border-emerald-100/50 dark:border-emerald-500/10">
                                <div class="flex items-center mb-3">
                                    <div
                                        class="w-10 h-10 bg-emerald-100 dark:bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-600 mr-3 rtl:ml-3 shadow-sm">
                                        <i class="fas fa-users text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-tighter">
                                            Class Capacity</p>
                                        <p class="text-sm font-black text-gray-800 dark:text-gray-100">
                                            {{ $section->enrollments->count() }} <span
                                                class="text-gray-400 font-medium">/ {{ $section->capacity }}
                                                Students</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- شريط التقدم للسعة --}}
                                @php
                                    $percentage =
                                        $section->capacity > 0
                                            ? ($section->enrollments->count() / $section->capacity) * 100
                                            : 0;
                                    $barColor =
                                        $percentage > 90
                                            ? 'bg-rose-500'
                                            : ($percentage > 70
                                                ? 'bg-amber-500'
                                                : 'bg-emerald-500');
                                @endphp
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-auto">
                                    <div class="{{ $barColor }} h-1.5 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.3)] transition-all duration-1000"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- teacher --}}

            <div class="bg-white p-6 shadow sm:rounded-lg border border-gray-100">
                {{-- Header Section with Button --}}
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-blue-700 flex items-center">
                            <i class="fas fa-chalkboard-teacher mr-2 rtl:ml-2"></i>
                            Assigned Teachers & Subjects
                        </h3>
                        <p class="text-xs text-gray-400 font-medium">Manage faculty assignments for this section</p>
                    </div>

                    {{-- زر الإضافة المحدث --}}
                    <a href="{{ route('teacher_subjects.create', ['section_id' => $section->id, 'academic_year_id' => $section->academic_year_id]) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-xl font-black text-[11px] text-white uppercase tracking-widest hover:bg-blue-700 shadow-md shadow-blue-200 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        <svg class="w-4 h-4 mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Assign Teacher
                    </a>
                </div>

                {{-- الجدول --}}
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-sm text-left rtl:text-right border-collapse">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-[10px] font-black tracking-widest">
                            <tr>
                                <th class="px-4 py-3 border-b">Teacher Name</th>
                                <th class="px-4 py-3 border-b">Subject</th>
                                <th class="px-4 py-3 border-b text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($section->teacherSubjects as $ts)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-4 font-bold text-gray-700">
                                        {{ $ts->teacher->employee->first_name }}
                                        {{ $ts->teacher->employee->last_name }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <span
                                            class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg font-bold text-xs border border-indigo-100">
                                            {{ $ts->subject->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            {{-- زر التعديل --}}
                                            <a href="{{ route('teacher_subjects.edit', $ts) }}"
                                                class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- زر الحذف --}}
                                            <form action="{{ route('teacher_subjects.destroy', $ts) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-10 text-center text-gray-400 italic">
                                        <i class="fas fa-info-circle mb-2 block text-2xl opacity-20"></i>
                                        No teachers assigned yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- studants --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">

                <div class="p-6 border-b border-gray-50 dark:border-white/5 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-black text-emerald-700 dark:text-emerald-500 flex items-center">
                            <i class="fas fa-user-graduate mr-3 rtl:ml-3"></i>
                            Enrolled Students
                        </h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Class Roster &
                            Registration</p>
                    </div>
                    <span
                        class="px-4 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 text-xs font-black rounded-full">
                        {{ $section->enrollments->count() }} Active
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left rtl:text-right">
                        <thead>
                            <tr
                                class="bg-gray-50/50 dark:bg-white/5 text-[10px] font-black text-gray-400 uppercase tracking-[0.15em]">
                                <th class="px-6 py-4">#</th>
                                <th class="px-6 py-4">Student Identity</th>
                                <th class="px-6 py-4 text-center">Enrollment Date</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                            @forelse($section->enrollments as $enrollment)
                                <tr class="group hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                    {{-- الرقم التسلسلي --}}
                                    <td class="px-6 py-4">
                                        <span
                                            class="text-xs font-bold text-gray-300 group-hover:text-emerald-500 transition-colors">
                                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    {{-- اسم الطالب مع أيقونة رمزية --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-300 to-green-800 flex items-center justify-center text-white font-black text-sm shadow-sm mr-3 rtl:ml-3">
                                                {{ mb_substr($enrollment->student->first_name ?? 'S', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-gray-700 dark:text-gray-200">
                                                    {{ $enrollment->student->first_name ?? 'N/A' }}
                                                    {{ $enrollment->student->last_name ?? '' }}
                                                </p>

                                            </div>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 text-center">
                                        <div
                                            class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-white/5 rounded-lg border border-gray-200 dark:border-white/10">
                                            <i class="far fa-calendar-alt mr-2 rtl:ml-2 text-gray-400 text-[10px]"></i>
                                            <span class="text-xs font-bold text-gray-600 dark:text-gray-400">
                                                {{ $enrollment->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            {{-- زر التعديل --}}
                                            <a class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- زر الحذف --}}
                                            <form method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-20 h-20 bg-gray-50 dark:bg-white/5 rounded-[2rem] flex items-center justify-center mb-4">
                                                <i class="fas fa-users-slash text-2xl text-gray-200"></i>
                                            </div>
                                            <h4 class="text-sm font-black text-gray-400 uppercase tracking-widest">No
                                                Students Enrolled</h4>
                                            <p class="text-xs text-gray-300 mt-1">This section is currently empty.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
