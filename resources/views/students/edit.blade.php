<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Student Profile</h1>
                <p class="text-sm text-gray-500 font-medium">Updating records for: <span
                        class="text-indigo-500 font-bold">{{ $student->first_name }} {{ $student->last_name }}</span></p>
            </div>
            <a href="{{ route('students.index') }}"
                class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- ضروري جداً لعملية التحديث --}}

            <div class="space-y-6">

                {{-- Section 1: Basic Information --}}
                <div
                    class="bg-white dark:bg-[#1a1d29] p-8 rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 border-b border-gray-50 dark:border-white/5 pb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 dark:text-white uppercase text-xs tracking-widest">Personal
                            Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">First Name</label>
                            <input type="text" name="first_name"
                                value="{{ old('first_name', $student->first_name) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Gender</label>
                            <select name="gender"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                                <option value="male"
                                    {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"
                                    {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Date of
                                Birth</label>
                            <input type="date" name="date_of_birth"
                                value="{{ old('date_of_birth', $student->date_of_birth) }}" lang="en"
                                dir="ltr"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Place of
                                Birth</label>
                            <input type="text" name="place_of_birth"
                                value="{{ old('place_of_birth', $student->place_of_birth) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Nationality</label>
                            <input type="text" name="nationality"
                                value="{{ old('nationality', $student->nationality) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Address</label>
                            <input type="text" name="address" value="{{ old('address', $student->address) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Student
                                Phone</label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $student->phone_number) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500">
                        </div>
                    </div>
                </div>

                {{-- Section 2: Parents Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Father Info --}}
                    <div
                        class="bg-white dark:bg-[#1a1d29] p-8 rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm border-t-4 border-t-indigo-500">
                        <h3 class="font-bold text-indigo-600 uppercase text-[11px] mb-6">Father's Details</h3>
                        <div class="space-y-4">
                            <input type="text" name="father_name"
                                value="{{ old('father_name', $student->father_name) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Full Name">
                            <input type="text" name="father_phone_number"
                                value="{{ old('father_phone_number', $student->father_phone_number) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Phone Number">
                            <input type="email" name="father_email"
                                value="{{ old('father_email', $student->father_email) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Email Address">
                        </div>
                    </div>

                    {{-- Mother Info --}}
                    <div
                        class="bg-white dark:bg-[#1a1d29] p-8 rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm border-t-4 border-t-pink-500">
                        <h3 class="font-bold text-pink-500 uppercase text-[11px] mb-6">Mother's Details</h3>
                        <div class="space-y-4">
                            <input type="text" name="mother_name"
                                value="{{ old('mother_name', $student->mother_name) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Full Name">
                            <input type="text" name="mother_phone_number"
                                value="{{ old('mother_phone_number', $student->mother_phone_number) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Phone Number">
                            <input type="email" name="mother_email"
                                value="{{ old('mother_email', $student->mother_email) }}"
                                class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white"
                                placeholder="Email Address">
                        </div>
                    </div>
                </div>

                {{-- Section 3: Medical Info --}}
                <div
                    class="bg-white dark:bg-[#1a1d29] p-8 rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm">
                    <div class="flex items-center gap-6">
                        <h3 class="font-bold text-rose-500 uppercase text-[11px]">Blood Group:</h3>
                        <select name="blood_group"
                            class="w-full md:w-1/4 rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-rose-500">
                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                                <option value="{{ $group }}"
                                    {{ old('blood_group', $student->blood_group) == $group ? 'selected' : '' }}>
                                    {{ $group }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-4 py-6">
                    <button type="button" onclick="window.history.back()"
                        class="px-8 py-3 bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-300 rounded-2xl font-bold">Cancel</button>
                    <button type="submit"
                        class="px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl shadow-xl font-bold transition-all transform hover:-translate-y-1">
                        Update Student Info
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
