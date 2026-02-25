@props(['icon', 'label', 'desc', 'href', 'color' => 'indigo'])

@php
    $themes = [
        'indigo' => 'from-indigo-500 to-blue-600 shadow-indigo-200 text-indigo-600',
        'emerald'=> 'from-emerald-400 to-teal-600 shadow-emerald-200 text-emerald-600',
        'rose'   => 'from-rose-400 to-red-600 shadow-rose-200 text-rose-600',
        'amber'  => 'from-amber-400 to-orange-500 shadow-amber-200 text-amber-600',
    ];
    $currentTheme = $themes[$color] ?? $themes['indigo'];
@endphp

<a href="{{ $href }}" class="group relative block">
    {{-- خلفية مضيئة خلف البطاقة تظهر عند التحويم --}}
    <div class="absolute -inset-2 bg-gradient-to-r {{ $currentTheme }} opacity-0 group-hover:opacity-10 blur-2xl transition-all duration-500 rounded-[3rem]"></div>
    
    <div class="relative bg-white/70 dark:bg-gray-900/50 backdrop-blur-xl border border-white dark:border-white/10 p-8 rounded-[2.5rem] shadow-xl shadow-gray-200/40 dark:shadow-none transition-all duration-500 group-hover:-translate-y-2">
        <div class="flex items-start justify-between mb-8">
            {{-- الأيقونة بتصميم دائري متدرج --}}
            <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br {{ $currentTheme }} text-white shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <i class="{{ $icon }} text-xl"></i>
            </div>
            
            <div class="flex -space-x-2">
                <div class="w-2 h-2 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                <div class="w-2 h-2 rounded-full bg-gray-100 dark:bg-gray-800"></div>
            </div>
        </div>

        <h4 class="text-xl font-black text-gray-800 dark:text-white tracking-tight mb-2">
            {{ $label }}
        </h4>
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium leading-relaxed">
            {{ $desc }}
        </p>

        <div class="mt-8 flex items-center justify-between">
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">
                Open Module
            </span>
            <div class="w-8 h-8 rounded-full border border-gray-100 dark:border-white/10 flex items-center justify-center group-hover:bg-gray-900 dark:group-hover:bg-white group-hover:text-white dark:group-hover:text-black transition-all">
                <i class="fas fa-chevron-right text-[10px]"></i>
            </div>
        </div>
    </div>
</a>