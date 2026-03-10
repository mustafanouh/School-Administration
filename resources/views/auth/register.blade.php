<x-guest-layout>
    <div id="register-card" class="w-full sm:max-w-md px-6 py-8 bg-white shadow-[0_15px_40px_rgba(0,0,0,0.04)] rounded-[2rem] border border-slate-100 opacity-0">
        
        <div class="mb-6 text-center">
            <h2 id="wave-register" class="text-2xl font-black text-slate-800 tracking-tight">
                Create Account
            </h2>
            <p class="text-slate-400 mt-1 text-xs opacity-0" id="register-subtext">
                Join our system today
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf

            <div class="reg-item opacity-0">
                <x-input-label for="name" :value="__('Full Name')" class="text-xs font-bold text-slate-600 ml-1" />
                <x-text-input id="name" class="block mt-0.5 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-green-500 py-2 text-sm" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="reg-item opacity-0">
                <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-slate-600 ml-1" />
                <x-text-input id="email" class="block mt-0.5 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-green-500 py-2 text-sm" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="grid grid-cols-2 gap-3 reg-item opacity-0">
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-slate-600 ml-1" />
                    <x-text-input id="password" class="block mt-0.5 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-green-500 py-2 text-sm" type="password" name="password" required />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm')" class="text-xs font-bold text-slate-600 ml-1" />
                    <x-text-input id="password_confirmation" class="block mt-0.5 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-green-500 py-2 text-sm" type="password" name="password_confirmation" required />
                </div>
            </div>

            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />

            <div class="reg-item opacity-0 pt-3">
                <button type="submit" class="w-full py-3.5 bg-slate-900 hover:bg-black text-white font-bold rounded-xl shadow-lg transition active:scale-[0.97]">
                    Register
                </button>
            </div>

            <div class="text-center reg-item opacity-0">
                <p class="text-slate-400 text-xs">
                    Already registered? <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Sign In</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('#register-card');
            if (typeof gsap === 'undefined') {
                card.style.opacity = "1";
                document.querySelectorAll('.reg-item, #register-subtext').forEach(el => el.style.opacity = "1");
                return;
            }

            const title = document.querySelector('#wave-register');
            title.innerHTML = title.innerText.split('').map(char => 
                `<span class="reg-char inline-block opacity-0 translate-y-2">${char === " " ? "&nbsp;" : char}</span>`
            ).join('');

            const tl = gsap.timeline({ defaults: { ease: "power4.out" } });
            tl.to("#register-card", { opacity: 1, y: 0, duration: 1, startAt: {y: 20} })
              .to(".reg-char", { opacity: 1, y: 0, stagger: 0.02, duration: 0.4, color: "#1e293b" }, "-=0.7")
              .to("#register-subtext", { opacity: 1, y: 0 }, "-=0.5")
              .to(".reg-item", { opacity: 1, y: 0, stagger: 0.07, duration: 0.6 }, "-=0.5");
        });
    </script>
</x-guest-layout>