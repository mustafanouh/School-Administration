<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Teachers Management</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Teachers: {{ $teachers->total() }}</p>
            </div>

            <a href="{{ route('teachers.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                <i class="fas fa-plus mr-2"></i>
                Add New Teacher
            </a>
        </div>

        {{-- Table Section --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Teacher Name</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Specialization</th>
                            <th
                                class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        {{-- هنا نستخدم $teachers وليس $employees --}}
                        @forelse($teachers as $teacher)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 font-bold uppercase">
                                            {{ substr($teacher->employee?->first_name ?? 'T', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $teacher->employee?->first_name }}
                                                {{ $teacher->employee?->last_name }}
                                            </p>
                                            <p class="text-[11px] text-gray-500 font-mono italic">Emp ID:
                                                #{{ $teacher->employee_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    <span
                                        class="px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg font-medium">
                                        {{ $teacher->specialization }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">



                                        {{-- Edit Icon --}}


                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 px-2 py-1">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>

                                        {{-- Delete Icon/Modal --}}
                                        <div x-data="{ openDel: false }">
                                            <button @click="openDel = true"
                                                class="text-rose-500 hover:text-rose-700 px-2 py-1 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <div x-show="openDel"
                                                class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto"
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
                                                                class="font-bold text-gray-800 dark:text-gray-200">{{ $teacher->employee?->first_name }}</span>
                                                            from the teachers list?
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

                                                        <form action="{{ route('teachers.destroy', $teacher->id) }}"
                                                            method="POST" class="flex-1">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-rose-500/20 transition-all">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- View Icon/Modal --}}

                                        <div x-data="{ openViewModal: false }">
                                            <button @click="openViewModal = true"
                                                class="text-emerald-500 hover:text-emerald-700 px-2 py-1 transition-colors">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>

                                            <div x-show="openViewModal"
                                                class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto"
                                                x-cloak>

                                                <div class="fixed inset-0 bg-black/60 transition-opacity"
                                                    @click="openViewModal = false"></div>

                                                <div
                                                    class="relative bg-white dark:bg-[#161923] rounded-2xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-700">

                                                    <div
                                                        class="px-6 py-4 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-white/5 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                                            Teacher Profile</h3>
                                                        <button @click="openViewModal = false"
                                                            class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Full Name</p>
                                                            <p class="text-sm font-semibold dark:text-white mt-1">
                                                                {{ $teacher->employee?->first_name }}
                                                                {{ $teacher->employee?->last_name }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Specialization</p>
                                                            <p class="text-sm text-emerald-500 font-bold mt-1">
                                                                {{ $teacher->specialization }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                National ID</p>
                                                            <p class="text-sm dark:text-white mt-1">
                                                                {{ $teacher->employee?->notional_id }}</p>
                                                        </div>

                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Salary</p>
                                                            <p class="text-sm dark:text-white mt-1 font-mono">
                                                                ${{ number_format($teacher->employee?->salary ?? 0, 2) }}
                                                            </p>
                                                        </div>

                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Phone Number</p>
                                                            <p class="text-sm dark:text-white mt-1">
                                                                {{ $teacher->employee?->phone }}</p>
                                                        </div>

                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Hire Date</p>
                                                            <p class="text-sm dark:text-white mt-1">
                                                                {{ $teacher->employee?->hire_data }}</p>
                                                        </div>

                                                        <div class="md:col-span-2">
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-wider">
                                                                Home Address</p>
                                                            <p class="text-sm dark:text-white mt-1">
                                                                {{ $teacher->employee?->address }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="px-6 py-4 bg-gray-50 dark:bg-white/5 flex justify-end">
                                                        <button @click="openViewModal = false"
                                                            class="px-5 py-2 bg-gray-200 dark:bg-gray-700 text-xs font-bold rounded-xl text-gray-800 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 transition-all">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic text-sm">No
                                    teachers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $teachers->links() }}
        </div>
    </div>
</x-app-layout>
