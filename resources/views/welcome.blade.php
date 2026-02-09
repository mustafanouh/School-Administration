<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - School Administration</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* تعريف الحركة المتدرجة */
        @keyframes gradient-move {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-move 6s ease infinite;
        }
    </style>
</head>

<body class="antialiased bg-gradient-to-br from-black via-green-900 to-black animate-gradient flex flex-col items-center justify-center h-screen m-0 text-white">

    <div class="absolute top-5 right-5">
        @if (Route::has('login'))
            <nav class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-green-300 hover:text-white transition duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-green-300 hover:text-white transition duration-300">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="font-semibold text-green-300 hover:text-white transition duration-300 border border-green-500 px-4 py-1 rounded-md hover:bg-green-600">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <div class="text-center px-4">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white tracking-tight drop-shadow-lg">
            Hi, welcome to <span class="text-green-400">School Administration!</span>
        </h1>
        <p class="mt-4 text-gray-300 text-lg md:text-xl font-light">
            Your System is ready to go.
        </p>
    </div>

</body>

</html>