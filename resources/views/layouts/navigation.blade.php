<nav x-data="{
    open: false,
    darkMode: localStorage.getItem('theme') === 'dark'
}" x-init="$watch('darkMode', val => {
    localStorage.setItem('theme', val ? 'dark' : 'light');
    if (val) document.documentElement.classList.add('dark');
    else document.documentElement.classList.remove('dark');
})"
    class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 sticky top-0 z-40 transition-colors duration-300">

    <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14 sm:h-16 gap-2">

            {{-- Logo --}}
            <div class="flex-shrink-0 invisible sm:visible">
                <a href="{{ route('dashboard') }}" class="tracking-tight dark:text-white border-none shadow-none">
                    <h1 class="text-lg sm:text-2xl font-black leading-none">
                        <span class="text-indigo-600 dark:text-indigo-400">
                            {{ __('School') }}
                        </span>
                        <span>
                            <span class="hidden sm:inline"> {{ __('Administration') }}</span>
                            <span class="sm:hidden"> {{ __('Admin') }}</span>
                        </span>
                    </h1>
                </a>
            </div>

            {{-- Search Engine --}}
            <div x-data="{ openSearch: false }" class="flex-1 min-w-0 max-w-xs ">
                <div class="relative w-full group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 group-hover:text-indigo-500 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" readonly @click="openSearch = true"
                        class="block w-full pl-9 pr-3 py-1.5 sm:py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 dark:bg-slate-800 dark:border-slate-700 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 cursor-pointer focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all"
                        placeholder="Search...">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <kbd
                            class="hidden lg:inline-flex items-center px-2 font-sans font-medium text-gray-400 border border-gray-200 rounded text-[10px]">
                            Ctrl K
                        </kbd>
                    </div>
                </div>

                <template x-teleport="body">
                    <div x-show="openSearch" @keydown.window.prevent.ctrl.k="openSearch = true"
                        @keydown.window.escape="openSearch = false"
                        class="fixed inset-0 z-50 flex items-start justify-center pt-12 sm:pt-24"
                        style="display: none;">

                        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-md transition-opacity"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" @click="openSearch = false"></div>

                        <div class="relative w-full max-w-2xl transform px-3 sm:px-4 transition-all"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100">

                            <div class="overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-2xl ring-1 ring-black ring-opacity-5"
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

                                <div class="relative p-3 sm:p-4 border-b border-gray-100 dark:border-slate-700">
                                    <input type="text"
                                        class="h-10 sm:h-12 w-full border-0 bg-transparent pl-2 pr-4 text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 focus:ring-0 text-base sm:text-lg"
                                        placeholder="What are you looking for?" x-model="query"
                                        @keyup.debounce.300ms="performSearch()" x-init="$watch('openSearch', value => value && $nextTick(() => $el.focus()))">
                                </div>

                                <div class="max-h-80 sm:max-h-96 overflow-y-auto p-3 sm:p-4 bg-white dark:bg-slate-900">

                                    <div x-show="loading" class="flex justify-center py-6">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600">
                                        </div>
                                    </div>

                                    <div
                                        x-show="!loading && (results.students.length > 0 || results.employees.length > 0 || results.subjects.length > 0 || results.sections.length > 0)">
                                        <div class="space-y-4 sm:space-y-6">

                                            <template x-if="results.students.length > 0">
                                                <div>
                                                    <h3
                                                        class="text-xs font-bold text-indigo-600 uppercase mb-2 tracking-wider">
                                                        Students</h3>
                                                    <div class="grid grid-cols-1 gap-2">
                                                        <template x-for="student in results.students"
                                                            :key="'std-' + student.id">
                                                            <a :href="'/students/' + student.id"
                                                                class="p-2.5 sm:p-3 bg-gray-50 dark:bg-slate-800 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg flex items-center transition group">
                                                                <span
                                                                    x-text="student.first_name + ' ' + student.last_name"
                                                                    class="text-gray-700 dark:text-slate-300 text-sm font-medium group-hover:text-indigo-700 dark:group-hover:text-indigo-400"></span>
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
                                                                class="p-2.5 sm:p-3 bg-gray-50 dark:bg-slate-800 hover:bg-green-50 dark:hover:bg-green-900/30 rounded-lg flex items-center transition group">
                                                                <span
                                                                    x-text="employee.first_name + ' ' + employee.last_name"
                                                                    class="text-gray-700 dark:text-slate-300 text-sm font-medium group-hover:text-green-700 dark:group-hover:text-green-400"></span>
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
                                                                class="p-2.5 sm:p-3 bg-gray-50 dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-amber-900/30 rounded-lg flex items-center transition group">
                                                                <span x-text="subject.name"
                                                                    class="text-gray-700 dark:text-slate-300 text-sm font-medium group-hover:text-amber-700 dark:group-hover:text-amber-400"></span>
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
                                                                class="p-2.5 sm:p-3 bg-gray-50 dark:bg-slate-800 hover:bg-rose-50 dark:hover:bg-rose-900/30 rounded-lg flex items-center transition group">
                                                                <span x-text="section.name"
                                                                    class="text-gray-700 dark:text-slate-300 text-sm font-medium group-hover:text-rose-700 dark:group-hover:text-rose-400"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>

                                        </div>
                                    </div>

                                    <div x-show="!loading && query.length >= 2 && results.students.length === 0 && results.employees.length === 0 && results.subjects.length === 0 && results.sections.length === 0"
                                        class="text-center py-8 text-gray-400 dark:text-slate-500 text-sm">
                                        <p>No results found for "<span class="font-semibold" x-text="query"></span>"</p>
                                    </div>

                                    <div x-show="!loading && query.length < 2"
                                        class="text-center py-8 text-gray-400 dark:text-slate-500 text-sm">
                                        Type at least 2 characters to search...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Right Actions --}}
            <div class="flex items-center gap-1.5 sm:gap-3 flex-shrink-0">

                {{-- Settings --}}
                <a href="{{ route('settings.edit') }}"
                    class="relative inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 transition-all duration-300 focus:outline-none ring-1 ring-gray-200 dark:ring-slate-700">
                    <i class="fas fa-cog text-sm"></i>
                </a>

                {{-- Notifications --}}
                <a href="{{ route('notifications.index') }}"
                    class="relative inline-flex items-center justify-center w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-white hover:bg-gray-100 dark:hover:bg-slate-700 transition-all duration-300 focus:outline-none ring-1 ring-gray-200 dark:ring-slate-700">
                    <i class="fas fa-bell text-sm"></i>
                    <span id="notification-badge"
                        class="{{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }} 
                         absolute -top-1 -right-1 flex h-4 w-4 sm:h-5 sm:w-5 items-center justify-center 
                         rounded-full bg-rose-600 text-[9px] sm:text-[10px] font-bold text-white border-2 border-white dark:border-slate-900">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </a>

                {{-- User Profile --}}
                <a href="{{ route('profile.show', ['user' => Auth::id()]) }}"
                    class="group flex items-center gap-2 p-1 sm:pr-3 rounded-2xl hover:bg-gray-50 dark:hover:bg-slate-800 transition-all duration-300 border border-transparent hover:border-gray-100 dark:hover:border-slate-700">

                    <div x-data="{ profile: JSON.parse(localStorage.getItem('user_profile') || '{}') }"
                        class="relative h-8 w-8 sm:h-9 sm:w-9 flex items-center justify-center rounded-xl bg-indigo-600 dark:bg-indigo-500 text-white font-black shadow-md shadow-indigo-200 dark:shadow-none transition-transform group-hover:scale-95 overflow-hidden flex-shrink-0">

                        <template x-if="profile.avatarUrl">
                            <img :src="profile.avatarUrl" :alt="profile.firstName" class="h-full w-full object-cover">
                        </template>

                        <template x-if="!profile.avatarUrl">
                            <span class="text-xs sm:text-sm"
                                x-text="(profile.firstName || '{{ Auth::user()->name }}').charAt(0).toUpperCase()"></span>
                        </template>
                    </div>

                    {{-- Name & Role — hidden on mobile --}}
                    <div class="hidden sm:flex flex-col items-start leading-none">
                        <span
                            class="text-sm font-bold text-gray-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                        <span
                            class="text-[10px] text-gray-400 dark:text-slate-500 font-medium uppercase tracking-wider">{{ Auth::user()->getRoleNames()->first() }}</span>
                    </div>
                </a>

            </div>
        </div>
    </div>

</nav>
