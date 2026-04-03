<nav x-data="{
    open: false,
    darkMode: localStorage.getItem('theme') === 'dark'
}" x-init="$watch('darkMode', val => {
    localStorage.setItem('theme', val ? 'dark' : 'light');
    if (val) document.documentElement.classList.add('dark');
    else document.documentElement.classList.remove('dark');
})"
    class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 sticky top-0 z-40 transition-colors duration-300">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="tracking-tight dark:text-white border-none shadow-none">

                        <h1 class="text-2xl font-black leading-none">
                            <span class="text-indigo-600 dark:text-indigo-400">School </span>Administration
                        </h1>

                    </x-nav-link>
                </div>
            </div>



            {{-- search engine --}}
            <div x-data="{ openSearch: false }" class="relative mt-2">
                <div class="relative max-w-md w-64 lg:w-80 group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" readonly @click="openSearch = true"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-gray-50 placeholder-gray-500 cursor-pointer focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all text-left"
                        placeholder="Search...">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <kbd
                            class="hidden sm:inline-flex items-center px-2 font-sans font-medium text-gray-400 border border-gray-200 rounded text-[10px]">
                            Ctrl K
                        </kbd>
                    </div>
                </div>

                <template x-teleport="body">
                    <div x-show="openSearch" @keydown.window.prevent.ctrl.k="openSearch = true"
                        @keydown.window.escape="openSearch = false"
                        class="fixed inset-0 z-50 flex items-start justify-center pt-16 sm:pt-24"
                        style="display: none;">

                        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-md transition-opacity"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" @click="openSearch = false"></div>

                        <div class="relative w-full max-w-2xl transform px-4 transition-all"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100">

                            <div class="overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5"
                                x-data="{
                                    results: { students: [], employees: [], subjects: [], sections: [] },
                                    loading: false,
                                    query: '',
                                    async performSearch() {
                                        if (this.query.length < 2) {
                                            this.results = { students: [], employees: [], subjects: [], sections: [] };
                                            return;
                                        }
                                        this.loading = true;
                                        try {
                                            const response = await axios.get('/global-search', { params: { query: this.query } });
                                            const data = response.data.results || {};
                                            this.results = {
                                                students: data.students || [],
                                                employees: data.employees || [],
                                                subjects: data.subjects || [],
                                                sections: data.sections || []
                                            };
                                        } catch (error) {
                                            console.error('Search Error:', error);
                                            this.results = { students: [], employees: [], subjects: [], sections: [] };
                                        } finally {
                                            this.loading = false;
                                        }
                                    }
                                }">

                                <div class="relative p-4 border-b border-gray-100">
                                    <input type="text"
                                        class="h-12 w-full border-0 bg-transparent pl-4 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-lg"
                                        placeholder="What are you looking for?" x-model="query"
                                        @keyup.debounce.300ms="performSearch()" x-init="$watch('openSearch', value => value && $nextTick(() => $el.focus()))">
                                </div>

                                <div class="max-h-96 overflow-y-auto p-4 bg-white">

                                    <div x-show="loading" class="flex justify-center py-6">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600">
                                        </div>
                                    </div>

                                    <div
                                        x-show="!loading && (results.students.length > 0 || results.employees.length > 0 || results.subjects.length > 0 || results.sections.length > 0)">
                                        <div class="space-y-6">

                                            <template x-if="results.students.length > 0">
                                                <div>
                                                    <h3
                                                        class="text-xs font-bold text-indigo-600 uppercase mb-2 tracking-wider">
                                                        Students</h3>
                                                    <div class="grid grid-cols-1 gap-2">
                                                        <template x-for="student in results.students"
                                                            :key="'std-' + student.id">
                                                            <a :href="'/students/' + student.id"
                                                                class="p-3 bg-gray-50 hover:bg-indigo-50 rounded-lg flex items-center transition group">
                                                                <span
                                                                    x-text="student.first_name + ' ' + student.last_name"
                                                                    class="text-gray-700 font-medium group-hover:text-indigo-700"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                            <template x-if="results.employees.length > 0">
                                                <div>
                                                    <h3
                                                        class="text-xs font-bold text-green-600 uppercase mb-2 tracking-wider">
                                                        Employees</h3>
                                                    <div class="grid grid-cols-1 gap-2">
                                                        <template x-for="employee in results.employees"
                                                            :key="'emp-' + employee.id">
                                                            <a :href="'/employees/' + employee.id"
                                                                class="p-3 bg-gray-50 hover:bg-green-50 rounded-lg flex items-center transition group">
                                                                <span
                                                                    x-text="employee.first_name + ' ' + employee.last_name"
                                                                    class="text-gray-700 font-medium group-hover:text-green-700"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                            <template x-if="results.subjects.length > 0">
                                                <div>
                                                    <h3
                                                        class="text-xs font-bold text-amber-600 uppercase mb-2 tracking-wider">
                                                        Subjects</h3>
                                                    <div class="grid grid-cols-1 gap-2">
                                                        <template x-for="subject in results.subjects"
                                                            :key="'sub-' + subject.id">
                                                            <a :href="'/subjects/' + subject.id"
                                                                class="p-3 bg-gray-50 hover:bg-amber-50 rounded-lg flex items-center transition group">
                                                                <span x-text="subject.name"
                                                                    class="text-gray-700 font-medium group-hover:text-amber-700"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                            <template x-if="results.sections.length > 0">
                                                <div>
                                                    <h3
                                                        class="text-xs font-bold text-rose-600 uppercase mb-2 tracking-wider">
                                                        Sections</h3>
                                                    <div class="grid grid-cols-1 gap-2">
                                                        <template x-for="section in results.sections"
                                                            :key="'sec-' + section.id">
                                                            <a :href="'/sections/' + section.id"
                                                                class="p-3 bg-gray-50 hover:bg-rose-50 rounded-lg flex items-center transition group">
                                                                <span x-text="section.name"
                                                                    class="text-gray-700 font-medium group-hover:text-rose-700"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                    </div>

                                    <div x-show="!loading && query.length >= 2 && results.students.length === 0 && results.employees.length === 0 && results.subjects.length === 0 && results.sections.length === 0"
                                        class="text-center py-10 text-gray-400">
                                        <p>No results found for "<span class="font-semibold" x-text="query"></span>"</p>
                                    </div>

                                    <div x-show="!loading && query.length < 2"
                                        class="text-center py-10 text-gray-400 text-sm">
                                        Type at least 2 characters to search...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>


            <div class="flex items-center gap-3 sm:gap-6">



                <a href="{{ route('settings.edit') }}"
                    class=" relative inline-block p-2 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-amber-400 hover:bg-gray-100 dark:hover:bg-slate-700 transition-all duration-300 focus:outline-none ring-1 ring-gray-200 dark:ring-slate-700">

                    <i class="fas fa-cog"></i>

                </a>

                {{-- notifications --}}
                <a href="{{ route('notifications.index') }}"
                    class=" relative inline-block p-2 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-amber-400 hover:bg-gray-100 dark:hover:bg-slate-700 transition-all duration-300 focus:outline-none ring-1 ring-gray-200 dark:ring-slate-700">

                    <i class="fas fa-bell"></i>
                    <span id="notification-badge"
                        class="{{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }} 
                     absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center 
                     rounded-full bg-rose-600 text-[10px] font-bold text-white border-2 border-white dark:border-[#0f111a]">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </a>



                <div class="hidden sm:flex items-center">
                    <a href="{{ route('profile.show', ['user' => Auth::id()]) }}"
                        class="group flex items-center gap-3 p-1 pr-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-slate-800 transition-all duration-300 border border-transparent hover:border-gray-100 dark:hover:border-slate-700">
                        <div x-data="{ profile: JSON.parse(localStorage.getItem('user_profile') || '{}') }"
                            class="relative h-10 w-10 flex items-center justify-center rounded-2xl bg-indigo-600 dark:bg-indigo-500 text-white font-black shadow-lg shadow-indigo-200 dark:shadow-none transition-transform group-hover:scale-95 overflow-hidden">

                            <template x-if="profile.avatarUrl">
                                <img :src="profile.avatarUrl" :alt="profile.firstName"
                                    class="h-full w-full object-cover">
                            </template>

                            <template x-if="!profile.avatarUrl">
                                <span
                                    x-text="(profile.firstName || '{{ Auth::user()->name }}').charAt(0).toUpperCase()"></span>
                            </template>

                        </div>

                        <div class="flex flex-col items-start leading-none">
                            <span
                                class="text-sm font-bold text-gray-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                            <span
                                class="text-[10px] text-gray-400 dark:text-slate-500 font-medium uppercase tracking-wider">{{ Auth::user()->getRoleNames()->first() }}</span>
                        </div>
                    </a>
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="p-2 rounded-xl text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-800 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-slate-900 border-t dark:border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-slate-800">
            <div class="flex items-center px-4 gap-3">
                <div class="h-10 w-10 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
