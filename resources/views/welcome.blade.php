<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - School Administration</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,600,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

     
        .glass-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.4;
        }
    </style>
</head>

<body class="antialiased bg-[#020617] text-white overflow-hidden selection:bg-green-500 selection:text-black">

    <div class="glass-circle bg-green-600 w-[500px] h-[500px] -top-20 -left-20"></div>
    <div class="glass-circle bg-emerald-900 w-[400px] h-[400px] bottom-0 right-0"></div>

    <main class="relative h-screen flex flex-col items-center justify-center px-6 text-center">
        <div id="hero-content">




            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter mb-6" id="wave-text">
                Hi, welcome to School Administration!
            </h1>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center opacity-0" id="cta-buttons">
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto px-8 py-4 bg-green-500 text-black font-extrabold rounded-2xl hover:bg-green-400 transition-all shadow-lg shadow-green-500/20 active:scale-95">
                    Launch Dashboard
                </a>
                <a href="{{ route('register') }}"
                class="w-full sm:w-auto px-8 py-4 bg-gray-900 border border-gray-800 text-white font-bold rounded-2xl hover:bg-gray-800 transition shadow-xl">
                Get Started
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 opacity-0" id="scroll-hint">
            <div class="w-px h-12 bg-gradient-to-b from-green-500 to-transparent"></div>
        </div>
    </main>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const textContainer = document.querySelector('#wave-text');
            const text = textContainer.innerText;

            // 1. تفكيك النص إلى أحرف داخل span لسهولة تحريكها
            textContainer.innerHTML = text.split('').map(char => {
                if (char === " ") return `<span style="display:inline-block; width:0.3em;">&nbsp;</span>`;
                return `<span class="char inline-block opacity-0 translate-y-10 text-green-400">${char}</span>`;
            }).join('');

            // 2. إنشاء التايم لاين للتحريك
            const tl = gsap.timeline();

            // تحريك النافبار أولاً
            tl.to("#navbar", {
                opacity: 1,
                y: 0,
                duration: 0.8
            });

            // 3. تأثير الموجة (Wave/Stagger) للأحرف
            tl.to(".char", {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.05, // الفارق الزمني بين كل حرف والآخر (سرعة الموجة)
                ease: "back.out(1.7)", // حركة ارتدادية خفيفة
                color: "white", // يتغير اللون من الأخضر للأبيض عند الاستقرار
            }, "-=0.4");

            // 4. تحريك بقية العناصر (الوصف والأزرار) بعد انتهاء موجة الأحرف
            tl.to("#sub-title", {
                opacity: 1,
                y: 0,
                duration: 1
            }, "-=0.2");
            tl.to("#cta-buttons", {
                opacity: 1,
                y: 0,
                duration: 1
            }, "-=0.8");
        });
    </script>
</body>

</html>
