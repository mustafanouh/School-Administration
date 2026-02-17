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
                                        <div x-data="{ openViewModal: false }">
                                            <button @click="openViewModal = true"
                                                class="text-emerald-500 hover:text-emerald-700 px-2 py-1 transition-colors"
                                                title="View Profile">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>

                                            <div x-show="openViewModal"
                                                class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto"
                                                x-cloak>

                                                <div class="fixed inset-0 bg-black/60 transition-opacity"
                                                    @click="openViewModal = false"></div>

                                                <div
                                                    class="relative bg-white dark:bg-[#161923] rounded-3xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden border border-gray-100 dark:border-white/5 text-left">

                                                    {{-- Modal Header --}}
                                                    <div
                                                        class="px-8 py-6 border-b border-gray-50 dark:border-white/5 flex justify-between items-center bg-gray-50/50 dark:bg-white/5">
                                                        <div>
                                                            <h3 class="text-xl font-bold dark:text-white">Student Full
                                                                Profile</h3>
                                                            <p class="text-xs text-indigo-500 font-bold uppercase mt-1">
                                                                {{ $student->first_name }} {{ $student->last_name }}
                                                            </p>
                                                        </div>
                                                        <button @click="openViewModal = false"
                                                            class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                    {{-- Modal Body --}}
                                                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-10">
                                                        {{-- Personal Info --}}
                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-widest">
                                                                Birth Details</p>
                                                            <p class="text-sm dark:text-gray-200 mt-1">
                                                                {{ $student->date_of_birth }}
                                                                ({{ $student->place_of_birth }})</p>
                                                        </div>
                                                        <div>
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-widest">
                                                                Gender & Blood</p>
                                                            <p class="text-sm dark:text-gray-200 mt-1 uppercase">
                                                                {{ $student->gender }} |
                                                                {{ $student->blood_group ?? 'N/A' }}</p>
                                                        </div>

                                                        {{-- Parents Info --}}
                                                        <div
                                                            class="p-4 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                                                            <p
                                                                class="text-[10px] uppercase text-indigo-500 font-bold tracking-widest mb-2">
                                                                Father Information</p>
                                                            <p class="text-sm font-bold dark:text-white">
                                                                {{ $student->father_name }}</p>
                                                            <p class="text-xs dark:text-gray-400 mt-1"><i
                                                                    class="fas fa-phone mr-1"></i>
                                                                {{ $student->father_phone_number }}</p>
                                                            <p class="text-[11px] text-gray-400 italic mt-1">
                                                                {{ $student->father_email }}</p>
                                                        </div>

                                                        <div
                                                            class="p-4 rounded-2xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/5">
                                                            <p
                                                                class="text-[10px] uppercase text-pink-500 font-bold tracking-widest mb-2">
                                                                Mother Information</p>
                                                            <p class="text-sm font-bold dark:text-white">
                                                                {{ $student->mother_name }}</p>
                                                            <p class="text-xs dark:text-gray-400 mt-1"><i
                                                                    class="fas fa-phone mr-1"></i>
                                                                {{ $student->mother_phone_number }}</p>
                                                            <p class="text-[11px] text-gray-400 italic mt-1">
                                                                {{ $student->mother_email }}</p>
                                                        </div>

                                                        <div
                                                            class="md:col-span-2 border-t border-gray-50 dark:border-white/5 pt-4">
                                                            <p
                                                                class="text-[10px] uppercase text-gray-400 font-bold tracking-widest">
                                                                Full Address</p>
                                                            <p class="text-sm dark:text-gray-200 mt-1">
                                                                {{ $student->address }}</p>
                                                        </div>
                                                    </div>

                                                    {{-- Modal Footer --}}
                                                    <div class="px-8 py-4 bg-gray-50 dark:bg-white/5 flex justify-end">
                                                        <button @click="openViewModal = false"
                                                            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl text-sm font-bold text-gray-700 dark:text-white transition-colors">
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
