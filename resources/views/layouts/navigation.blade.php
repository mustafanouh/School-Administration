<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">


                <!-- Navigation Links -->
                <div class="hidden  space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('School Administration') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- search engine --}}
            <div x-data="{ openSearch: false }" class="relative mt-3">
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
                            class="hidden sm:inline-flex items-center px-2 font-sans font-medium text-gray-400 border border-gray-200 rounded text-[10px]">Ctrl
                            K</kbd>
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
                                    results: { students: [], employees: [] },
                                    loading: false,
                                    query: '',
                                    async performSearch() {
                                        if (this.query.length < 2) {
                                            this.results = { students: [], employees: [] };
                                            return;
                                        }
                                        this.loading = true;
                                        try {
                                            const response = await axios.get('/global-search', { params: { query: this.query } });
                                            this.results = response.data.results;
                                        } catch (error) {
                                            console.error('Search Error:', error);
                                        }
                                        this.loading = false;
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
                                        x-show="!loading && (results.students.length > 0 || results.employees.length > 0)">
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
                                                                <span x-text= "employee.first_name + ' ' + employee.last_name"
                                                                    class="text-gray-700 font-medium group-hover:text-green-700"></span>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div x-show="!loading && query.length >= 2 && results.students.length === 0 && results.employees.length === 0"
                                        class="text-center py-10 text-gray-400">
                                        <p>No results found for "<span class="font-semibold" x-text="query"></span>"</p>
                                    </div>

                                    <div x-show="!loading && query.length < 2"
                                        class="text-center py-10 text-gray-400 text-sm">
                                        Type to search...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>






            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
