<x-app-layout>
    <div class="p-6 bg-gray-50 dark:bg-[#0f111a] max-w-5xl mx-auto sm:px-6 lg:px-8 min-h-screen rounded-2xl text-left"
        dir="ltr">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Notifications Center</h1>
                <p class="text-sm text-gray-500 font-medium">Stay updated with the latest system activities</p>
            </div>
            @if ($notifications->count() > 0)
                <form action="{{ route('notifications.clear') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2.5 bg-rose-600/10 hover:bg-rose-600 text-rose-600 hover:text-white text-sm font-bold rounded-xl transition-all border border-rose-600/20">
                        <i class="fas fa-trash-alt mr-2"></i> Clear All
                    </button>
                </form>
            @endif
        </div>

        {{-- Notifications List --}}
        <div
            class="bg-white dark:bg-[#1a1d29] rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm overflow-hidden">
            <div id="notifications-list" class="divide-y divide-gray-100 dark:divide-white/5">
                @forelse($notifications as $notification)
                    <div
                        class="p-5 flex justify-between items-start hover:bg-gray-50/50 dark:hover:bg-white/5 transition-colors {{ $notification->read_at ? '' : 'bg-indigo-50/30 dark:bg-indigo-900/10' }}">
                        <div class="flex gap-4">
                            {{-- Icon based on notification status --}}
                            <div
                                class="w-10 h-10 rounded-xl flex items-center justify-center {{ $notification->read_at ? 'bg-gray-100 dark:bg-gray-800 text-gray-400' : 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600' }}">
                                <i
                                    class="fa-solid {{ $notification->read_at ? 'fa-bell-slash' : 'fa-bell animate-tada' }}"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $notification->data['message'] ?? 'New Notification Received' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        @if (!$notification->read_at)
                            <div class="flex items-center">
                                <span
                                    class="h-2 w-2 bg-indigo-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.6)]"></span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div id="empty-message" class="px-6 py-20 text-center">
                        <div
                            class="w-20 h-20 mx-auto bg-gray-100 dark:bg-white/5 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-inbox text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">All caught up!</h3>
                        <p class="text-sm text-gray-400 italic mt-1">No new notifications at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>

    {{-- Real-time Receiver Script --}}
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            const userId = "{{ auth()->id() }}";
            const notificationsList = document.getElementById('notifications-list');
            const emptyMessage = document.getElementById('empty-message');

            window.Echo.private(`App.Models.User.${userId}`)
                .notification((notification) => {

                    const badge = document.getElementById('notification-badge');

                    if (badge) {
                        badge.classList.remove('hidden');

                        let currentCount = parseInt(badge.innerText) || 0;
                        badge.innerText = currentCount + 1;

                        badge.classList.add('animate-bounce');
                        setTimeout(() => badge.classList.remove('animate-bounce'), 2000);
                    }

                    // Remove empty state if exists
                    if (emptyMessage) emptyMessage.remove();

                    // Modern Notification Template
                    const newNotifyHtml = `
                        <div class="p-5 flex justify-between items-start bg-indigo-50/50 dark:bg-indigo-900/20 border-b border-gray-100 dark:border-white/5 animate-pulse transition-all">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 font-bold">
                                    <i class="fa-solid fa-bell"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 dark:text-white">${notification.message}</p>
                                    <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-1 font-medium italic">Just now</p>
                                </div>
                            </div>
                            <span class="h-2 w-2 bg-indigo-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.6)]"></span>
                        </div>
                    `;

                    // Add to top with smooth transition
                    notificationsList.insertAdjacentHTML('afterbegin', newNotifyHtml);

                    // Trigger sound or browser alert if desired
                    console.log('New notification received via Reverb');
                });
        });
    </script>

    <style>
        @keyframes tada {
            0% {
                transform: scale(1);
            }

            10%,
            20% {
                transform: scale(0.9) rotate(-3deg);
            }

            30%,
            50%,
            70%,
            90% {
                transform: scale(1.1) rotate(3deg);
            }

            40%,
            60%,
            80% {
                transform: scale(1.1) rotate(-3deg);
            }

            100% {
                transform: scale(1) rotate(0);
            }
        }

        .animate-tada {
            animation: tada 1s ease-in-out infinite;
            animation-iteration-count: 2;
        }
    </style>
</x-app-layout>
