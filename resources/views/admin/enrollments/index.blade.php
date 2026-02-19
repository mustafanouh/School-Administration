<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Student Enrollments</h1>
                <p class="text-sm text-gray-500 font-medium">Manage student academic records, tracks, and academic years
                </p>
            </div>
            <a href="{{ route('enrollments.create') }}"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                <i class="fas fa-user-plus mr-2"></i> Add New Enrollment
            </a>
        </div>

        {{-- Table Container --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Student
                                Details</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Academic
                                Year</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Section &
                                Track</th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Status</th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Latest Grade</th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($enrollments as $enrollment)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                {{-- Student Info --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 font-bold text-xs shadow-sm">
                                            {{ strtoupper(substr($enrollment->student->first_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 dark:text-white text-sm">
                                                {{ $enrollment->student->first_name }}</div>
                                            <div class="text-[11px] text-gray-500 font-medium">
                                                {{ $enrollment->student->last_name }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Academic Year --}}
                                <td class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300">
                                    <i class="far fa-calendar-alt mr-1 text-gray-400"></i>
                                    {{ $enrollment->academicYear->name ?? 'N/A' }}
                                </td>

                                {{-- Section & Track --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-xs font-bold text-indigo-500 dark:text-indigo-400">
                                            <i class="fas fa-layer-group mr-1"></i> {{ $enrollment->section->name }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-medium italic">
                                            Track: {{ $enrollment->track->name }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusColors = [
                                            'enrolled' =>
                                                'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400',
                                            'graduated' =>
                                                'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400',
                                            'dropped' =>
                                                'bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400',
                                        ];
                                        $badgeClass = $statusColors[$enrollment->status] ?? 'bg-gray-100 text-gray-600';
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $badgeClass }}">
                                        {{ $enrollment->status }}
                                    </span>
                                </td>

                                {{-- Latest Grade --}}
                                <td class="px-6 py-4 text-center">
                                    @if ($enrollment->marks->isNotEmpty())
                                        @php $lastMark = $enrollment->marks->last(); @endphp
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ $lastMark->score }}/{{ $lastMark->max_mark }}</span>
                                            <span
                                                class="text-[9px] font-bold {{ $lastMark->status == 'passed' ? 'text-emerald-500' : 'text-rose-500' }}">
                                                {{ strtoupper($lastMark->status) }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-[10px] text-gray-400 italic">No Marks</span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all"
                                            title="Edit Enrollment">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <div x-data="{ openDel: false }" class="inline-block">
                                            <button @click="openDel = true"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all"
                                                title="Delete Record">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            {{-- Modal Delete (Same as your design) --}}
                                            <div x-show="openDel"
                                                class="fixed inset-0 z-[100] flex items-center justify-center" x-cloak>
                                                <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                                                    @click="openDel = false"></div>
                                                <div
                                                    class="relative bg-white dark:bg-[#161923] rounded-2xl shadow-2xl max-w-sm w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-700">
                                                    <div class="p-6 text-center">
                                                        <div
                                                            class="w-16 h-16 mx-auto bg-rose-100 dark:bg-rose-900/30 rounded-full mb-4 flex items-center justify-center text-rose-600 text-2xl">
                                                            <i class="fas fa-user-slash"></i>
                                                        </div>
                                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                                            Cancel Enrollment?</h3>
                                                        <p class="text-sm text-gray-500 mt-2 px-4">This will remove
                                                            <span
                                                                class="font-bold">{{ $enrollment->student->name }}</span>
                                                            from this academic session.
                                                        </p>
                                                    </div>
                                                    <div class="bg-gray-50 dark:bg-white/5 px-6 py-4 flex gap-3">
                                                        <button @click="openDel = false"
                                                            class="flex-1 px-4 py-2.5 text-sm font-bold text-gray-600 bg-gray-200 rounded-xl">Back</button>
                                                        <form
                                                            action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                                            method="POST" class="flex-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-4 py-2.5 bg-rose-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-rose-500/20">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">No enrollment
                                    records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if (method_exists($enrollments, 'links'))
            <div class="mt-6">
                {{ $enrollments->links() }}
            </div>
        @endif
        {{-- <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Grade</th>
                        <th>Exams & Marks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
                            <td>{{ $enrollment->section->grade->name }}</td>
                            <td>
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Exam</th>
                                            <th>Exam type</th>
                                            <th>Score</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enrollment->marks as $mark)
                                            <tr>
                                                <td>{{ $mark->exam->name }}</td>
                                                <td>{{ $mark->exam->exam_type }}</td>
                                                <td>{{ $mark->score }} / {{ $mark->max_mark ?? '100' }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $mark->status == 'passed' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($mark->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div> --}}
    </div>

</x-app-layout>
