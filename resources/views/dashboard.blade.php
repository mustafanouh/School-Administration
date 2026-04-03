<x-app-layout>
    <div class="relative max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen bg-[#F8FAFC] overflow-hidden py-12">

        @if (auth()->user()->roles->isEmpty())
            <div class="flex flex-col items-center justify-center min-h-[60vh] text-center">
                <div class="bg-white p-10 rounded-3xl shadow-xl border border-slate-100 max-w-md">
                    <div
                        class="w-20 h-20 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-lock text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800 mb-2">your don't have any roles!</h2>
                    <p class="text-slate-500 font-medium"> sorry, you don't have access to the dashboard. Please contact
                        your administrator to assign you a role.
                    </p>
                    <form method="POST" action="{{ route('logout') }}" class="mt-8">
                        @csrf
                        <button type="submit" class="text-rose-600 font-bold hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        @else
            {{-- \Roles --}}
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-100/40 rounded-full blur-[100px] -z-10"></div>
            <div class="absolute bottom-20 right-1/4 w-64 h-64 bg-blue-100/40 rounded-full blur-[80px] -z-10"></div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                {{-- Modern Header Section --}}
                <div id="dashboard-header"
                    class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 opacity-0">
                    <div>
                        <span
                            class="inline-block px-3 py-1 bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-[0.3em] rounded-full mb-3">
                            Management System
                        </span>
                        <h2 id="wave-title" class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">
                            School Administration
                        </h2>
                        <p class="text-slate-500 mt-2 font-medium">Welcome back, {{ auth()->user()->name }}!</p>
                    </div>

                    <div class="flex items-center gap-4 bg-white p-3 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="text-right pr-4 border-r border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase">{{ now()->format('l') }}</p>
                            <p class="text-sm font-bold text-slate-700">{{ now()->format('M d, Y') }}</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                            <i class="far fa-calendar-alt text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Grid of Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Admin Only Cards --}}
                    @role('admin')
                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fa-solid fa-school" label="Sections" desc="Monitor class capacity."
                                :href="route('sections.index')" color="green" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-chalkboard-user" label="Teachers"
                                desc="Coordinate faculty members." :href="route('teachers.index')" color="indigo" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-users" label="Employees" desc="Staff records and HR."
                                :href="route('employees.index')" color="slate" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-calendar-check" label="Timeline" desc="Control sessions."
                                :href="route('academic_years.index')" color="sky" />
                        </div>
                    @endrole


                    @role('student')
                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-home" label="portal" desc=" show news and updates."
                                :href="route('portal.index')" color="blue" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-poll-h" label="Marks" desc="View your academic performance."
                                :href="route('portal.marks')" color="emerald" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-user-clock" label="Attendance"
                                desc="show your attendance record." :href="route('portal.attendance')" color="amber" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fa-solid fa-headset" label="contact" desc="contact with support."
                                :href="route('portal.contact')" color="sky" />
                        </div>
                    @endrole

                    {{-- Admin & Secretary Cards --}}
                    @hasanyrole('admin|secretary')
                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-user-graduate" label="Students" desc="Unified student profiles."
                                :href="route('students.index')" color="blue" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-user-shield" label="Enrollments" desc="Registration processes."
                                :href="route('enrollments.index')" color="amber" />
                        </div>
                    @endhasanyrole

                    {{-- Admin & Teacher Cards --}}
                    @hasanyrole('admin|teacher')
                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-file-signature" label="Exams" desc="Review testing cycles."
                                :href="route('exams.index')" color="rose" />
                        </div>

                        <div class="dash-card opacity-0 translate-y-6">
                            <x-dashboard-card icon="fas fa-poll-h" label="Marks" desc="Performance metrics."
                                :href="route('marks.index')" color="emerald" />
                        </div>
                    @endhasanyrole

                </div>
            </div>
        @endif
    </div>

    {{-- GSAP Animations --}}
    @if (!auth()->user()->roles->isEmpty())
        {{-- GSAP Animations --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap === 'undefined') {
                    // Show items if GSAP is not available
                    document.getElementById('dashboard-header').style.opacity = "1";
                    document.querySelectorAll('.dash-card').forEach(c => c.style.opacity = "1");
                    return;
                }

                const tl = gsap.timeline({
                    defaults: {
                        ease: "power4.out"
                    }
                });

                // 1. Header Entrance
                tl.to("#dashboard-header", {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    startAt: {
                        y: -20
                    }
                });

                // 2. Wave Text Effect for the Title
                const title = document.querySelector('#wave-title');
                const text = title.innerText;
                title.innerHTML = text.split('').map(char =>
                    `<span class="title-char inline-block opacity-0 translate-y-4">${char === " " ? "&nbsp;" : char}</span>`
                ).join('');

                tl.to(".title-char", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.03,
                    duration: 0.6,
                    color: "#1e293b"
                }, "-=0.6");

                // 3. Staggered Card Entrance
                tl.to(".dash-card", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.1,
                    duration: 0.8
                }, "-=0.4");
            });
        </script>
    @endif
</x-app-layout>


@if (session('user_avatar_url'))
    <script>
    
        let profile = JSON.parse(localStorage.getItem('user_profile') || '{}');

      
        profile.avatarUrl = "{{ session('user_avatar_url') }}";
        profile.firstName = "{{ auth()->user()->name }}";
            
        localStorage.setItem('user_profile', JSON.stringify(profile));
    </script>
@endif
