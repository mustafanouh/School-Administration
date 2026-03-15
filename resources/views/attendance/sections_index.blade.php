<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Sections Attendance</h1>
                <p class="text-sm text-gray-500 font-medium">Select a section to record or view daily attendance</p>
            </div>
            <div class="px-4 py-2 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl">
                <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                    Today: {{ now()->format('l, M d') }}
                </span>
            </div>
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="flex items-center p-4 mb-6 text-green-800 rounded-xl bg-green-50 border border-green-200 shadow-sm"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
                <button type="button" class="ms-auto bg-green-50 text-green-500 p-1.5 hover:bg-green-200 rounded-lg"
                    onclick="this.parentElement.remove()">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Table Container --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Section
                                Details</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Grade
                                Level</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Students
                                Count</th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($sections as $section)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
                                            <i class="fas fa-users text-sm"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="block font-bold text-gray-800 dark:text-white">{{ $section->name }}</span>
                                            <span class="text-[10px] text-gray-400 uppercase tracking-tight">ID:
                                                #SECT-{{ $section->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-lg font-medium">
                                        {{ $section->grade->name?? 'Not Assigned' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 max-w-[100px]">
                                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 70%"></div>
                                        </div>
                                        <span
                                            class="text-xs font-bold text-gray-500 dark:text-gray-400">{{ $section->enrollments_count }}
                                            Students</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <a href="{{ route('attendance.section', $section->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/10 transition-all group">
                                        Take Attendance
                                        <i
                                            class="fas fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">
                                    No sections found in the records.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
