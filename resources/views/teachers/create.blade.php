<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-3xl mx-auto min-h-screen rounded-2xl">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Add New Teacher</h1>
            <p class="text-sm text-gray-500">Assign an existing employee to a teaching specialization</p>
        </div>

        <div class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm p-6">
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    {{-- 1. Select Employee --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Employee</label>
                        <select name="employee_id" 
                                class="w-full rounded-xl border-gray-200 dark:border-white/10 dark:bg-[#161923] dark:text-white focus:ring-indigo-500 @error('employee_id') border-rose-500 @enderror">
                            <option value="">-- Choose Employee --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }} ({{ $employee->job_title }})
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id') 
                            <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    {{-- 2. Specialization --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization') }}" 
                               class="w-full rounded-xl border-gray-200 dark:border-white/10 dark:bg-[#161923] dark:text-white focus:ring-indigo-500 @error('specialization') border-rose-500 @enderror"
                               placeholder="e.g. Mathematics, Physics, Arabic">
                        @error('specialization') 
                            <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('teachers.index') }}" 
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-white/5 rounded-xl hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        Create Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>