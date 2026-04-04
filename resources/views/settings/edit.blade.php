<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-4xl mx-auto min-h-screen rounded-2xl text-left" dir="ltr">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">System Settings</h1>
                <p class="text-sm text-gray-500 font-medium">Manage your personal preferences and application behavior
                </p>
            </div>
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
          

            <div class="space-y-6">

                {{-- Settings Card --}}
                <div
                    class="bg-white dark:bg-[#1a1d29] p-8 rounded-3xl border border-gray-100 dark:border-white/5 shadow-sm">

                    <div class="flex items-center gap-2 mb-8 border-b border-gray-50 dark:border-white/5 pb-4">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg text-indigo-600">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 dark:text-white uppercase text-xs tracking-widest">General
                            Preferences</h3>
                    </div>

                    <div class="space-y-8">

                        {{-- Dark Mode Toggle --}}
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="p-3 bg-gray-100 dark:bg-[#161923] rounded-xl text-gray-500 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">
                                    <i class="fas fa-moon text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-700 dark:text-white">Dark Mode</h4>
                                    <p class="text-[11px] text-gray-400 uppercase font-bold tracking-tighter">Switch
                                        between dark and light themes</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="settings[mode]" value="light">
                                <input type="checkbox" name="settings[mode]" value="dark" class="sr-only peer"
                                    {{$settings['mode'] == 'dark' ? 'checked' : '' }}>
                                <div
                                    class="w-12 h-6 bg-gray-200 dark:bg-[#161923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                </div>
                            </label>
                        </div>

                        {{-- Language Selection --}}
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="p-3 bg-gray-100 dark:bg-[#161923] rounded-xl text-gray-500 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">
                                    <i class="fas fa-language text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-700 dark:text-white">Language</h4>
                                    <p class="text-[11px] text-gray-400 uppercase font-bold tracking-tighter">Select
                                        your preferred interface language</p>
                                </div>
                            </div>
                            <div class="w-full md:w-48">
                                <select name="settings[language]"
                                    class="w-full rounded-xl border-gray-200 dark:bg-[#161923] dark:border-white/10 dark:text-white focus:ring-indigo-500 text-sm">
                                    <option value="ar"
                                        {{ $settings['language'] == 'ar' ? 'selected' : '' }}>العربية
                                        (Arabic)</option>
                                    <option value="en"
                                        {{ $settings['language'] == 'en' ? 'selected' : '' }}>English
                                        (UK)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Notifications Toggle --}}
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="p-3 bg-gray-100 dark:bg-[#161923] rounded-xl text-gray-500 dark:text-gray-400 group-hover:text-indigo-500 transition-colors">
                                    <i class="fas fa-bell text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-700 dark:text-white">Notifications</h4>
                                    <p class="text-[11px] text-gray-400 uppercase font-bold tracking-tighter">Enable or
                                        disable system alerts</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="settings[notification]" value="off">
                                <input type="checkbox" name="settings[notification]" value="on" class="sr-only peer"
                                    {{ $settings['notification'] == 'on' ? 'checked' : '' }}>
                                <div
                                    class="w-12 h-6 bg-gray-200 dark:bg-[#161923] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                </div>
                            </label>
                        </div>

                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-4 py-6">
                    <button type="button" onclick="window.history.back()"
                        class="px-8 py-3 bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-300 rounded-2xl font-bold text-sm">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl shadow-xl shadow-indigo-500/20 font-bold text-sm transition-all transform hover:-translate-y-1">
                        Save Preferences
                    </button>
                </div>

            </div>
        </form>
    </div>
</x-app-layout>
