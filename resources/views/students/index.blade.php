<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen rounded-2xl text-left"
        dir="ltr">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Students Registry</h1>
                <p class="text-sm text-gray-500 font-medium">Manage and view all registered students</p>
            </div>
            <a href="{{ route('students.create') }}"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                <i class="fas fa-plus mr-2"></i> Register New Student
            </a>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Student
                                Name</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Address
                            </th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Phone
                                Number</th>
                            <th
                                class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors"
                                x-data="{ openView: false }">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ substr($student->first_name, 0, 1) }}
                                        </div>
                                        <div class="font-bold text-gray-800 dark:text-white">
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($student->address, 30) }}
                                </td>

                                <td class="px-6 py-4 text-sm font-mono text-gray-600 dark:text-gray-300">
                                    {{ $student->phone_number }}
                                </td>
                                {{-- action  --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- 1. Edit Icon --}}
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 px-2 py-1 transition-colors"
                                            title="Edit Student">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>

                                        {{-- 2. Delete Icon & Modal --}}
                                        <div x-data="{ openDel: false }">
                                            <button @click="openDel = true"
                                                class="text-rose-500 hover:text-rose-700 px-2 py-1 transition-colors"
                                                title="Delete Student">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <div x-show="openDel"
                                                class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto"
                                                x-cloak>

                                                <div class="fixed inset-0 bg-black/60 transition-opacity"
                                                    @click="openDel = false"></div>

                                                <div
                                                    class="relative bg-white dark:bg-[#161923] rounded-2xl shadow-2xl max-w-sm w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-700 text-left">
                                                    <div class="p-6 text-center">
                                                        <div
                                                            class="w-16 h-16 mx-auto bg-rose-100 dark:bg-rose-900/30 rounded-full mb-4 flex items-center justify-center">
                                                            <i
                                                                class="fas fa-exclamation-triangle text-rose-600 text-2xl"></i>
                                                        </div>
                                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                                            Confirm Delete</h3>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 px-2">
                                                            Are you sure you want to remove <span
                                                                class="font-bold text-gray-800 dark:text-gray-200">{{ $student->first_name }}
                                                                {{ $student->last_name }}</span>?
                                                        </p>
                                                        <p class="text-[11px] text-rose-500 mt-2 font-medium">This
                                                            action cannot be undone.</p>
                                                    </div>

                                                    <div
                                                        class="bg-gray-50 dark:bg-white/5 px-6 py-4 flex justify-center gap-3">
                                                        <button @click="openDel = false"
                                                            class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                                            Cancel
                                                        </button>

                                                        <form action="{{ route('students.destroy', $student->id) }}"
                                                            method="POST" class="flex-1">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-rose-500/20 transition-all">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       {{-- 3. View Icon & Modal --}}
                                        <a href="{{ route('students.show', $student->id) }}"
                                            class="text-emerald-500 hover:text-emerald-700 px-2 py-1 transition-colors"
                                            title="View Profile">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">No students found
                                    in the database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $students->links() }}
        </div>
    </div>
</x-app-layout>
