<x-app-layout>
    <div
        class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left" dir="ltr">

        {{-- Background Artistic Accents - Super Soft & Transparent --}}
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-indigo-100/15 rounded-full blur-[140px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-50/20 rounded-full blur-[120px] -z-10"></div>

        <div class="max-w-5xl mx-auto px-6 space-y-12 relative">

            {{-- 1. Profile Hero Section --}}
            <header id="profile-hero"
                class="opacity-0 bg-white rounded-[3rem] shadow-[0_15px_60px_rgba(0,0,0,0.01)] border border-slate-100 relative overflow-hidden">

                {{-- Decorative Top Bar - Super Subtle Gradient & Pattern --}}
                <div
                    class="h-40 bg-gradient-to-r from-indigo-50/50 via-white to-blue-50/50 relative overflow-hidden border-b border-slate-100">
                    <div class="absolute inset-0 opacity-[0.05]"
                        style="background-image: radial-gradient(circle at 2px 2px, #a5b4fc 1px, transparent 0); background-size: 32px 32px;">
                    </div>
                </div>

                <div class="relative px-12 pb-14 -mt-16">
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-10">

                        {{-- Elevated Avatar - Clean & Modern --}}
                        <div class="flex-none stagger-item">
                            <div
                                class="h-44 w-44 bg-white p-3 rounded-[3.5rem] shadow-xl shadow-indigo-50/10 border border-slate-100">
                                <div
                                    class="h-full w-full bg-slate-50 border border-slate-100 rounded-[2.8rem] flex items-center justify-center text-slate-400 text-6xl font-black italic tracking-tighter">
                                    {{ substr($user->student->first_name ?? ($user->employee->first_name ?? $user->name), 0, 1) }}
                                </div>
                            </div>
                        </div>

                        {{-- Name & Role --}}
                        <div class="flex-grow text-center md:text-left pb-4 stagger-item relative">
                            <h1 id="wave-name"
                                class="text-5xl font-extralight text-slate-950 tracking-tight leading-tight mb-4">
                                @if ($roleName === 'student')
                                    {{ $user->student->first_name }} <span
                                        class="font-bold text-slate-900">{{ $user->student->last_name }}</span>
                                @else
                                    {{ $user->employee->first_name ?? '' }} <span
                                        class="font-bold text-slate-900">{{ $user->employee->last_name ?? '' }}</span>
                                @endif
                            </h1>

                            <div class="flex flex-wrap justify-center md:justify-start gap-3 items-center">
                                <span
                                    class="px-5 py-2 bg-slate-100/70 text-slate-600 text-[10px] font-bold uppercase tracking-[0.2em] rounded-full border border-slate-200">
                                    {{ $roleName }}
                                </span>
                                <span
                                    class="px-5 py-2 bg-indigo-50/40 text-indigo-700 text-[10px] font-bold uppercase tracking-[0.2em] rounded-full border border-indigo-100">
                                    {{ $roleName === 'student' ? 'Academic Record' : $user->employee->job_title ?? 'Staff Member' }}
                                </span>

                                {{-- Actions - High Contrast Buttons --}}
                                <div class="flex gap-2.5 ml-auto">
                                    @php $editRoute = $roleName === 'student' ? route('students.edit', $user->student->id ?? 0) : route('employees.edit', $user->employee->id ?? 0); @endphp
                                    <a href="{{ $editRoute }}"
                                        class="flex items-center justify-center w-12 h-12 bg-white border border-slate-200 text-slate-600 rounded-3xl hover:bg-slate-950 hover:text-white hover:border-slate-950 transition-all shadow-sm group">
                                        <i class="fas fa-user-edit text-xs"></i>
                                    </a>
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center justify-center w-12 h-12 bg-white border border-slate-200 text-slate-600 rounded-3xl hover:bg-slate-950 hover:text-white hover:border-slate-950 transition-all shadow-sm group">
                                        <i class="fas fa-key text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Stats - Softened with border highlights --}}
                    <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-12 stagger-item">
                        <div
                            class="relative group border-l-2 border-slate-100 pl-8 hover:border-indigo-400 transition-colors">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-indigo-600">
                                Gender</p>
                            <p class="text-xl font-medium text-slate-900">
                                {{ $user->student->gender ?? ($user->employee->gender ?? 'N/A') }}</p>
                        </div>

                        <div
                            class="relative group md:border-l-2 border-slate-100 md:pl-8 hover:border-red-400 transition-colors">
                            @if ($roleName === 'student')
                                <p
                                    class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-red-600">
                                    Blood Group</p>
                                <p
                                    class="text-xl font-medium text-red-600/90 italic underline decoration-red-100 underline-offset-4">
                                    {{ $user->student->blood_group ?? 'N/A' }}</p>
                            @else
                                <p
                                    class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-emerald-600">
                                    Net Salary</p>
                                <p class="text-xl font-medium text-emerald-600/90">
                                    ${{ number_format($user->employee->salary ?? 0, 0) }}</p>
                            @endif
                        </div>

                        <div
                            class="relative group md:border-l-2 border-slate-100 md:pl-8 hover:border-blue-400 transition-colors">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-blue-600">
                                {{ $roleName === 'student' ? 'Birth Date' : 'Hire Date' }}
                            </p>
                            <p class="text-xl font-medium text-slate-900">
                                {{ $user->student->date_of_birth ?? ($user->employee->hire_data ?? 'N/A') }}</p>
                        </div>

                        <div
                            class="relative group md:border-l-2 border-slate-100 md:pl-8 hover:border-indigo-400 transition-colors">
                            <p
                                class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1 group-hover:text-indigo-600">
                                Nationality</p>
                            <p class="text-xl font-medium text-slate-900">{{ $user->student->nationality ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            </header>

            {{-- 2. Information Grid: Modern & Clear --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Contact Info Card --}}
                <div
                    class="info-card opacity-0 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.005)] group hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-50/20 transition-all duration-300 border-l-4 border-l-slate-100 group-hover:border-l-indigo-400">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 rounded-[1.8rem] bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-100 group-hover:text-indigo-700 transition-colors shadow-sm shadow-indigo-100/50">
                            <i class="fas fa-phone-alt text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] italic mb-1.5">
                                Primary Contact</p>
                            <p class="text-xl font-medium text-slate-950 mt-1 leading-tight">
                                {{ $user->student->phone_number ?? ($user->employee->phone ?? 'N/A') }}</p>
                            <p
                                class="text-sm text-indigo-700 mt-2 font-medium lowercase tracking-tight underline decoration-indigo-100 underline-offset-4">
                                {{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Location Card --}}
                <div
                    class="info-card opacity-0 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.005)] group hover:border-emerald-100 hover:shadow-xl hover:shadow-emerald-50/20 transition-all duration-300 border-l-4 border-l-slate-100 group-hover:border-l-emerald-400">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 rounded-[1.8rem] bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-100 group-hover:text-emerald-700 transition-colors shadow-sm shadow-emerald-100/50">
                            <i class="fas fa-map-marked-alt text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] italic mb-1.5">
                                Location Registry</p>
                            <p class="text-xl font-medium text-slate-950 mt-1 leading-relaxed">
                                {{ $user->student->address ?? ($user->employee->address ?? 'N/A') }}</p>
                            @if ($roleName === 'student')
                                <p class="text-xs text-slate-400 mt-2 font-light italic">Birth Place:
                                    {{ $user->student->place_of_birth }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Family Information (Only for Students) - Softened Pastels --}}
            @if ($roleName === 'student')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div
                        class="info-card opacity-0 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm group hover:border-blue-100 hover:shadow-lg transition-all border-l-4 border-l-slate-100 group-hover:border-l-blue-400">
                        <div class="flex items-start gap-6">
                            <div
                                class="w-16 h-16 rounded-[1.8rem] bg-blue-50/70 border border-blue-100/50 flex items-center justify-center text-blue-400 group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors shadow-sm shadow-blue-100/30">
                                <i class="fas fa-user-tie text-2xl"></i>
                            </div>
                            <div>
                                <p
                                    class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] italic mb-1.5">
                                    Father's Details</p>
                                <p class="text-xl font-medium text-slate-900">{{ $user->student->father_name }}</p>
                                <p class="text-md text-slate-600 mt-1.5">{{ $user->student->father_phone_number }}</p>
                                <p class="text-xs text-blue-500 mt-1.5 italic font-light tracking-tight">
                                    {{ $user->student->father_email }}</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="info-card opacity-0 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm group hover:border-pink-100 hover:shadow-lg transition-all border-l-4 border-l-slate-100 group-hover:border-l-pink-400">
                        <div class="flex items-start gap-6">
                            <div
                                class="w-16 h-16 rounded-[1.8rem] bg-pink-50/70 border border-pink-100/50 flex items-center justify-center text-pink-400 group-hover:bg-pink-100 group-hover:text-pink-600 transition-colors shadow-sm shadow-pink-100/30">
                                <i class="fas fa-female text-2xl"></i>
                            </div>
                            <div>
                                <p
                                    class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] italic mb-1.5">
                                    Mother's Details</p>
                                <p class="text-xl font-medium text-slate-900">{{ $user->student->mother_name }}</p>
                                <p class="text-md text-slate-600 mt-1.5">{{ $user->student->mother_phone_number }}</p>
                                <p class="text-xs text-pink-500 mt-1.5 italic font-light tracking-tight">
                                    {{ $user->student->mother_email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- 4. Status Banner - Modernized & High Contrast --}}
            <div id="status-banner"
                class="opacity-0 bg-white rounded-[3rem] p-12 shadow-[0_15px_60px_rgba(0,0,0,0.015)] border border-slate-100 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
                {{-- Subtle glow from status indicator --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full -mr-32 -mt-32 blur-2xl"></div>

                <div class="relative">
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.4em] mb-2 italic">Official
                        Registry</p>
                    <h2 class="text-4xl font-extralight text-slate-950 italic tracking-tighter">System Account <span
                            class="font-bold text-indigo-600/90 underline decoration-indigo-100 underline-offset-8">Status</span>
                    </h2>
                </div>

                <div
                    class="flex-none flex items-center gap-5 bg-slate-50 px-10 py-5 rounded-full border border-slate-100 relative group">
                    {{-- Ping animation - softened --}}
                    <span class="relative flex h-3.5 w-3.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-400"></span>
                    </span>
                    <p class="text-emerald-700 text-xl font-black uppercase tracking-tight">
                        {{ $roleName === 'student' ? 'Enrolled' : $user->employee->status ?? 'Active' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- GSAP Animation Script - Slower & Smoother --}}
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

            tl.to("#profile-hero", {
                    opacity: 1,
                    y: 0,
                    duration: 1.8,
                    startAt: {
                        y: 60
                    }
                })
                .to(".info-card", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.18,
                    duration: 1.2,
                    startAt: {
                        y: 30
                    }
                }, "-=1.3")
                .to("#status-banner", {
                    opacity: 1,
                    scale: 1,
                    duration: 1.5,
                    startAt: {
                        scale: 0.95
                    }
                }, "-=1");
        });
    </script>
</x-app-layout>
