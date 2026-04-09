<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    class="{{ auth()->user()->getSetting('mode', 'light') === 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js']);
    @vite(['resources/js/search.js']);
</head>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="font-sans antialiased  dark:bg-[#000000f0]">
    <div class="min-h-screen bg-gray-100  dark:bg-[#000000f0]">
        @include('layouts.navigation')


        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>

            </header>
        @endisset

        <!-- Page Content -->
        <div class="py-6">
            {{ $slot }}
        </div>

        <x-sidebar>
            @role('admin')
                <x-sidebar-link icon="fa-solid fa-shield-halved" label="RBAC" :href="route('admin.access.index')" :active="request()->routeIs('admin.access.index')" />
                <x-sidebar-link icon="fas fa-users" label="Employees Management" :href="route('employees.index')" :active="request()->routeIs('employees.*')" />
                <x-sidebar-link icon="fa-solid fa-school" label="Sections Management" :href="route('sections.index')" :active="request()->routeIs('sections.*')" />
                <x-sidebar-link icon="fas fa-chalkboard-user" label="Teachers Management" :href="route('teachers.index')"
                    :active="request()->routeIs('teachers.*')" />
                <x-sidebar-link icon="fas fa-chart-pie" label="Statistics" :href="route('stats.chart')" :active="request()->routeIs('stats.chart')" />
                <x-sidebar-link icon="fas fa-calendar-check" label="Academic Years Management" :href="route('academic_years.index')"
                    :active="request()->routeIs('academic_years.*')" />
                <x-sidebar-link icon="fa-solid fa-book" label="subject Management" :href="route('subjects.index')" :active="request()->routeIs('subjects.*')" />
            @endrole
            @hasanyrole('admin|secretary')
                <x-sidebar-link icon="fas fa-user-graduate" label="students Management" :href="route('students.index')"
                    :active="request()->routeIs('students.*')" />
                <x-sidebar-link icon="fas fa-user-shield" label="Enrollments Management" :href="route('enrollments.index')"
                    :active="request()->routeIs('enrollments.*')" />
            @endhasanyrole

            @hasanyrole('admin|Teacher')
                <x-sidebar-link icon="fas fa-file-signature" label="Exams Management" :href="route('exams.index')"
                    :active="request()->routeIs('exams.*')" />
                <x-sidebar-link icon="fas fa-poll-h" label="Marks Management" :href="route('marks.index')" :active="request()->routeIs('marks.*')" />
            @endhasanyrole

            @hasanyrole('admin|supervisor')
                <x-sidebar-link icon="fas fa-user-clock" label="Student Attendance" :href="route('attendance.sections.index')" :active="request()->routeIs('attendance.sections.index')" />

                <x-sidebar-link icon="fas fa-users-viewfinder" label="staff Attendance" :href="route('attendance.staff.show')"
                    :active="request()->routeIs('attendance.staff.show')" />
            @endhasanyrole







            @hasanyrole('admin|secretary|supervisor|teacher')
                <x-sidebar-link icon="fas fa-message" label="Conversation" :href="route('chat.index')" :active="request()->routeIs('chat.*')" />
            @endhasanyrole

            @role('student')
                <x-sidebar-link icon="fas fa-home" label="portal" :href="route('portal.index')" :active="request()->routeIs('portal.index')" />
                <x-sidebar-link icon="fas fa-poll-h" label=" Marks" :href="route('portal.marks')" :active="request()->routeIs('portal.marks')" />
                <x-sidebar-link icon="fas fa-user-clock" label=" Attendance" :href="route('portal.attendance')" :active="request()->routeIs('portal.attendance')" />
                <x-sidebar-link icon="fa-solid fa-headset" label=" contact" :href="route('portal.contact')" :active="request()->routeIs('portal.contact')" />
            @endrole




            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left appearance-none focus:outline-none">
                        <x-sidebar-link icon="fas fa-sign-out-alt" label="Logout" href="#" />
                    </button>
                </form>
            </div>
            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class=" w-full    flex items-center  mt-10 mb-10 pt-5 pb-5  text-slate-600 hover:bg-rose-50 transition-colors rounded-xl">
                    <i class="fas fa-sign-out-alt w-20"></i>
                </button>
            </form> --}}




        </x-sidebar>




    </div>
    @stack('scripts')
    <script>
        const userData = {
            firstName: "{{ auth()->user()->name }}".split(' ')[0],
            roles: @json(auth()->user()->getRoleNames()),
            lastUpdated: new Date().getTime()
        };


        localStorage.setItem('user_profile', JSON.stringify(userData));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    @if (session('user_avatar_url'))
        <script>
            let profile = JSON.parse(localStorage.getItem('user_profile') || '{}');
            profile.avatarUrl = "{{ session('user_avatar_url') }}";
            profile.firstName = "{{ auth()->user()->name }}";
            localStorage.setItem('user_profile', JSON.stringify(profile));
        </script>
    @endif
</body>

</html>
