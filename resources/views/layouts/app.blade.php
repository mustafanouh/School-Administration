<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
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

        <x-sidebar role="Admin">
            <x-sidebar-link icon="fa-solid fa-school" label="Sections Management" :href="route('sections.index')" :active="request()->routeIs('sections.*')" />
            <x-sidebar-link icon="fas fa-users" label="Employees Management" :href="route('employees.index')" :active="request()->routeIs('employees.*')" />
            <x-sidebar-link icon="fas fa-chalkboard-user" label="Teachers Management" :href="route('teachers.index')"
                :active="request()->routeIs('teachers.*')" />
            <x-sidebar-link icon="fas fa-user-graduate" label="students Management" :href="route('students.index')"
                :active="request()->routeIs('students.*')" />

            <x-sidebar-link icon="fas fa-user-shield" label="Enrollments Management" :href="route('enrollments.index')"
                :active="request()->routeIs('enrollments.*')" />

            <x-sidebar-link icon="fas fa-file-signature" label="Exams Management" :href="route('exams.index')"
                :active="request()->routeIs('exams.*')" />
            <x-sidebar-link icon="fas fa-poll-h" label="Marks Management" :href="route('marks.index')" :active="request()->routeIs('marks.*')" />




            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/10">
                <x-sidebar-link icon="fas fa-sign-out-alt" label="Logout" href="/logout" />
            </div>
        </x-sidebar>

    </div>
</body>

</html>
