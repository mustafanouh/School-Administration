<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Breadcrumbs & Header --}}
        <div class="mb-8">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <a href="{{ route('enrollments.index') }}"
                            class="hover:text-indigo-600 transition-colors">Enrollments</a>
                    </li>
                    <li class="text-gray-400 text-sm">/</li>
                    <li class="text-sm font-bold text-gray-800 dark:text-white">New Enrollment</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Register Student</h1>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <form action="{{ route('enrollments.store') }}" method="POST" class="p-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Student Selection --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Select
                            Student</label>
                        <div class="relative">
                            <select name="student_id"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                                required>
                                <option value="">Choose a student...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ "$student->first_name $student->last_name" }}
                                        ({{ $student->last_name }})
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Academic Year --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Academic
                            Year</label>
                        <select name="academic_year_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                            required>
                            @foreach ($academicYears as $year)
                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Enrollment Date --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Enrollment
                            Date</label>
                        <input type="date" name="enrollment_date" value="{{ date('Y-m-d') }}"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all"
                            required>
                    </div>

                    {{-- Section --}}
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Section</label>
                        <select name="section_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                            required>
                            <option value="">Select Section</option>
                            @foreach ($sections as $section)
                                @foreach ($grades as $grade)
                                    <option value="{{ $section->id }}">{{ $section->name }} ({{ $grade->name }})
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    {{-- Track --}}
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Track</label>
                        <select name="track_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                            required>
                            <option value="">Select Track</option>
                            @foreach ($tracks as $track)
                                <option value="{{ $track->id }}">{{ $track->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status</label>
                        <div class="flex gap-4">
                            @foreach (['enrolled', 'graduated', 'dropped'] as $status)
                                <label class="flex-1">
                                    <input type="radio" name="status" value="{{ $status }}"
                                        class="hidden peer" {{ $status == 'enrolled' ? 'checked' : '' }}>
                                    <div
                                        class="text-center p-3 rounded-xl border border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400 peer-checked:border-indigo-600 peer-checked:text-indigo-600 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/20 transition-all cursor-pointer font-bold text-sm">
                                        {{ ucfirst($status) }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-24 flex gap-5">
                    <button type="submit"
                        class="flex-1 px-6 py-3.5   bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        Complete Registration
                    </button>
                    <a href="{{ route('enrollments.index') }}"
                        class="px-6 py-3.5 bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>



        {{-- عرض رسائل الخطأ العامة --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- عرض رسالة النجاح أو الفشل من الـ Session --}}
        @if (session('error'))
            <div class="mb-4 p-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700">
                {{ session('error') }}
            </div>
        @endif
    </div>
</x-app-layout>
