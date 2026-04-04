<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Subjects Registry</h1>
                <p class="text-sm text-gray-500 font-medium">Manage academic subjects, marks, and semesters</p>
            </div>
            <a href="{{ route('subjects.create') }}"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                <i class="fas fa-plus mr-2"></i> Add New Subject
            </a>
        </div>

        {{-- Alerts Section --}}
        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200"
                role="alert">
                <div class="ms-3 text-sm font-semibold">{{ session('success') }}</div>
                <button type="button" class="ms-auto bg-green-50 text-green-500 p-1.5 hover:bg-green-200 rounded-lg"
                    onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        {{-- Table Section --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Subject
                                Name</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Track &
                                Grade</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Marks
                                (Min/Max)</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Semester
                            </th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($subjects as $subject)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800 dark:text-white">{{ $subject->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-xs font-semibold px-2 py-1 bg-blue-100 text-blue-700 rounded-lg">Track:
                                        {{ $subject->track->name }}</span>
                                    <span
                                        class="text-xs font-semibold px-2 py-1 bg-purple-100 text-purple-700 rounded-lg">Grade:
                                        {{ $subject->grade->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm font-mono text-gray-600 dark:text-gray-300">
                                    {{ $subject->min_mark }} / {{ $subject->max_mark }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $subject->semester == 'other' ? 'bg-gray-100 text-gray-600' : 'bg-emerald-100 text-emerald-700' }}">
                                        {{ $subject->semester }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('subjects.edit', $subject->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        {{-- Delete with Alpine.js --}}
                                        <div x-data="{ openDel: false }">
                                            <button @click="openDel = true"
                                                class="text-rose-500 hover:text-rose-700 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <div x-show="openDel"
                                                class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60"
                                                x-cloak>
                                                <div
                                                    class="bg-white dark:bg-[#161923] p-6 rounded-2xl max-w-sm w-full mx-4 shadow-2xl border dark:border-gray-700">
                                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                                                        Confirm Delete</h3>
                                                    <p class="text-sm text-gray-500">Are you sure you want to delete
                                                        <span
                                                            class="font-bold text-red-500">{{ $subject->name }}</span>?
                                                    </p>
                                                    <div class="mt-6 flex gap-3">
                                                        <button @click="openDel = false"
                                                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl text-sm font-bold text-gray-600 dark:text-gray-300">Cancel</button>
                                                        <form action="{{ route('subjects.destroy', $subject->id) }}"
                                                            method="POST" class="flex-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-4 py-2 bg-rose-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-rose-500/20">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('subjects.show', $subject->id) }}"
                                            class="text-emerald-500 hover:text-emerald-700 px-2 py-1 transition-colors"
                                            title="View Profile">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">No subjects
                                    found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            {{ $subjects->links() }}
        </div>
    </div>
</x-app-layout>
