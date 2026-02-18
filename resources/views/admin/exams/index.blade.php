<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a]  max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl" dir="ltr">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="text-left">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Exam Registry</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage exam types, subjects, and grading scales.</p>
            </div>
            <a href="{{ route('exams.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all group">
                <i class="fas fa-plus-circle mr-2 group-hover:rotate-90 transition-transform"></i>
                Define New Exam
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-xl shadow-sm flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Main Table Card --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Subject</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Semester
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Type</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                Max Mark</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-white/5">
                        @foreach ($exams as $exam)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mr-3">
                                            <i class="fas fa-book-open text-sm"></i>
                                        </div>
                                        <span
                                            class="font-bold text-gray-700 dark:text-gray-200">{{ $exam->subject->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-white/5 px-3 py-1 rounded-lg">
                                        {{ $exam->semester->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                                    {{ $exam->exam_type == 'Final Exam' ? 'bg-rose-100 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400' : 'bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400' }}">
                                        {{ $exam->exam_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="text-lg font-black text-indigo-600 dark:text-indigo-400">{{ $exam->max_mark }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('exams.edit', $exam->id) }}"
                                            class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this exam definition?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-rose-600 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-50 dark:border-white/5">
                {{ $exams->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
