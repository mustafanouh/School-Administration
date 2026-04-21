<x-app-layout>
    <div class="py-12 bg-[#F9FBFE] min-h-screen relative font-sans text-slate-800 max-w-6xl mx-auto sm:px-6 lg:px-8  rounded-2xl "  dir="ltr">

        {{-- Background Artistic Accents --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-50/40 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-50/20 rounded-full blur-[100px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 space-y-10 relative">

            {{-- 1. Dashboard Header --}}
            <header id="dash-header" class="opacity-0 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-extralight text-slate-900 tracking-tight">
                        Welcome back, <span class="font-bold text-indigo-600">{{ $student->first_name . ' ' . $student->last_name }}</span> 
                    </h1>
                    <p class="text-slate-400 mt-2 font-medium tracking-wide uppercase text-[10px]">
                        Academic Dashboard 
                    </p>
                </div>

                <div class="flex items-center gap-4 bg-white p-3 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="text-right pr-4 border-r border-slate-100">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">{{ now()->format('l') }}</p>
                        <p class="text-sm font-bold text-slate-700">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                        <i class="far fa-calendar-alt text-sm"></i>
                    </div>
                </div>
            </header>

            @php
                // الوصول لأحدث سجل أكاديمي (Current Enrollment)
                $currentEnrollment = $data->enrollments->first();
            @endphp

            @if ($currentEnrollment)
                {{-- 2. Stats Summary Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="stat-card opacity-0 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Grade</p>
                        <p class="text-xl font-black text-slate-900 mt-1">
                            {{ $currentEnrollment->section->grade->name ?? 'N/A' }}</p>
                    </div>

                    <div
                        class="stat-card opacity-0 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Section</p>
                        <p class="text-xl font-black text-slate-900 mt-1">
                            {{ $currentEnrollment->section->name ?? 'N/A' }}</p>
                    </div>

                    <div
                        class="stat-card opacity-0 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Attendance</p>
                        <p class="text-xl font-black text-slate-900 mt-1">{{ $currentEnrollment->attendances->count() }}
                            Records</p>
                    </div>

                    <div
                        class="stat-card opacity-0 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm transition-all group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Year</p>
                        <p class="text-sm font-black text-slate-900 mt-1">{{ $currentEnrollment->academicYear->name }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- 3. Academic Marks Table --}}
                    <div
                        class="main-card opacity-0 lg:col-span-2 bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                            <h3 class="text-lg font-bold text-slate-800">Latest Exam Marks</h3>
                            <span
                                class="text-[10px] font-black bg-indigo-100 text-indigo-600 px-4 py-1.5 rounded-full uppercase tracking-widest">Active
                                Academic Data</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] bg-slate-50/50">
                                        <th class="py-4 px-8">Subject</th>
                                        <th class="py-4 px-4">Exam Type</th>
                                        <th class="py-4 px-8 text-right">Obtained Mark</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($currentEnrollment->marks as $mark)
                                        <tr class="group hover:bg-indigo-50/30 transition-colors">
                                            <td class="py-5 px-8">
                                                <p
                                                    class="font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">
                                                    {{ $mark->exam->subject->name }}</p>
                                            </td>
                                            <td class="py-5 px-4">
                                                <span
                                                    class="text-xs font-medium text-slate-500 italic">{{ $mark->exam->exam_type }}</span>
                                            </td>
                                            <td class="py-5 px-8 text-right">
                                                <span
                                                    class="inline-block px-4 py-1.5 rounded-xl bg-slate-50 border border-slate-100 text-indigo-600 font-black text-sm group-hover:bg-white group-hover:border-indigo-100 transition-all">
                                                    {{ $mark->score }} <span
                                                        class="text-[10px] text-slate-300 mx-1">/</span>
                                                    {{ $mark->exam->max_mark }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-20 text-center">
                                                <div class="flex flex-col items-center">
                                                    <i class="fas fa-clipboard-list text-slate-100 text-5xl mb-4"></i>
                                                    <p class="text-slate-400 italic text-sm font-light">No exam marks
                                                        available for the current period.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- 4. Attendance Sidebar --}}
                    <div class="side-card opacity-0 space-y-8">
                        <div
                            class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm relative overflow-hidden">
                          
                            <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 italic">
                                Attendance Log</h3>

                            <div class="space-y-4">
                                @forelse($currentEnrollment->attendances->take(6) as $attendance)
                                    <div
                                        class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100 group hover:border-emerald-100 transition-all">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-xs font-bold text-slate-600">{{ $attendance->date }}</span>
                                            <span class="text-[9px] text-slate-400">Recorded Entry</span>
                                        </div>
                                        <span
                                            class="text-[9px] font-black uppercase px-3 py-1.2 rounded-lg {{ $attendance->status == 'present' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600 shadow-sm shadow-red-50' }}">
                                            {{ $attendance->status }}
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-xs text-slate-400 italic text-center py-6">No attendance logs found.
                                    </p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Quick Action / Support Widget --}}
                        <div class="bg-slate-600 p-10 rounded-[3.5rem] shadow-2xl relative overflow-hidden group">
                            <div
                                class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000">
                            </div>
                            <h3 class="text-white font-bold text-xl mb-3 relative z-10">Need Assistance?</h3>
                            <p class="text-slate-400 text-xs leading-relaxed mb-8 relative z-10 font-light">Contact the
                                administration office for any inquiries regarding your academic file or technical
                                issues.</p>
                            <a href="mailto:support@school.com"
                                class="inline-flex items-center gap-3 px-8 py-3.5 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-white hover:text-slate-950 transition-all relative z-10">
                                Get Support
                                <i class="fas fa-paper-plane"></i>
                            </a>
                        </div>
                    </div>

                </div>
            @else
                {{-- Empty State if No Enrollment --}}
                <div class="bg-white rounded-[3rem] p-20 border border-slate-100 shadow-sm text-center">
                    <i class="fas fa-user-slash text-slate-100 text-7xl mb-6"></i>
                    <h2 class="text-2xl font-bold text-slate-800">No Active Enrollment Found</h2>
                    <p class="text-slate-400 mt-2">You are not currently enrolled in any academic section for this year.
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- GSAP Animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof gsap === 'undefined') {
                document.querySelectorAll('.opacity-0').forEach(el => el.style.opacity = "1");
                return;
            }
            const tl = gsap.timeline({
                defaults: {
                    ease: "expo.out"
                }
            });
            tl.to("#dash-header", {
                    opacity: 1,
                    y: 0,
                    duration: 1.5,
                    startAt: {
                        y: -20
                    }
                })
                .to(".stat-card", {
                    opacity: 1,
                    scale: 1,
                    stagger: 0.1,
                    duration: 1.2,
                    startAt: {
                        scale: 0.9,
                        opacity: 0
                    }
                }, "-=1.1")
                .to(".main-card", {
                    opacity: 1,
                    x: 0,
                    duration: 1.4,
                    startAt: {
                        x: -40
                    }
                }, "-=0.9")
                .to(".side-card", {
                    opacity: 1,
                    x: 0,
                    duration: 1.4,
                    startAt: {
                        x: 40
                    }
                }, "-=1.4");
        });
    </script>
</x-app-layout>
