<x-app-layout>
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 min-h-screen">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl flex border border-gray-100"
                style="height: 82vh;">

                <div class="w-1/4 border-l border-gray-200 flex flex-col bg-white">
                    <div class="p-5 border-b bg-gray-50/50">
                        <h2 class="text-xl font-extrabold text-gray-800 tracking-tight">Conversations</h2>
                    </div>

                    <div class="overflow-y-auto flex-grow custom-scrollbar">
                        <div class="px-4 pt-4 pb-2">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Channels</span>
                        </div>
                        <button onclick="loadChat(0, 'Public Group')"
                            class="w-full flex items-center px-4 py-4 hover:bg-blue-50 transition-all duration-200 border-r-4 border-transparent focus:border-blue-600 focus:bg-blue-50 group">
                            <div
                                class="w-12 h-12 mr-2 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white shadow-lg group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                            </div>
                            <div class="mr-3 text-right">
                                <p class="text-sm font-bold text-gray-800">Public Group</p>
                                <p class="text-xs text-blue-500 font-medium">All Employees</p>
                            </div>
                        </button>

                        <div class="px-4 pt-6 pb-2">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Direct
                                Messages</span>
                        </div>
                        @foreach ($users as $user)
                            <button onclick="loadChat({{ $user->id }}, '{{ $user->name }}')"
                                class="w-full flex items-center px-4 py-3 hover:bg-gray-50 transition-all duration-200 border-r-4 border-transparent focus:border-blue-600 focus:bg-gray-100 group">
                                <div class="relative">
                                    <div
                                        class="w-11 h-11 rounded-xl bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-lg border border-gray-100 shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span
                                        class="absolute -bottom-1 -left-1 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
                                </div>
                                <div class="mr-3 text-right">
                                    <p
                                        class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition-colors">
                                        {{ $user->name }}</p>
                                    <p class="text-[11px] text-gray-400">Online</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="w-3/4 flex flex-col bg-slate-50 relative">
                    <div id="chat-header-container"
                        class="p-4 border-b flex items-center bg-white/80 backdrop-blur-md shadow-sm h-20 z-10">
                        <div id="chat-header" class="flex items-center gap-3 font-bold text-gray-800 text-lg">
                            <span class="text-gray-400 font-normal italic">Select a conversation to start
                                messaging...</span>
                        </div>
                    </div>

                    <div id="messages-container" class="flex-grow p-6 overflow-y-auto space-y-6"
                        style=" background-blend-mode: soft-light; background-attachment: fixed;">
                        <div class="flex flex-col items-center justify-center h-full opacity-20">
                            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p class="text-xl font-bold">Secure Messaging</p>
                        </div>
                    </div>

                    <div id="input-area" class="hidden p-5 border-t bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center gap-4 max-w-4xl mx-auto">
                            <div class="relative flex-grow">
                                <input type="text" id="message-input"
                                    onkeypress="if(event.key === 'Enter') sendMessage()"
                                    class="w-full border-none bg-gray-100 rounded-2xl px-6 py-3.5 focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm shadow-sm"
                                    placeholder="Write your message here...">
                            </div>
                            <button onclick="sendMessage()"
                                class="bg-blue-600 text-white p-3.5 rounded-2xl hover:bg-blue-700 hover:shadow-lg active:scale-95 transition-all flex items-center justify-center">
                                <svg class="w-5 h-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>

    <script>
        let currentReceiverId = null;

        window.onload = function() {
            // الاستماع للرسائل الخاصة
            window.Echo.private(`chat.{{ auth()->id() }}`)
                .listen('MessageSent', (e) => {
                    if (currentReceiverId == e.message.sender_id) {
                        appendMessage(e.message.message, 'received', e.user_name);
                    }
                });

            // الاستماع للمجموعة العامة
            window.Echo.private('group-chat')
                .listen('MessageSent', (e) => {
                    // إذا كانت الرسالة جماعية (receiver_id هو null) وأنا حالياً فاتح "المجموعة العامة"
                    if (currentReceiverId === 0 && e.message.receiver_id === null) {
                        // لا تكرر الرسالة إذا كنت أنا المرسل
                        if (e.message.sender_id != {{ auth()->id() }}) {
                            appendMessage(e.message.message, 'received', e.user_name);
                        }
                    }
                });
        };

        function loadChat(id, name) {
            currentReceiverId = id;
            document.getElementById('input-area').classList.remove('hidden');

            // تحديث رأس الدردشة بشكل أفضل
            const headerHtml = `
                <div class="w-10 h-10 rounded-xl ${id === 0 ? 'bg-blue-600' : 'bg-gray-400'} flex items-center justify-center text-white font-bold mr-3 shadow-sm">
                    ${id === 0 ? 'G' : name[0]}
                </div>
                <div>
                    <h3 class="leading-none text-gray-800">${name}</h3>
                    <p class="text-[11px] text-green-500 mt-1 font-medium">Online</p>
                </div>
            `;
            document.getElementById('chat-header').innerHTML = headerHtml;

            axios.get(`/messages/${id}`).then(res => {
                let container = document.getElementById('messages-container');
                container.innerHTML = '';
                res.data.forEach(msg => {
                    appendMessage(msg.message, msg.sender_id == {{ auth()->id() }} ? 'sent' : 'received',
                        msg.sender ? msg.sender.name : '');
                });
            });
        }

        function sendMessage() {
            let input = document.getElementById('message-input');
            let message = input.value.trim();

            // التأكد من وجود نص ومن اختيار محادثة (سواء مجموعة 0 أو موظف)
            if (!message || currentReceiverId === null) return;

            // تحديد الـ ID: إذا كان 0 (مجموعة) نرسل null، وإذا كان رقم نرسله كما هو
            let receiver = (currentReceiverId === 0) ? null : currentReceiverId;

            axios.post('/send-message', {
                receiver_id: receiver,
                message: message
            }).then(res => {
                appendMessage(message, 'sent');
                input.value = '';
            }).catch(err => {
                console.error("Error sending message:", err.response);
                alert("خطأ في الإرسال، تأكد من تعديل قاعدة البيانات لقبول null");
            });
        }

        function appendMessage(text, type, senderName = '') {
            let container = document.getElementById('messages-container');
            let isSent = type === 'sent';
            let time = new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            let html = `
                <div class="flex w-full ${isSent ? 'justify-start flex-row-reverse' : 'justify-start animate-fade-in'}">
                    <div class="relative max-w-[75%] px-4 py-2.5 rounded-2xl shadow-sm border ${
                        isSent 
                        ? 'bg-blue-600 text-white border-blue-500 rounded-br-none ml-2' 
                        : 'bg-white text-gray-800 border-gray-100 rounded-bl-none mr-2'
                    }">
                        ${(!isSent && currentReceiverId === 0) ? `<p class="text-[10px] font-black text-blue-600 uppercase mb-1">${senderName}</p>` : ''}
                        <p class="text-[14px] leading-relaxed">${text}</p>
                        <p class="text-[9px] mt-1 ${isSent ? 'text-blue-200 text-left' : 'text-gray-400 text-right'}">${time}</p>
                    </div>
                </div>`;

            container.insertAdjacentHTML('beforeend', html);
            container.scrollTop = container.scrollHeight;
        }
    </script>
</x-app-layout>
