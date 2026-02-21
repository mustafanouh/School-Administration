<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-gray-800 dark:text-white tracking-tight">
                        New Journey
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Register a new academic year and auto-generate semesters.
                    </p>
                </div>
                <a href="{{ route('academic_years.index') }}"
                    class="p-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 text-gray-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>

            {{-- Form Card --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-indigo-500/5 border border-gray-100 dark:border-white/5 overflow-hidden">
                <div class="bg-indigo-600 p-1"></div> {{-- Top accent line --}}

                <form action="{{ route('academic_years.store') }}" method="POST" class="p-8 md:p-12">
                    @csrf

                    <div class="space-y-8">
                        {{-- Academic Year Name --}}
                        <div>
                            <label for="name"
                                class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">
                                Academic Year Name
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-calendar-plus text-lg"></i>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="e.g. 2026-2027"
                                    class="w-full pl-11 pr-4 py-4 bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-2xl text-gray-700 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold @error('name') border-red-500 @enderror"
                                    required autofocus>
                            </div>
                            @error('name')
                                <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Automation Notice --}}
                        <div
                            class="flex items-center p-4 bg-amber-50 dark:bg-amber-900/10 rounded-2xl border border-amber-100 dark:border-amber-900/30">
                            <div class="flex-shrink-0 text-amber-500 mr-3 rtl:ml-3">
                                <i class="fas fa-magic"></i>
                            </div>
                            <p class="text-[11px] text-amber-700 dark:text-amber-400 font-bold leading-tight">
                                Magic On! First, Second, and Summer semesters will be automatically generated for this
                                year.
                            </p>
                        </div>

                        {{-- Status Selection --}}
                        <div
                            class="bg-gray-50 dark:bg-white/5 p-6 rounded-[2rem] border border-gray-100 dark:border-white/5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm text-indigo-500">
                                        <i class="fas fa-bullseye text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-800 dark:text-white">Active Status</h4>
                                        <p
                                            class="text-[10px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">
                                            Make this the current year</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                        {{ old('is_active') ? 'checked' : '' }}>
                                    <div
                                        class="w-14 h-7 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-12 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                            Launch Academic Year
                        </button>
                        <a href="{{ route('academic_years.index') }}"
                            class="px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-black rounded-2xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all text-center">
                            Discard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
