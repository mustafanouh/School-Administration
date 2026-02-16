<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-[#0a0c10]">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161923] shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Create Employee</h2>
                </div>

                <form action="{{ route('employees.store') }}" method="POST" class="p-6">
                    @csrf


                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" name="first_name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" name="last_name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">National
                            </label>
                            <input type="text" name="notional_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Job Title</label>
                            <input type="text" name="job_title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salary</label>
                            <input type="number" step="0.01" name="salary" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                            <select name="gender"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birth Date</label>
                            <input type="date" name="birth_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hire Date</label>
                            <input type="date" name="hire_data" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                                <option value="active">Active</option>
                                <option value="on_leave">On Leave</option>
                                <option value="resigned">Resigned</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" name="address" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="bg-indigo-600 px-6 py-2 text-white rounded-md hover:bg-indigo-700 transition">Save
                            Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
