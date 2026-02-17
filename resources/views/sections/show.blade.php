<x-app-layout>
    

    <div class="py-12">
        <div class=" max-w-6xl mx-auto sm:px-6 lg:px-8  space-y-6">

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">General Information</h3>
                    <a href="{{ route('sections.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Grade</p>
                        <p class="font-semibold">{{ $section->grade->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Academic Year</p>
                        <p class="font-semibold">{{ $section->academicYear->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Capacity</p>
                        <p class="font-semibold">{{ $section->enrollments->count() }} / {{ $section->capacity }}
                            Students</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-blue-700">Assigned Teachers & Subjects</h3>
                <table class="table table-sm table-bordered w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>Teacher Name</th>
                            <th>Subject</th>
                            <th>Specialization</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($section->teacherSubjects as $ts)
                            <tr>
                                <td>{{ $ts->teacher->employee->first_name }} {{ $ts->teacher->employee->last_name }}
                                </td>
                                <td>{{ $ts->subject->name }}</td>
                                <td>{{ $ts->teacher->specialization }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500">No teachers assigned yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-green-700">Enrolled Students</h3>
                <table class="table table-sm table-striped w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($section->enrollments as $enrollment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $enrollment->student->first_name ?? 'N/A' }}
                                    {{ $enrollment->student->last_name ?? '' }}</td>
                                <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500">No students enrolled in this
                                    section.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
