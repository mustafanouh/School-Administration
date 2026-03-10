<x-app-layout>
    <div class="py-12 bg-[#F9FBFE] min-h-screen relative overflow-hidden">

        {{-- Background Artistic Accents --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-200/20 rounded-full blur-[140px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-100/30 rounded-full blur-[120px] -z-10">
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- 1. Profile Hero Section --}}
            <div id="profile-hero"
                class="opacity-0 bg-white/70 backdrop-blur-md rounded-[3.5rem] shadow-[0_30px_100px_rgba(0,0,0,0.02)] border border-white relative overflow-hidden">

                {{-- Decorative Top Bar with Mesh Gradient --}}
                <div
                    class="h-40 bg-gradient-to-r from-indigo-50 via-purple-50 to-blue-50 relative overflow-hidden border-b border-white">
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: radial-gradient(circle at 2px 2px, #6366f1 1px, transparent 0); background-size: 32px 32px;">
                    </div>
                </div>

                <div class="relative px-10 pb-12 -mt-16">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-8">

                        {{-- Elevated Avatar --}}
                        <div class="flex-none stagger-item">
                            <div class="h-44 w-44 bg-white p-3 rounded-[3rem] shadow-2xl shadow-indigo-100/50">
                                <div
                                    class="h-full w-full bg-slate-900 rounded-[2.2rem] flex items-center justify-center text-white text-6xl font-black italic tracking-tighter">
                                    {{ substr($user->employee->first_name ?? $user->name, 0, 1) }}
                                </div>
                            </div>
                        </div>

                        {{-- Name & Actions --}}
                        <div class="flex-grow text-center md:text-left pb-4 stagger-item">
                            <h1 id="wave-name"
                                class="text-5xl font-black text-slate-900 tracking-tight leading-none mb-4">
                                {{ $user->employee->first_name ?? '' }} {{ $user->employee->last_name ?? '' }}
                            </h1>

                            <div class="flex flex-wrap justify-center md:justify-start gap-3 items-center">
                                <span
                                    class="px-5 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full">
                                    {{ $roleName }}
                                </span>
                                <span
                                    class="px-5 py-2 bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-[0.2em] rounded-full border border-indigo-100">
                                    {{ $user->employee->job_title ?? 'Staff Member' }}
                                </span>

                                {{-- Actions --}}
                                <div class="flex gap-2 ml-auto">
                                    <a href="{{ route('employees.edit', $user->employee->id ?? 0) }}"
                                        class="flex items-center justify-center w-11 h-11 bg-white border border-slate-100 text-slate-600 rounded-2xl hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="{{ route('profile.edit', $user->employee->id ?? 0) }}"
                                        class="flex items-center justify-center w-11 h-11 bg-white border border-slate-100 text-slate-600 rounded-2xl hover:bg-slate-900 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-key"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Stats with better dividers --}}
                    <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-12 stagger-item">
                        <div class="relative group">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-indigo-500 transition-colors">
                                Gender</p>
                            <p class="text-lg font-bold text-slate-800">{{ $user->employee->gender ?? 'N/A' }}</p>
                        </div>
                        <div class="relative group md:border-l border-slate-100 md:pl-10">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-emerald-500 transition-colors">
                                Net Salary</p>
                            <p class="text-lg font-bold text-emerald-600">
                                ${{ number_format($user->employee->salary ?? 0, 0) }}</p>
                        </div>
                        <div class="relative group md:border-l border-slate-100 md:pl-10">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-blue-500 transition-colors">
                                Hire Date</p>
                            <p class="text-lg font-bold text-slate-800">{{ $user->employee->hire_data ?? 'N/A' }}</p>
                        </div>
                        <div class="relative group md:border-l border-slate-100 md:pl-10">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-indigo-500 transition-colors">
                                Identity</p>
                            <p class="text-lg font-bold text-slate-800">#{{ $user->employee->notional_id ?? '0000' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Contact Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="info-card opacity-0 bg-white p-8 rounded-[3rem] border border-slate-50 shadow-[0_15px_40px_rgba(0,0,0,0.01)] flex items-start gap-6 group hover:border-indigo-100 transition-colors">
                    <div
                        class="w-16 h-16 rounded-[1.5rem] bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i class="fas fa-phone-alt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mobile Number</p>
                        <p class="text-lg font-bold text-slate-800 mt-1 leading-none">
                            {{ $user->employee->phone ?? 'N/A' }}</p>
                        <p class="text-xs text-slate-400 mt-2 italic">Available for business hours</p>
                    </div>
                </div>

                <div
                    class="info-card opacity-0 bg-white p-8 rounded-[3rem] border border-slate-50 shadow-[0_15px_40px_rgba(0,0,0,0.01)] flex items-start gap-6 group hover:border-emerald-100 transition-colors">
                    <div
                        class="w-16 h-16 rounded-[1.5rem] bg-emerald-50 flex items-center justify-center text-emerald-500 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i class="fas fa-map-marked-alt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Office / Residence
                        </p>
                        <p class="text-lg font-bold text-slate-800 mt-1 leading-tight">
                            {{ $user->employee->address ?? 'No address registered' }}</p>
                    </div>
                </div>
            </div>

            {{-- 3. Employment Status Banner --}}
            <div id="status-banner"
                class="opacity-0 bg-slate-900 rounded-[3rem] p-10 shadow-2xl relative overflow-hidden">
                {{-- Decorative circles --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-32 -mt-32"></div>

                <div class="relative flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h2 class="text-3xl font-black text-white italic tracking-tighter">Employment <span
                                class="text-indigo-400">Status</span></h2>
                        <p class="text-slate-400 text-sm mt-1 uppercase tracking-widest font-bold">System Verified
                            Record</p>
                    </div>
                    <div
                        class="flex items-center gap-4 bg-white/5 backdrop-blur-xl px-8 py-4 rounded-3xl border border-white/10">
                        <span class="relative flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500"></span>
                        </span>
                        <p class="text-emerald-400 text-xl font-black uppercase tracking-tighter">
                            {{ str_replace('_', ' ', $user->employee->status ?? 'Active') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') {
                document.getElementById('profile-hero').style.opacity = "1";
                return;
            }
            const tl = gsap.timeline({
                defaults: {
                    ease: "expo.out"
                }
            });

            tl.to("#profile-hero", {
                    opacity: 1,
                    y: 0,
                    duration: 1.5,
                    startAt: {
                        y: 60
                    }
                })
                .from(".name-char", {
                    opacity: 0,
                    y: 15,
                    stagger: 0.02,
                    duration: 0.8
                }, "-=1")
                .to(".info-card", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.2,
                    duration: 1,
                    startAt: {
                        y: 30
                    }
                }, "-=0.8")
                .to("#status-banner", {
                    opacity: 1,
                    scale: 1,
                    duration: 1.2,
                    startAt: {
                        scale: 0.98
                    }
                }, "-=1");
        });
    </script>
</x-app-layout>
