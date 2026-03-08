<x-app-layout>
    <div class="py-12 bg-gray-50/50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. بطاقة المعلم الأساسية - Teacher Hero Card --}}
            <div
                class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">

                {{-- خلفية جمالية علوية بلون مختلف لتمييز المعلمين (مثلاً البنفسجي أو الزمردي) --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full -mr-16 -mt-16"></div>

                <div class="relative p-8 md:p-10">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">

                        {{-- الصورة الشخصية (الحرف الأول من اسم المعلم) --}}
                        <div class="flex-none">
                            <div
                                class="h-28 w-28 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg shadow-indigo-200 dark:shadow-none ring-4 ring-white dark:ring-gray-700">
                                {{ substr($teacher->employee?->first_name ?? 'T', 0, 1) }}
                            </div>
                        </div>

                        {{-- المعلومات الأساسية --}}
                        <div class="flex-grow text-center md:text-left rtl:md:text-right">
                            <div class="flex flex-col md:flex-row md:items-center gap-3">
                                <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                                    {{ $teacher->employee?->first_name }} {{ $teacher->employee?->last_name }}
                                </h1>
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase rounded-full w-fit mx-auto md:mx-0">
                                    Teacher Specialist
                                </span>
                            </div>

                            {{-- شبكة البيانات الخاصة بالمعلم --}}
                            <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-y-8 gap-x-6">

                                {{-- التخصص - تمييزه بلون مختلف --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-book-open mr-1"></i> Specialization
                                    </p>
                                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400 mt-1">
                                        {{ $teacher->specialization }}
                                    </p>
                                </div>

                                {{-- الرقم الوطني --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-id-card mr-1"></i> National ID
                                    </p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $teacher->employee?->notional_id }}
                                    </p>
                                </div>

                                {{-- الراتب السنوي/الشهري --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-money-bill-wave mr-1"></i> Salary
                                    </p>
                                    <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1">
                                        ${{ number_format($teacher->employee?->salary ?? 0, 2) }}
                                    </p>
                                </div>

                                {{-- تاريخ التعيين --}}
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">
                                        <i class="fas fa-calendar-alt mr-1"></i> Hire Date
                                    </p>
                                    <p class="text-sm font-bold text-gray-700 dark:text-gray-200 mt-1">
                                        {{ $teacher->employee?->hire_data }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- أزرار التحكم --}}
                        <div class="flex-none flex flex-col gap-2">
                            <a href="{{ route('teachers.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-2xl text-xs font-black hover:bg-gray-200 transition-all uppercase tracking-widest">
                                <i class="fas fa-arrow-left mr-2 rtl:ml-2"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 2. قسم معلومات التواصل والعنوان --}}
                <div class="bg-gray-50/80 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700 px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- الهاتف --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-none">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest">Contact Info
                                </p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">Phone Number</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                    {{ $teacher->employee?->phone }}</p>
                            </div>
                        </div>

                        {{-- العنوان السكني --}}
                        <div
                            class="flex items-start gap-4 p-4 rounded-3xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700">
                            <div
                                class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-none">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Location</p>
                                <h3 class="text-sm font-black text-gray-800 dark:text-white">Residential Address</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                    {{ $teacher->employee?->address }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- مساحة إضافية اختيارية: يمكنك هنا عرض المواد التي يدرسها المعلم أو الجدول الدراسي --}}
            <div
                class="bg-white-100 rounded-[2rem] p-8 text-black flex justify-between items-center shadow-lg shadow-white-200 dark:shadow-none">
                <div>
                    <h2 class="text-xl font-black">Teaching Assignments</h2>
                    <p class="text-black-100 text-sm mt-1">Manage and view classes assigned to this teacher.</p>
                </div>
                <i class="fas fa-chalkboard-teacher text-4xl opacity-50"></i>
            </div>

        </div>
    </div>
</x-app-layout>
