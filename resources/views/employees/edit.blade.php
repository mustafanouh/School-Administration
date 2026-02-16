<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-[#0a0c10]">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161923] shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Edit Employee</h2>
                </div>

                <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    {{-- ربط الموظف بمستخدم (user_id) --}}
                    <input type="hidden" name="user_id" value="{{ $employee->user_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', $employee->first_name) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">National
                                </label>
                            <input type="text" name="notional_id"
                                value="{{ old('notional_id', $employee->notional_id) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Job Title</label>
                            <input type="text" name="job_title" value="{{ old('job_title', $employee->job_title) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salary</label>
                            <input type="number" step="0.01" name="salary"
                                value="{{ old('salary', $employee->salary) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                            <select name="gender"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                                <option value="Male"
                                    {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"
                                    {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birth Date</label>
                            <input type="date" name="birth_date"
                                value="{{ old('birth_date', $employee->birth_date) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hire Date</label>
                            <input type="date" name="hire_data" value="{{ old('hire_data', $employee->hire_data) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                                <option value="active"
                                    {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="on_leave"
                                    {{ old('status', $employee->status) == 'on_leave' ? 'selected' : '' }}>On Leave
                                </option>
                                <option value="resigned"
                                    {{ old('status', $employee->status) == 'resigned' ? 'selected' : '' }}>Resigned
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" name="address" value="{{ old('address', $employee->address) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-[#0f111a] dark:text-white">
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-2">
                        <a href="{{ route('employees.index') }}"
                            class="bg-gray-200 px-6 py-2 text-gray-700 rounded-md hover:bg-gray-300 transition text-sm">Cancel</a>
                        <button type="submit"
                            class="bg-indigo-600 px-6 py-2 text-white rounded-md hover:bg-indigo-700 transition text-sm">Update
                            Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
