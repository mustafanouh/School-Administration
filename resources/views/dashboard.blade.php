<x-app-layout>
    <div class="relative max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen dark:bg-[#0f111a]    bg-[#F8FAFC] overflow-hidden py-12 rounded-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (auth()->user()->roles->isEmpty())
                {{-- No Role State --}}
                <div class="flex items-center justify-center min-h-[70vh]">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 p-12 max-w-md w-full text-center">
                        <div
                            class="w-16 h-16 bg-red-50 dark:bg-red-900/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user-lock text-2xl text-red-500"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">No role assigned</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            You don't have access to the dashboard. Please contact your administrator to assign you a
                            role.
                        </p>
                        <form method="POST" action="{{ route('logout') }}" class="mt-8">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl text-sm font-bold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                                <i class="fas fa-sign-out-alt text-xs"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- ===== HEADER ===== --}}
                <div id="dash-header"
                    class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-10 opacity-0">
                    <div>
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-black uppercase tracking-[0.25em] rounded-full mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse inline-block"></span>
                            Management System
                        </span>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white tracking-tight">
                            School Administration
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            Welcome back, <span
                                class="font-bold text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</span>
                        </p>
                    </div>

                    <div
                        class="flex-none bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl overflow-hidden flex items-stretch">
                        <div class="px-5 py-3 border-r border-gray-100 dark:border-gray-700">
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Today</p>
                            <p class="text-sm font-bold text-gray-800 dark:text-white mt-0.5">
                                {{ now()->format('l, M d') }}</p>
                        </div>
                        <div class="px-5 py-3 flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-500 text-sm">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-400">Academic Year</p>
                                <p class="text-xs font-bold text-gray-700 dark:text-gray-200">{{ now()->format('Y') }} –
                                    {{ now()->addYear()->format('Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== STATS ROW (Admin Only) ===== --}}
                @role('admin')
                    <div id="dash-stats" class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10 opacity-0">
                        @foreach ([['label' => 'Total Students', 'value' => \App\Models\Student::count(), 'sub' => 'enrolled this year', 'color' => 'blue'], ['label' => 'Staff Members', 'value' => \App\Models\Employee::count(), 'sub' => 'active employees', 'color' => 'teal'], ['label' => 'Active Sections', 'value' => \App\Models\Section::count(), 'sub' => 'across all grades', 'color' => 'purple'], ['label' => 'Avg. Attendance', 'value' => '91%', 'sub' => 'this week', 'color' => 'amber']] as $stat)
                            <div
                                class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5">
                                <p
                                    class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest mb-2">
                                    {{ $stat['label'] }}</p>
                                <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $stat['sub'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endrole

                {{-- ===== SECTION TITLE ===== --}}
                <p class="text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-5">Quick
                    access</p>

                {{-- ===== NAVIGATION CARDS GRID ===== --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    @role('admin')
                        @php
                            $adminCards = [
                                [
                                    'icon' => 'fas fa-school',
                                    'label' => 'Sections',
                                    'desc' => 'Monitor class capacity',
                                    'route' => route('sections.index'),
                                    'bg' => 'bg-green-50 dark:bg-green-900/20',
                                    'ico' => 'text-green-600 dark:text-green-400',
                                    'badge' => 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                ],
                                [
                                    'icon' => 'fas fa-chalkboard-user',
                                    'label' => 'Teachers',
                                    'desc' => 'Coordinate faculty members',
                                    'route' => route('teachers.index'),
                                    'bg' => 'bg-indigo-50 dark:bg-indigo-900/20',
                                    'ico' => 'text-indigo-600 dark:text-indigo-400',
                                    'badge' =>
                                        'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
                                ],
                                [
                                    'icon' => 'fas fa-users',
                                    'label' => 'Employees',
                                    'desc' => 'Staff records and HR',
                                    'route' => route('employees.index'),
                                    'bg' => 'bg-gray-100 dark:bg-gray-700/40',
                                    'ico' => 'text-gray-600 dark:text-gray-400',
                                    'badge' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                                ],
                                [
                                    'icon' => 'fas fa-calendar-check',
                                    'label' => 'Timeline',
                                    'desc' => 'Control sessions',
                                    'route' => route('academic_years.index'),
                                    'bg' => 'bg-sky-50 dark:bg-sky-900/20',
                                    'ico' => 'text-sky-600 dark:text-sky-400',
                                    'badge' => 'bg-sky-50 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400',
                                ],
                            ];
                        @endphp
                        @foreach ($adminCards as $card)
                            <x-dash-nav-card :card="$card" role="Admin" />
                        @endforeach
                    @endrole

                    @role('student')
                        @php
                            $studentCards = [
                                [
                                    'icon' => 'fas fa-home',
                                    'label' => 'Portal',
                                    'desc' => 'Show news and updates',
                                    'route' => route('portal.index'),
                                    'bg' => 'bg-blue-50 dark:bg-blue-900/20',
                                    'ico' => 'text-blue-600 dark:text-blue-400',
                                    'badge' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                ],
                                [
                                    'icon' => 'fas fa-poll-h',
                                    'label' => 'Marks',
                                    'desc' => 'View academic performance',
                                    'route' => route('portal.marks'),
                                    'bg' => 'bg-emerald-50 dark:bg-emerald-900/20',
                                    'ico' => 'text-emerald-600 dark:text-emerald-400',
                                    'badge' =>
                                        'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                ],
                                [
                                    'icon' => 'fas fa-user-clock',
                                    'label' => 'Attendance',
                                    'desc' => 'Show your attendance record',
                                    'route' => route('portal.attendance'),
                                    'bg' => 'bg-amber-50 dark:bg-amber-900/20',
                                    'ico' => 'text-amber-600 dark:text-amber-400',
                                    'badge' => 'bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                ],
                                [
                                    'icon' => 'fas fa-headset',
                                    'label' => 'Contact',
                                    'desc' => 'Contact with support',
                                    'route' => route('portal.contact'),
                                    'bg' => 'bg-sky-50 dark:bg-sky-900/20',
                                    'ico' => 'text-sky-600 dark:text-sky-400',
                                    'badge' => 'bg-sky-50 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400',
                                ],
                            ];
                        @endphp
                        @foreach ($studentCards as $card)
                            <x-dash-nav-card :card="$card" role="Student" />
                        @endforeach
                    @endrole

                    @hasanyrole('admin|secretary')
                        @php
                            $secCards = [
                                [
                                    'icon' => 'fas fa-user-graduate',
                                    'label' => 'Students',
                                    'desc' => 'Unified student profiles',
                                    'route' => route('students.index'),
                                    'bg' => 'bg-blue-50 dark:bg-blue-900/20',
                                    'ico' => 'text-blue-600 dark:text-blue-400',
                                    'badge' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                ],
                                [
                                    'icon' => 'fas fa-user-shield',
                                    'label' => 'Enrollments',
                                    'desc' => 'Registration processes',
                                    'route' => route('enrollments.index'),
                                    'bg' => 'bg-amber-50 dark:bg-amber-900/20',
                                    'ico' => 'text-amber-600 dark:text-amber-400',
                                    'badge' => 'bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                ],
                            ];
                        @endphp
                        @foreach ($secCards as $card)
                            <x-dash-nav-card :card="$card" role="Admin + Secretary" />
                        @endforeach
                    @endhasanyrole

                    @hasanyrole('admin|teacher')
                        @php
                            $teachCards = [
                                [
                                    'icon' => 'fas fa-file-signature',
                                    'label' => 'Exams',
                                    'desc' => 'Review testing cycles',
                                    'route' => route('exams.index'),
                                    'bg' => 'bg-rose-50 dark:bg-rose-900/20',
                                    'ico' => 'text-rose-600 dark:text-rose-400',
                                    'badge' => 'bg-rose-50 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                ],
                                [
                                    'icon' => 'fas fa-poll-h',
                                    'label' => 'Marks',
                                    'desc' => 'Performance metrics',
                                    'route' => route('marks.index'),
                                    'bg' => 'bg-emerald-50 dark:bg-emerald-900/20',
                                    'ico' => 'text-emerald-600 dark:text-emerald-400',
                                    'badge' =>
                                        'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                ],
                            ];
                        @endphp
                        @foreach ($teachCards as $card)
                            <x-dash-nav-card :card="$card" role="Admin + Teacher" />
                        @endforeach
                    @endhasanyrole

                </div>

            @endif
        </div>
    </div>

    @if (!auth()->user()->roles->isEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof gsap === 'undefined') {
                    ['dash-header', 'dash-stats'].forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.style.opacity = 1;
                    });
                    return;
                }
                const tl = gsap.timeline({
                    defaults: {
                        ease: "power3.out"
                    }
                });
                tl.to("#dash-header", {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        startAt: {
                            y: -16
                        }
                    })
                    .to("#dash-stats", {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        startAt: {
                            y: 12
                        }
                    }, "-=0.4");
            });
        </script>
    @endif


</x-app-layout>


