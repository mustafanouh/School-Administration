<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 marker: min-h-screen rounded-2xl">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Employees Management</h1>
            </div>

            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition-all shadow-lg shadow-indigo-500/20">
                <i class="fas fa-plus mr-2"></i>
                Add New Employee
            </a>
        </div>

        <div class="max-w-4xl mx-auto mt-4 px-4">
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
                                            class="h-10 w-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black shadow-lg ring-4 ring-white dark:ring-gray-700 overflow-hidden">



                                            @if ($employee->hasMedia('employee_profile_photos'))
                                                <img src="{{ $employee->getFirstMediaUrl('employee_profile_photos') }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                {{ substr($employee->first_name, 0, 1) }}
                                            @endif


                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $employee->first_name }} {{ $employee->last_name }}</p>
                                         
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

                                        <div>
                                            <a href="{{ route('employees.show', $employee->id) }}"
                                                class="text-emerald-500 hover:text-emerald-700 px-2 py-1 transition-colors"
                                                title="View Profile">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>


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
