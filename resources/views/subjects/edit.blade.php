<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Subject</h1>
            <p class="text-sm text-gray-500">Update existing subject parameters and requirements</p>
        </div>

        <div class="bg-white dark:bg-[#1a1d29] rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm p-8">
            <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- استدعاء الحقول المشتركة --}}
                @include('components.form-fields')

                <div class="mt-10 flex items-center justify-end gap-4">
                    <a href="{{ route('subjects.index') }}"
                        class="text-sm font-bold text-gray-500 hover:text-gray-700">Cancel</a>
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">
                        <i class="fas fa-save mr-2"></i> Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
