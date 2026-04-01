<x-app-layout>

    <div x-data="{ openDel: false, deleteRoute: '', studentName: '' }"
        class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl"
        dir="ltr">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 text-left">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Students Grading Sheet</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">View and manage academic performance records.</p>
            </div>
            <a href="{{ route('marks.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                <i class="fas fa-marker mr-2"></i> Record New Mark
            </a>
        </div>
        {{-- رسالة النجاح --}}
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm transition-all duration-500"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ms-3 text-sm font-semibold">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                    onclick="this.parentElement.remove()" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- رسالة الخطأ --}}
        @if (session('error'))
            <div class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 border border-red-200 shadow-sm transition-all duration-500"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ms-3 text-sm font-semibold">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    onclick="this.parentElement.remove()" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Stats Summary --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div
                class="bg-white dark:bg-[#1a1d29] p-4 rounded-2xl border border-gray-100 dark:border-white/5 flex items-center shadow-sm">
                <div
                    class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase">Pass Rate</p>
                    <p class="text-lg font-black text-gray-700 dark:text-white">85%</p>
                </div>
            </div>
        </div>

        {{-- Marks Table --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Student &
                                Subject</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                Exam Type</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                Score</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach ($marks as $mark)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="mr-3">
                                            <p class="font-bold text-gray-800 dark:text-gray-200  text-sm">
                                                {{ $mark->enrollment->student->first_name }}
                                                {{ $mark->enrollment->student->last_name }}
                                            </p>
                                            <p class="text-xs text-indigo-500 font-medium">
                                                {{ $mark->exam->subject->name }} ({{ $mark->exam->semester->name }})
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="text-xs font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-white/5 px-3 py-1 rounded-full">
                                        {{ $mark->exam->exam_type }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="inline-block">
                                        <span
                                            class="text-lg font-black {{ $mark->status == 'passed' ? 'text-emerald-600' : 'text-rose-600' }}">
                                            {{ $mark->score }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase ml-0.5">/
                                            {{ $mark->max_mark }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $mark->status == 'passed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' }} border {{ $mark->status == 'passed' ? 'border-emerald-200' : 'border-rose-200' }}">
                                        <i
                                            class="fas {{ $mark->status == 'passed' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ ucfirst($mark->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('marks.edit', $mark->id) }}"
                                            class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- زر الحذف الذي يفتح الـ Modal --}}
                                        <button
                                            @click="openDel = true; deleteRoute = '{{ route('marks.destroy', $mark->id) }}'; studentName = '{{ $mark->enrollment->student->name }}'"
                                            class="p-2 text-gray-400 hover:text-rose-600 transition-colors">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-50 dark:border-white/5">
                {{ $marks->links() }}
            </div>
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-show="openDel" class="fixed inset-0 z-[100] flex items-center justify-center" x-cloak>

            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" @click="openDel = false"></div>

            <div class="relative bg-white dark:bg-[#161923] rounded-2xl shadow-2xl max-w-sm w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-700"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="p-6 text-center">
                    <div
                        class="w-16 h-16 mx-auto bg-rose-100 dark:bg-rose-900/30 rounded-full mb-4 flex items-center justify-center text-rose-600 text-2xl">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Delete Grade?</h3>
                    <p class="text-sm text-gray-500 mt-2 px-4">
                        Are you sure you want to delete the grade record for
                        <span class="font-bold text-rose-600" x-text="studentName"></span>?
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-white/5 px-6 py-4 flex gap-3">
                    <button @click="openDel = false"
                        class="flex-1 px-4 py-2.5 text-sm font-bold text-gray-600 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-xl">Back</button>

                    <form :action="deleteRoute" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-rose-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-rose-500/20">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
