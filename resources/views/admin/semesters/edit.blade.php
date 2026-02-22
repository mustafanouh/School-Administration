<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumbs / Header --}}
            <div class="mb-8">
                <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-gray-400">
                    <a href="{{ route('academic_years.index') }}" class="hover:text-indigo-600 transition-colors">Academic
                        Years</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-600 dark:text-gray-200">Edit Semester</span>
                </nav>
                        <h1 class="text-3xl font-black text-gray-800 dark:text-white italic">
                    {{ $semester->name }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">Refine the timeline for <span
                        class="font-bold text-indigo-600">{{ $semester->academicYear->name }}</span></p>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-indigo-500/5 border border-gray-100 dark:border-white/5 overflow-hidden">
                <form action="{{ route('semesters.update', $semester) }}" method="POST" class="p-8 md:p-12">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Semester Name (ReadOnly potentially) --}}
                        <div class="md:col-span-2">
                            <label
                                class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Semester
                                Name</label>
                            <input type="text" name="name" value="{{ old('name', $semester->name) }}"
                                class="w-full px-6 py-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl text-gray-700 dark:text-white font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none">
                        </div>

                        {{-- Start Date --}}
                        <div>
                            <label for="start_date"
                                class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Start
                                Date</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-indigo-500">
                                 
                                </div>
                                <input type="date" name="start_date" id="start_date"
                                    value="{{ old('start_date', $semester->start_date) }}"
                                    class="w-full pl-11 pr-4 py-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl text-gray-700 dark:text-white font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none @error('start_date') border-red-500 @enderror">
                            </div>
                            @error('start_date')
                                <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- End Date --}}
                        <div>
                            <label for="end_date"
                                class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">End
                                Date</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-rose-500">
                                   
                                </div>
                                <input type="date" name="end_date" id="end_date"
                                    value="{{ old('end_date', $semester->end_date) }}"
                                    class="w-full pl-11 pr-4 py-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl text-gray-700 dark:text-white font-bold focus:ring-4 focus:ring-indigo-500/10 outline-none @error('end_date') border-red-500 @enderror">
                            </div>
                            @error('end_date')
                                <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Active Status --}}
                        <div
                            class="md:col-span-2 bg-indigo-50/50 dark:bg-indigo-900/10 p-6 rounded-[2rem] border border-indigo-100 dark:border-indigo-900/30">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center text-indigo-500 shadow-sm">
                                        <i class="fas fa-play-circle text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-800 dark:text-white">Current Working
                                            Semester</h4>
                                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">
                                            Activate this to enable mark entry for this period</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                        {{ old('is_active', $semester->is_active) ? 'checked' : '' }}>
                                    <div
                                        class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex gap-4">
                        <button type="submit"
                            class="flex-1 px-8 py-4 bg-gray-900 dark:bg-indigo-600 hover:bg-black dark:hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg transition-all transform hover:-translate-y-1">
                            Update Semester
                        </button>
                        <a href="{{ route('academic_years.index') }}"
                            class="px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300 font-bold rounded-2xl hover:bg-gray-200 transition-all">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
