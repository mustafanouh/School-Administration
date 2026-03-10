<x-guest-layout>
    <style>
        /* Fallback: If JS fails, show content after 1 second */
        .js-loading .animate-item { opacity: 0; transform: translateY(20px); }
    </style>

    <div id="login-card" class="w-full sm:max-w-md px-8 py-10 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.04)] rounded-[2.5rem] border border-slate-100 opacity-0">
        
        <div class="mb-10 text-center">
            <h2 id="wave-login" class="text-3xl font-black text-slate-800 tracking-tight">
                Welcome Back
            </h2>
            <p class="text-slate-500 mt-2 text-sm opacity-0" id="login-subtext">
                Please enter your details to sign in
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="login-item opacity-0">
                <x-input-label for="email" :value="__('Email Address')" class="font-bold text-slate-700 ml-1" />
                <x-text-input id="email" class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-green-500 py-3" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="login-item opacity-0">
                <x-input-label for="password" :value="__('Password')" class="font-bold text-slate-700 ml-1" />
                <x-text-input id="password" class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-2xl focus:ring-green-500 py-3" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between login-item opacity-0 text-sm px-1">
                <label class="flex items-center text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-green-600 focus:ring-green-500 shadow-sm">
                    <span class="ms-2">Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-green-600 font-bold hover:text-green-700 transition">
                        Forgot password?
                    </a>
                @endif
            </div>

            <div class="login-item opacity-0 pt-2">
                <button type="submit" class="w-full py-4 bg-slate-900 hover:bg-black text-white font-bold rounded-2xl shadow-xl transition active:scale-[0.98]">
                    Sign In
                </button>
            </div>

            <div class="text-center login-item opacity-0">
                <p class="text-slate-500 text-sm">
                    New here? <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline">Create account</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('#login-card');
            
            // Safety Check: If GSAP is missing, just show the card
            if (typeof gsap === 'undefined') {
                card.style.opacity = "1";
                document.querySelectorAll('.login-item, #login-subtext').forEach(el => el.style.opacity = "1");
                return;
            }

            // Split title for wave effect
            const title = document.querySelector('#wave-login');
            const text = title.innerText;
            title.innerHTML = text.split('').map(char => 
                `<span class="login-char inline-block opacity-0 translate-y-4">${char === " " ? "&nbsp;" : char}</span>`
            ).join('');

            const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

            tl.to("#login-card", { opacity: 1, y: 0, duration: 1.2, startAt: { y: 40 } })
              .to(".login-char", { opacity: 1, y: 0, stagger: 0.04, duration: 0.6, color: "#1e293b" }, "-=0.8")
              .to("#login-subtext", { opacity: 1, y: 0, duration: 0.8 }, "-=0.5")
              .to(".login-item", { opacity: 1, y: 0, stagger: 0.1, duration: 0.8, startAt: { y: 20 } }, "-=0.6");
        });
    </script>
</x-guest-layout>