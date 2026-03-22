<x-app-layout>
    <div class="py-12 bg-[#F9FBFE] dark:bg-gray-950 min-h-screen font-sans text-slate-800 dark:text-gray-200"
        dir="ltr">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- الكرت الرئيسي بتصميم مشابه للسجل الأكاديمي --}}
            <div
                class="bg-white dark:bg-gray-900 rounded-[3rem] shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">

                {{-- Header: مقتبس من ستايل الجرني الأكاديمي مع خلفية ناعمة --}}
                <div
                    class="px-8 py-12 border-b border-gray-50 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 text-center space-y-4">
                    <div class="flex justify-center mb-4">
                        <div
                            class="w-16 h-16 bg-indigo-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-200 dark:shadow-none">
                            <i class="fa-solid fa-headset text-5xl"></i>
                        </div>
                    </div>
                    <h2
                        class="text-3xl md:text-4xl font-black text-gray-800 dark:text-white tracking-tight italic uppercase">
                        Get In Touch
                    </h2>
                    <p class="text-sm text-gray-400 font-bold uppercase tracking-[0.2em]">
                        We are here to help you anytime
                    </p>
                    <div class="flex justify-center mt-4">
                        <div class="w-20 h-1 bg-indigo-500 rounded-full"></div>
                    </div>
                </div>

                <div class="p-8 md:p-14">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-16">

                        {{-- القسم الأيسر: Contact Info --}}
                        <div class="md:col-span-5 space-y-10">
                            <div>
                                <h5
                                    class="text-lg font-black text-gray-800 dark:text-white uppercase tracking-tight italic mb-6 flex items-center gap-3">
                                    <span class="w-1 h-6 bg-indigo-500 rounded-full"></span>
                                    Contact Information
                                </h5>

                                <div class="space-y-6">
                                    {{-- Phone --}}
                                    <div
                                        class="flex items-center gap-5 p-4 rounded-3xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                        <div
                                            class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                                Phone Number</p>
                                            <p class="text-sm font-bold text-gray-700 dark:text-gray-200">+966 50 123
                                                4567</p>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div
                                        class="flex items-center gap-5 p-4 rounded-3xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                        <div
                                            class="w-12 h-12 bg-rose-50 dark:bg-rose-900/20 text-rose-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                                Email Address</p>
                                            <p class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                                support@school-system.edu</p>
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div
                                        class="flex items-center gap-5 p-4 rounded-3xl hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border border-transparent hover:border-gray-100 dark:hover:border-gray-700">
                                        <div
                                            class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                                Address</p>
                                            <p class="text-sm font-bold text-gray-700 dark:text-gray-200">Syria, Aleppo
                                                - school Campus</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Social Media --}}
                            <div class="pt-4 px-4 text-center md:text-left">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Follow
                                    Our Journey</p>
                                <div class="flex justify-center md:justify-start gap-4">
                                    <a href="#"
                                        class="w-10 h-10 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:shadow-lg hover:shadow-indigo-100 transition-all"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-400 hover:text-indigo-400 hover:shadow-lg hover:shadow-indigo-100 transition-all"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="#"
                                        class="w-10 h-10 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-400 hover:text-indigo-700 hover:shadow-lg hover:shadow-indigo-100 transition-all"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>

                        {{-- القسم الأيمن: Form --}}
                        <div class="md:col-span-7">
                            <h5
                                class="text-lg font-black text-gray-800 dark:text-white uppercase tracking-tight italic mb-8 flex items-center gap-3">
                                <span class="w-1 h-6 bg-indigo-500 rounded-full"></span>
                                Send Us a Message
                            </h5>

                            <form action="#" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Your
                                            Name</label>
                                        <input type="text"
                                            class="w-full bg-gray-50/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm p-4 dark:text-white transition-all">
                                    </div>
                                    <div class="space-y-2">
                                        <label
                                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Email
                                            Address</label>
                                        <input type="email"
                                            class="w-full bg-gray-50/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm p-4 dark:text-white transition-all">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Subject</label>
                                    <input type="text"
                                        class="w-full bg-gray-50/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm p-4 dark:text-white transition-all">
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Message
                                        Detail</label>
                                    <textarea rows="5"
                                        class="w-full bg-gray-50/50 dark:bg-gray-800/50 border-gray-100 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm p-4 dark:text-white transition-all"></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-indigo-100 dark:shadow-none uppercase tracking-[0.3em] text-[10px] mt-4">
                                    Deliver Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
