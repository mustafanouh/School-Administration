<x-app-layout>
 

    <div class="py-12  max-w-5xl mx-auto sm:px-6 lg:px-8 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div>
                <x-chart-card 
                    id="enrollmentChart" 
                    title="Student Enrollment Analysis" 
                    :labels="$enrollmentLabels" 
                    :values="$enrollmentValues" 
                    type="bar" 
                />
            </div>

            <hr class="border-gray-200">

            <div>
                <x-chart-card 
                    id="gpaChart" 
                    title="Average Students Performance (GPA)" 
                    :labels="$gpaLabels" 
                    :values="$gpaValues" 
                    type="line" 
                />
            </div>

                <hr class="border-gray-200">

        </div>
    </div>
</x-app-layout>