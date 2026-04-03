@props(['card', 'role'])
<a href="{{ $card['route'] }}"
    class="group flex flex-col bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden hover:border-gray-200 dark:hover:border-gray-600 hover:shadow-md transition-all duration-200">

    <div class="p-6 flex-1">
        <div
            class="w-10 h-10 rounded-xl {{ $card['bg'] }} {{ $card['ico'] }} flex items-center justify-center mb-5 text-base transition-transform group-hover:scale-110">
            <i class="{{ $card['icon'] }}"></i>
        </div>
        <p class="font-bold text-gray-900 dark:text-white text-sm leading-tight">{{ $card['label'] }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">{{ $card['desc'] }}</p>
    </div>

    <div class="px-6 py-3 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <span class="text-[10px] font-bold px-2 py-1 rounded-md {{ $card['badge'] }} uppercase tracking-wide">
            {{ $role }}
        </span>
        <span
            class="w-6 h-6 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs group-hover:bg-gray-900 dark:group-hover:bg-white group-hover:text-white dark:group-hover:text-gray-900 transition-colors">
            <i class="fas fa-arrow-right text-[9px]"></i>
        </span>
    </div>
</a>
