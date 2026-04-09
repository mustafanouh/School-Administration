@props(['role' => 'Admin'])

<div x-data="{ open: false }" class="flex">
    {{-- blur overlay --}}
    <div x-show="open" 
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" 
        @click="open = false"
        class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[1100]">
    </div>

    {{-- Sidebar --}}
    <aside :class="open ? 'w-[260px]' : 'w-[70px]'"
        {{-- التعديل هنا: استخدام start بدلاً من left للتعامل مع الاتجاهين --}}
        class="fixed ltr:left-0 rtl:right-0 top-0 h-screen transition-all duration-300 ease-in-out bg-white dark:bg-[#121212] border-r ltr:border-r rtl:border-l border-gray-200 dark:border-white/10 z-[1200] flex flex-col overflow-x-hidden shadow-sm">
        
        <div class="h-[64px] flex items-center justify-end px-3 shrink-0">
            <button @click="open = !open"
                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 text-gray-500 dark:text-white transition-colors">
                {{-- التعديل هنا: عكس اتجاه السهم بناءً على حالة الفتح واتجاه الصفحة --}}
                <i class="fas text-lg" 
                   :class="open ? 'fa-chevron-left rtl:fa-chevron-right' : 'fa-chevron-right rtl:fa-chevron-left'"></i>
            </button>
        </div>

        <hr class="border-gray-200 dark:border-white/10" />

        {{-- Profile Section --}}
        <div x-data="{ profile: JSON.parse(localStorage.getItem('user_profile') || '{}') }" 
             class="py-6 flex flex-col items-center shrink-0">
            
            <div class="relative h-10 w-10 flex items-center justify-center rounded-2xl bg-indigo-600 dark:bg-indigo-500 text-white font-black shadow-lg overflow-hidden">
                <template x-if="profile.avatarUrl">
                    <img :src="profile.avatarUrl" :alt="profile.firstName" class="h-full w-full object-cover">
                </template>
                <template x-if="!profile.avatarUrl">
                    <span x-text="(profile.firstName || '{{ Auth::user()->name }}').charAt(0).toUpperCase()"></span>
                </template>
            </div>

            <template x-if="open">
                <div class="mt-2 text-center" x-transition>
                    <p class="text-[12px] text-blue-600 font-medium">{{ __('Role') }}</p>
                    <p x-text="profile.roles" class="text-[14px] text-gray-600 dark:text-gray-400 font-semibold"></p>
                </div>
            </template>
        </div>

        <hr class="border-gray-200 dark:border-white/10" />

        <nav class="flex-1 mt-2 overflow-y-auto overflow-x-hidden custom-scrollbar">
            {{ $slot }}
        </nav>
    </aside>

    {{-- Main Content Space Adjuster --}}
    {{-- التعديل هنا: استخدام ms (Margin Start) ليعمل في الجهتين --}}
    <div :class="open ? 'ltr:ml-[260px] rtl:mr-[260px]' : 'ltr:ml-[70px] rtl:mr-[70px]'" 
         class="transition-all duration-300 w-full">
         {{-- محتوى الصفحة هنا --}}
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
