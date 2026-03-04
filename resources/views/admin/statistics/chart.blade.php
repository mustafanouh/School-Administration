<x-app-layout>
   

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6">

                {{-- Global Chart Component --}}
                <x-chart-card id="enrollmentYearlyChart" title="Student Enrollment per Academic Year" :labels="$labels"
                    :values="$values" type="bar" />

                {{-- Placeholder for future metrics --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
