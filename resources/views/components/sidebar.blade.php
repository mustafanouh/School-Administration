@props(['role' => 'Admin'])

<div x-data="{ open: false }" class="flex">
    <aside 
        :class="open ? 'w-[240px]' : 'w-[70px]'"
        class="fixed left-0 top-0 h-screen transition-all duration-300 ease-in-out bg-white dark:bg-[#121212] border-r border-gray-200 dark:border-white/10 z-[1200] flex flex-col overflow-x-hidden shadow-sm"
    >
        <div class="h-[64px] flex items-center justify-end px-3 shrink-0">
            <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 text-gray-500 transition-colors">
                <i class="fas text-lg" :class="open ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
            </button>
        </div>

        <hr class="border-gray-200 dark:border-white/10" />

        <div class="py-6 flex flex-col items-center shrink-0">
            <div 
                :class="open ? 'w-[45px] h-[45px] border-[6px]' : 'w-[30px] h-[30px] border-[3px]'"
                class="rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold border-gray-300/30 transition-all duration-300"
            >
                U
            </div>
            
            <template x-if="open">
                <div class="mt-2 text-center" x-transition>
                    <p class="text-[12px] text-blue-600 font-medium">Role</p>
                    <p class="text-[14px] text-gray-600 dark:text-gray-400 font-semibold">{{ $role }}</p>
                </div>
            </template>
        </div>

        <hr class="border-gray-200 dark:border-white/10" />

        <nav class="flex-1 mt-2 overflow-y-auto overflow-x-hidden custom-scrollbar">
            {{ $slot }}
        </nav>
    </aside>

    <div :class="open ? 'ml-[240px]' : 'ml-[70px]'" class="transition-all duration-300 w-full">
        </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
</style>