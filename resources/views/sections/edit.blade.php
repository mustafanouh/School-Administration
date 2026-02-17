<x-app-layout>


    <div class="py-12">
        <div class=" max-w-6xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('sections.update', $section->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Section Name</label>
                        <input type="text" name="name" class="form-control w-full mt-1 border-gray-300 rounded-md shadow-sm" value="{{ $section->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Grade</label>
                        <select name="grade_id" class="form-select w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $section->grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Academic Year</label>
                        <select name="academic_year_id" class="form-select w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $section->academic_year_id == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Capacity</label>
                        <input type="number" name="capacity" class="form-control w-full mt-1 border-gray-300 rounded-md shadow-sm" value="{{ $section->capacity }}" required>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-2">
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            Update Section
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>