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
                            <select name="student_id" id="student_select"
                                class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                                required>
                                <option disabled selected value="">Choose a student...</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ "$student->first_name $student->last_name" }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- ... الأيقونة ... --}}
                        </div>


                        {{-- مكان ظهور الحالة السابقة --}}
                        <div id="previous_info_box"
                            class="hidden mt-3 p-4 rounded-xl border border-dashed border-indigo-200 dark:border-indigo-500/20 bg-indigo-50/30 dark:bg-indigo-500/5">
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Previous Record:</span>
                                <div class="flex gap-2">
                                    <span id="prev_section"
                                        class="px-2 py-1 bg-white dark:bg-white/10 rounded shadow-sm font-bold text-indigo-600 dark:text-indigo-400"></span>
                                    <span id="prev_status"
                                        class="px-2 py-1 rounded font-bold uppercase text-[10px] tracking-wider border"></span>
                                </div>
                                <span id="prev_year" class="text-xs text-gray-400 ml-auto"></span>
                            </div>
                        </div>
                    </div>


                    {{-- <livewire:⚡student-info /> --}}
                    
                    {{-- Academic Year --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Academic
                            Year</label>
                        <select name="academic_year_id"
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all appearance-none"
                            required>

                            <option value="{{ $activeYear->id }}">{{ $activeYear->name }}</option>

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
                            <option disabled value="">Select Section</option>
                            @foreach ($sectionsGroupedByGrade as $gradeName => $sections)
                                <optgroup label="Grade: {{ $gradeName }}">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->name }} (Capacity: {{ $section->capacity }})
                                        </option>
                                    @endforeach
                                </optgroup>
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
                            <option disabled value="">Select Track</option>
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
<script>
    document.getElementById('student_select').addEventListener('change', function() {
        const studentId = this.value;
        const infoBox = document.getElementById('previous_info_box');
        const prevSection = document.getElementById('prev_section');
        const prevStatus = document.getElementById('prev_status');
        const prevYear = document.getElementById('prev_year');

        if (!studentId) {
            infoBox.classList.add('hidden');
            return;
        }

        // جلب البيانات من السيرفر
        fetch(`/api/students/${studentId}/previous-info`)
            .then(response => response.json())
            .then(data => {
                if (data.has_previous) {
                    infoBox.classList.remove('hidden');
                    prevSection.innerText = `Grade: ${data.grade}`;
                    prevYear.innerText = `Year: ${data.year}`;

                    // تنسيق الحالة
                    prevStatus.innerText = data.status;
                    const statusClasses = {
                        'passed': 'bg-green-100 text-green-700 border-green-200',
                        'failed': 'bg-red-100 text-red-700 border-red-200',
                        'dropped': 'bg-gray-100 text-gray-700 border-gray-200',
                        'enrolled': 'bg-blue-100 text-blue-700 border-blue-200'
                    };

                    prevStatus.className =
                        `px-2 py-1 rounded font-bold uppercase text-[10px] tracking-wider border ${statusClasses[data.status] || ''}`;
                } else {
                    // طالب جديد ليس لديه سجلات سابقة
                    infoBox.classList.remove('hidden');
                    prevSection.innerText = "New Student (No previous history)";
                    prevStatus.innerText = "NEW";
                    prevStatus.className =
                        "px-2 py-1 rounded font-bold text-[10px] bg-orange-100 text-orange-700 border-orange-200";
                    prevYear.innerText = "";
                }
            })
            .catch(error => console.error('Error fetching student info:', error));
    });
</script>
