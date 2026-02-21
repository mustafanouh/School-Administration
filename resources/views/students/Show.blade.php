<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- رأس الصفحة - Header --}}
            <div
                class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div
                        class="h-16 w-16 bg-indigo-100 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-2xl font-bold">
                        {{ substr($student->first_name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-800 dark:text-white">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center mt-1">
                            <span
                                class="bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full mr-2 rtl:ml-2 font-bold uppercase">Active
                                Student</span>
                         
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ url()->previous() }}"
                        class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-sm font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all">
                        <svg class="w-4 h-4 mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- العمود الجانبي: المعلومات الشخصية والعائلة --}}
                <div class="lg:col-span-4 space-y-6">

                    {{-- بطاقة المعلومات الشخصية --}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                            <h3 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider">
                                Personal Profile</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="flex items-start">
                                <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 mr-3 rtl:ml-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Date & Place of Birth</p>
                                    <p class="text-sm font-semibold dark:text-gray-200">{{ $student->date_of_birth }}
                                        <span class="text-gray-400 font-normal">({{ $student->place_of_birth }})</span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 mr-3 rtl:ml-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Gender & Blood Group</p>
                                    <p class="text-sm font-semibold dark:text-gray-200 uppercase">{{ $student->gender }}
                                        <span class="mx-2 text-gray-300">|</span>
                                        {{ $student->blood_group ?? 'Not Set' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="p-2 bg-amber-50 dark:bg-amber-900/20 rounded-lg text-amber-600 mr-3 rtl:ml-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Residential Address</p>
                                    <p class="text-sm font-semibold dark:text-gray-200">{{ $student->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- contact with family--}}
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-gray-50 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30 font-bold text-sm text-gray-800 dark:text-white uppercase tracking-wider">
                            Family Contacts
                        </div>
                        <div class="p-6 space-y-4">
                            <div
                                class="group p-4 rounded-2xl bg-indigo-50/50 dark:bg-indigo-900/10 border border-indigo-100/50 dark:border-indigo-800/30 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors">
                                <div class="flex justify-between items-center mb-2">
                                    <span
                                        class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase">Father</span>
                                    <i class="fas fa-phone-alt text-indigo-300 text-xs"></i>
                                </div>
                                <p class="text-sm font-bold dark:text-white">{{ $student->father_name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $student->father_phone_number }}</p>
                            </div>

                            <div
                                class="group p-4 rounded-2xl bg-rose-50/50 dark:bg-rose-900/10 border border-rose-100/50 dark:border-rose-800/30 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors">
                                <div class="flex justify-between items-center mb-2">
                                    <span
                                        class="text-[10px] font-black text-rose-600 dark:text-rose-400 uppercase">Mother</span>
                                    <i class="fas fa-phone-alt text-rose-300 text-xs"></i>
                                </div>
                                <p class="text-sm font-bold dark:text-white">{{ $student->mother_name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $student->mother_phone_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- العمود الرئيسي: السجل الأكاديمي والدرجات --}}
                <div class="lg:col-span-8 space-y-6">
                    <h3 class="text-xl font-black text-gray-800 dark:text-white flex items-center px-2">
                        Academic Timeline
                    </h3>

                    @forelse ($student->enrollments as $enrollment)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all hover:shadow-md">
                            {{-- شريط السنة الدراسية --}}
                            <div
                                class="px-6 py-4 bg-white dark:bg-gray-800 flex flex-wrap justify-between items-center border-b border-gray-50 dark:border-gray-700">
                                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase">Academic Year</p>
                                        <span
                                            class="font-black text-gray-800 dark:text-gray-100">{{ $enrollment->academicYear->name }}</span>
                                    </div>
                                </div>
                                <div class="mt-2 sm:mt-0">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-black uppercase tracking-tight">
                                        {{ $enrollment->section->grade->name }} — {{ $enrollment->section->name }}
                                    </span>
                                </div>
                            </div>

                            {{-- جدول الدرجات --}}
                            <div class="p-0 sm:p-6">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left rtl:text-right border-collapse">
                                        <thead>
                                            <tr
                                                class="hidden sm:table-row text-[10px] uppercase text-gray-400 font-bold tracking-widest">
                                                <th class="px-6 py-3">Exam Name</th>
                                                <th class="px-6 py-3">Exam Type</th>

                                                <th class="px-6 py-3 text-center">Result Score</th>
                                                <th class="px-6 py-3 text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                                            @forelse($enrollment->marks as $mark)
                                                <tr
                                                    class="group hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors">
                                                    <td class="px-6 py-4">
                                                        <div
                                                            class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                            {{ $mark->exam->subject->name }}</div>
                                                        <div
                                                            class="sm:hidden text-[10px] text-gray-400 uppercase mt-1">
                                                            Exam Name</div>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div
                                                            class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                            {{ $mark->exam->exam_type }}</div>
                                                        <div
                                                            class="sm:hidden text-[10px] text-gray-400 uppercase mt-1">
                                                            Exam Type</div>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <div class="text-sm font-black dark:text-white">
                                                            {{ $mark->score }}
                                                            <span class="text-gray-400 font-medium text-xs">/
                                                                {{ $mark->max_mark ?? 100 }}</span>
                                                        </div>
                                                        <div
                                                            class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full mt-2 overflow-hidden">
                                                            @php $percent = ($mark->score / ($mark->max_mark ?? 100)) * 100; @endphp
                                                            <div class="h-full {{ $mark->status == 'passed' ? 'bg-emerald-500' : 'bg-rose-500' }}"
                                                                style="width: {{ $percent }}%"></div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 text-right">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $mark->status == 'passed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' }}">
                                                            <span
                                                                class="w-1.5 h-1.5 rounded-full mr-1.5 rtl:ml-1.5 {{ $mark->status == 'passed' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                                            {{ $mark->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="px-6 py-10 text-center">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png"
                                                            class="w-12 h-12 mx-auto opacity-20 mb-3" alt="No data">
                                                        <p class="text-sm text-gray-400 italic font-medium">No exam
                                                            marks recorded for this session.</p>
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
                            class="bg-white dark:bg-gray-800 rounded-3xl p-12 text-center border-2 border-dashed border-gray-100 dark:border-gray-700">
                            <p class="text-gray-400 font-medium">This student has no enrollment history recorded.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
