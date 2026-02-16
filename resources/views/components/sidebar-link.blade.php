@props(['icon', 'label', 'href' => '#', 'active' => false])

<div class="px-2 py-1">
    <a href="{{ $href }}" 
        class="flex items-center min-h-[48px] rounded-lg transition-all duration-200 group
        {{ $active ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600' : 'text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-white/5 hover:-translate-y-1 hover:shadow-lg' }}"
    >
        <div class="min-w-[54px] flex justify-center items-center" title="{{ $label }}">
            <i class="{{ $icon }} text-lg transition-colors {{ $active ? 'text-indigo-600' : 'group-hover:text-indigo-500' }}"></i>
        </div>

        <span 
            x-show="open" 
            x-transition.opacity
            class="ml-2 text-sm font-medium whitespace-nowrap overflow-hidden"
        >
            {{ $label }}
        </span>
    </a>
</div>