@props(['role' => 'Admin'])

<div x-data="{ open: false }" class="flex ">
    {{-- blure --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-200" x-transition:leave-end="opacity-0" @click="open = false"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[1100]">
    </div>

    <aside :class="open ? 'w-[240px]' : 'w-[70px]'"
        class="fixed left-0 top-0 h-screen transition-all duration-300 ease-in-out bg-white dark:bg-[#121212] border-r border-gray-200 dark:border-white/10 z-[1200] flex flex-col overflow-x-hidden shadow-sm">
    </aside>

    <aside :class="open ? 'w-[260px]' : 'w-[70px]'"
        class="fixed left-0 top-0 h-screen transition-all duration-300 ease-in-out bg-white dark:bg-[#121212] border-r border-gray-200 dark:border-white/10 z-[1200] flex flex-col overflow-x-hidden shadow-sm">
        <div class="h-[64px] flex items-center justify-end px-3 shrink-0">
            <button @click="open = !open"
                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 text-gray-500 dark:text-white transition-colors">
                <i class="fas text-lg" :class="open ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
            </button>
        </div>

        <hr class="border-gray-200 dark:border-white/10" />


        <div x-data="{
            profile: JSON.parse(localStorage.getItem('user_profile') || '{}')
        }" class="py-6 flex flex-col items-center shrink-0">

            <div x-data="{ profile: JSON.parse(localStorage.getItem('user_profile') || '{}') }"
                class="relative h-10 w-10 flex items-center justify-center rounded-2xl bg-indigo-600 dark:bg-indigo-500 text-white font-black shadow-lg shadow-indigo-200 dark:shadow-none transition-transform group-hover:scale-95 overflow-hidden">

                <template x-if="profile.avatarUrl">
                    <img :src="profile.avatarUrl" :alt="profile.firstName" class="h-full w-full object-cover">
                </template>

                <template x-if="!profile.avatarUrl">
                    <span x-text="(profile.firstName || '{{ Auth::user()->name }}').charAt(0).toUpperCase()"></span>
                </template>

            </div>

            <template x-if="open">
                <div class="mt-2 text-center" x-transition>
                    <p class="text-[12px] text-blue-600 font-medium">Role</p>
                    <p x-text="profile.roles" class="text-[14px] text-gray-600 dark:text-gray-400 font-semibold"></p>
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
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
</style>
