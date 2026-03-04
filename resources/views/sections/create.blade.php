<x-app-layout>
   

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white shadow-sm sm:rounded-xl p-8">
                
                <form action="{{ route('sections.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block font-semibold text-sm text-gray-700 mb-1">Section Name</label>
                        <input type="text" name="name" 
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                            placeholder="e.g. Section A" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-1">Grade</label>
                            <select name="grade_id" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" required>
                                <option value="" selected disabled>Select Grade</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-semibold text-sm text-gray-700 mb-1">Academic Year</label>
                            <select name="academic_year_id" 
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" required>
                                <option value="" selected disabled>Select Year</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-sm text-gray-700 mb-1">Capacity</label>
                        <input type="number" name="capacity" 
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition" 
                            value="30" required>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t border-gray-100 gap-3">
                        <a href="{{ route('sections.index') }}" 
                            class="px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                            Back
                        </a>
                        <button type="submit" 
                            class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition">
                            Save Section
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>