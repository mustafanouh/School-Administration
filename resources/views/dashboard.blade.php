<x-app-layout>
    <div class="relative max-w-6xl mx-auto sm:px-6 lg:px-8  min-h-screen bg-[#F8FAFC] overflow-hidden py-12">

        {{-- Subtle Soft Background Decorations --}}
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
                    <p class="text-slate-500 mt-2 font-medium">Welcome back! Here is what's happening today.</p>
                </div>

                <div
                    class="bg-white px-5 py-3 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Academic Year</p>
                        <p class="text-sm font-black text-slate-700">2025 / 2026</p>
                    </div>
                </div>
            </div>

            {{-- Grid of Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Grouping cards into a class for GSAP stagger --}}
                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fa-solid fa-school" label="Sections" desc="Monitor class capacity."
                        :href="route('sections.index')" color="green" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-user-graduate" label="Students" desc="Unified student profiles."
                        :href="route('students.index')" color="blue" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-chalkboard-user" label="Teachers" desc="Coordinate faculty members."
                        :href="route('teachers.index')" color="indigo" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-file-signature" label="Exams" desc="Review testing cycles."
                        :href="route('exams.index')" color="rose" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-poll-h" label="Marks" desc="Performance metrics." :href="route('marks.index')"
                        color="emerald" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-user-shield" label="Enrollments" desc="Registration processes."
                        :href="route('enrollments.index')" color="amber" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-users" label="Employees" desc="Staff records and HR."
                        :href="route('employees.index')" color="slate" />
                </div>

                <div class="dash-card opacity-0 translate-y-6">
                    <x-dashboard-card icon="fas fa-calendar-check" label="Timeline" desc="Control sessions."
                        :href="route('academic_years.index')" color="sky" />
                </div>

            </div>
        </div>
    </div>

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
</x-app-layout>
