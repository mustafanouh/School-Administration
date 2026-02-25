<x-app-layout>
    <div
        class="relative py-16 bg-[#F0F4F8] dark:bg-[#0B0F1A]  max-w-5xl mx-auto sm:px-6 lg:px-8  min-h-screen overflow-hidden rounded-lg">

        {{-- أشكال جمالية في الخلفية (Blobs) --}}
        <div class="absolute top-0 -left-20 w-96 h-96 bg-purple-300/30 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-300/30 rounded-full blur-[120px] animate-pulse"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">

            {{-- ترحيب عصري --}}
            <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.4em] mb-4 block">Main
                        Panel</span>
                    <h2 class="text-5xl font-black text-gray-900 dark:text-white tracking-tighter">
                        School <span
                            class="italic font-serif text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500 text-6xl">Administration</span>
                    </h2>
                </div>
                <div class="bg-white/50 backdrop-blur-md px-6 py-3 rounded-2xl border border-white shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Active Academic Year</p>
                    <p class="text-sm font-black text-gray-800">2025/2026</p>
                </div>
            </div>

            {{-- الشبكة --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <x-dashboard-card icon="fa-solid fa-school" label="Sections"
                    desc="Monitor class capacity and daily allocations." :href="route('sections.index')" color="indigo" />

                <x-dashboard-card icon="fas fa-user-graduate" label="Students"
                    desc="Access unified student profiles and history." :href="route('students.index')" color="emerald" />

                <x-dashboard-card icon="fas fa-chalkboard-user" label="Teachers"
                    desc="Coordinate faculty members and courses." :href="route('teachers.index')" color="amber" />

                <x-dashboard-card icon="fas fa-file-signature" label="Exams"
                    desc="Review scheduling and testing cycles." :href="route('exams.index')" color="rose" />

                <x-dashboard-card icon="fas fa-poll-h" label="Marks" desc="Analyze grades and performance metrics."
                    :href="route('marks.index')" color="indigo" />

                <x-dashboard-card icon="fas fa-user-shield" label="Enrollments"
                    desc="Manage active registration processes." :href="route('enrollments.index')" color="emerald" />

                <x-dashboard-card icon="fas fa-users" label="Employees" desc="Administrative staff records and HR."
                    :href="route('employees.index')" color="amber" />

                <x-dashboard-card icon="fas fa-calendar-check" label="Timeline"
                    desc="Control years and academic sessions." :href="route('academic_years.index')" color="rose" />

            </div>
        </div>
    </div>
</x-app-layout>
