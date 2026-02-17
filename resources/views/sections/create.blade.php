<x-app-layout>
 

    <div class="py-12">
        <div class=" max-w-6xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Section Name</label>
                        <input type="text" name="name" class="form-control w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="e.g. Section A" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Grade</label>
                        <select name="grade_id" class="form-select w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="" selected disabled>Select Grade</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Academic Year</label>
                        <select name="academic_year_id" class="form-select w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="" selected disabled>Select Year</option>
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Capacity</label>
                        <input type="number" name="capacity" class="form-control w-full mt-1 border-gray-300 rounded-md shadow-sm" value="30" required>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-2">
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save Section
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>