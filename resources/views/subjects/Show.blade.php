<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Subject Details</h1>
                <p class="text-sm text-gray-500 font-medium">Viewing full information for: <span
                        class="text-indigo-600">{{ $subject->name }}</span></p>
            </div>
            <a href="{{ route('subjects.index') }}"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-bold rounded-xl hover:bg-gray-300 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Back to List
            </a>
        </div>

        {{-- Details Card --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Basic Info --}}
                <div class="space-y-4">
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Subject
                            Name</label>
                        <p class="text-lg font-bold text-gray-800 dark:text-white">{{ $subject->name }}</p>
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Semester</label>
                        <div class="mt-1">
                            <span
                                class="px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg text-xs font-bold uppercase">
                                {{ $subject->semester }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Marks Info --}}
                <div class="bg-gray-50 dark:bg-white/5 rounded-2xl p-6 flex justify-around items-center">
                    <div class="text-center">
                        <span class="block text-[10px] font-black text-rose-500 uppercase">Min Mark</span>
                        <span class="text-2xl font-black text-gray-800 dark:text-white">{{ $subject->min_mark }}</span>
                    </div>
                    <div class="h-10 w-[1px] bg-gray-200 dark:bg-gray-700"></div>
                    <div class="text-center">
                        <span class="block text-[10px] font-black text-emerald-500 uppercase">Max Mark</span>
                        <span class="text-2xl font-black text-gray-800 dark:text-white">{{ $subject->max_mark }}</span>
                    </div>
                </div>

                {{-- Track & Grade --}}
                <div
                    class="flex gap-4 items-center p-4 bg-blue-50/50 dark:bg-blue-900/10 rounded-2xl border border-blue-100 dark:border-blue-900/20">
                    <div class="h-10 w-10 bg-blue-500 rounded-xl flex items-center justify-center text-white">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-blue-500 uppercase">Track & Grade ID</p>
                        <p class="text-sm font-bold text-gray-700 dark:text-gray-300">Track #{{ $subject->track_id }} |
                            Grade #{{ $subject->grade_id }}</p>
                    </div>
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Description</label>
                    <p class="mt-2 text-gray-600 dark:text-gray-400 leading-relaxed italic">
                        {{ $subject->description ?? 'No description provided for this subject.' }}
                    </p>
                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="mt-10 pt-6 border-t border-gray-100 dark:border-white/5 flex gap-3">
                <a href="{{ route('subjects.edit', $subject->id) }}"
                    class="flex-1 bg-indigo-600 text-white text-center py-3 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/20">
                    <i class="fas fa-edit mr-2"></i> Edit Subject
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
