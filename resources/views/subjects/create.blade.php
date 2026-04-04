<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto rounded-2xl shadow-xl mt-10">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Create New Subject</h2>

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            @include('components.form-fields')

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('subjects.index') }}"
                    class="px-6 py-2.5 text-sm font-bold text-gray-500 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-all">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                    Save Subject
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
