<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 marker: min-h-screen rounded-2xl">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Employees Management</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Records: {{ $employees->total() }}</p>
            </div>

            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                <i class="fas fa-plus mr-2"></i>
                Add New Employee
            </a>
        </div>

        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-100 dark:border-white/5">
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Employee</th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">Title
                            </th>
                            <th class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                Status</th>
                            <th
                                class="px-6 py-4 text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                        @forelse($employees as $employee)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 font-bold uppercase">
                                            {{ substr($employee->first_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $employee->first_name }} {{ $employee->last_name }}</p>
                                            <p class="text-[11px] text-gray-500 font-mono italic">ID:
                                                {{ $employee->notional_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                    {{ $employee->job_title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-500">
                                        {{ $employee->status }}
                                    </span>
                                </td>
                              

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                      

                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 px-2 py-1">
                                         <i class="fa-solid fa-user-pen"></i>
                                        </a>

                                        <div x-data="{ openDeleteModal: false }">
                                            <button @click="openDeleteModal = true"
                                                class="text-rose-500 hover:text-rose-700 px-2 py-1 transition-colors">
                                              <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <div x-show="openDeleteModal"
                                                class="fixed inset-0 z-[60] flex items-center justify-center overflow-y-auto"
                                                x-cloak>
                                                <div class="fixed inset-0 bg-black/50 transition-opacity"
                                                    @click="openDeleteModal = false"></div>
                                                <div
                                                    class="relative bg-white dark:bg-[#161923] rounded-xl shadow-xl max-w-sm w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-700 text-center">
                                                    <div class="p-6">
                                                        <div
                                                            class="w-12 h-12 mx-auto bg-rose-100 rounded-full mb-4 flex items-center justify-center">
                                                          <i class="fa-regular fa-trash-can"></i>
                                                        </div>
                                                        <h3 class="text-lg font-bold dark:text-white">Confirm Delete
                                                        </h3>
                                                        <p class="text-sm text-gray-500 mt-2">Delete <span
                                                                class="font-bold">{{ $employee->first_name }}</span>?
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 flex justify-end gap-3">
                                                        <button @click="openDeleteModal = false" type="button"
                                                            class="text-sm text-gray-600 dark:text-gray-300">Cancel</button>
                                                        <form action="{{ route('employees.destroy', $employee->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-rose-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm">Delete
                                                                Now</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                          <div x-data="{ openViewModal: false }">
                                            <button @click="openViewModal = true"
                                                class="text-green-500 hover:text-green-700 px-2 py-1 transition-colors">
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
                                                            Employee Profile</h3>
                                                        <button @click="openViewModal = false"
                                                            class="text-gray-400 hover:text-gray-600"><i
                                                                class="fas fa-times"></i></button>
                                                    </div>
                                                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                Name</p>
                                                            <p class="text-sm dark:text-white">
                                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                National ID</p>
                                                            <p class="text-sm dark:text-white">
                                                                {{ $employee->notional_id }}</p>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">Job
                                                            </p>
                                                            <p class="text-sm text-indigo-500 font-bold">
                                                                {{ $employee->job_title }}</p>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                Salary</p>
                                                            <p class="text-sm dark:text-white">
                                                                {{ number_format($employee->salary, 2) }}</p>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                Phone</p>
                                                            <p class="text-sm dark:text-white">{{ $employee->phone }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                Hire Date</p>
                                                            <p class="text-sm dark:text-white">
                                                                {{ $employee->hire_data }}</p>
                                                        </div>
                                                        <div class="md:col-span-2">
                                                            <p class="text-[10px] uppercase text-gray-400 font-bold">
                                                                Address</p>
                                                            <p class="text-sm dark:text-white">{{ $employee->address }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="px-6 py-4 bg-gray-50 dark:bg-white/5 flex justify-end">
                                                        <button @click="openViewModal = false"
                                                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-xs font-bold rounded-lg">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>

            
            </tr>
        @empty
            <tr>
                <td colspan="4"
                    class="px-6 py-10 text-center text-gray-500 italic uppercase tracking-widest text-sm">
                    No records found in the database.
                </td>
            </tr>
            @endforelse
            </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $employees->links() }}
    </div>

    </div>
</x-app-layout>
