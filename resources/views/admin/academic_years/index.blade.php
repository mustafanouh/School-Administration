<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-900 max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-800 dark:text-white tracking-tight">
                        Academic Years
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Manage school sessions and their associated semesters.
                    </p>
                </div>
                <a href="{{ route('academic_years.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-indigo-500/20 transition-all transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Academic Year
                </a>
            </div>

            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Academic Years Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($academicYears as $year)
                    <div
                        class="relative group bg-white dark:bg-gray-800 rounded-[2rem] p-6 border-2 {{ $year->is_active ? 'border-indigo-500' : 'border-transparent hover:border-gray-200 dark:hover:border-gray-700' }} shadow-sm transition-all duration-300">

                        {{-- Active Badge --}}
                        @if ($year->is_active)
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-500 text-white text-[10px] px-4 py-1 rounded-full font-black uppercase tracking-widest shadow-lg shadow-indigo-500/40">
                                Current Active
                            </div>
                        @endif

                        <div class="flex justify-between items-start mb-6">
                            <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-2xl">
                                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('academic_years.edit', $year) }}"
                                    class="p-2 text-gray-400 hover:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('academic_years.destroy', $year) }}" method="POST"
                                    onsubmit="return confirm('Are you sure? This will delete all related data.');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-gray-400 hover:text-rose-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <h2 class="text-2xl font-black text-gray-800 dark:text-white mb-2 italic">
                            {{ $year->name }}
                        </h2>

                        {{-- Semesters Preview --}}
                        <div class="mt-6 pt-6 border-t border-gray-50 dark:border-gray-700">

                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Linked
                                Semesters</p>

                            <div class="flex flex-wrap gap-2">
                                @forelse($year->semesters as $semester)
                                    <span>

                                        <a href="{{ route('semesters.edit', $semester) }}"
                                            class="px-3 py-1 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 {{ $semester->is_active ? 'text-green-900 border-green-600 bg-green-50' : 'text-gray-400 border-indigo-100' }}   dark:text-indigo-400 text-[10px] font-bold rounded-lg border border-indigo-100 dark:border-indigo-800">
                                            {{ $semester->name }}


                                        </a>
                                    </span>





                                @empty
                                    <span class="text-xs text-gray-400 italic font-medium text-rose-500">No
                                        semesters
                                        generated yet.</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white dark:bg-gray-800 rounded-[2rem] p-12 text-center border-2 border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-gray-500 font-bold">No academic years found. Start by creating the first one!</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $academicYears->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
