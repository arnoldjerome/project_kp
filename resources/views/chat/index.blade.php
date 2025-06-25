<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3//assets/css/all.min.css"
        rel="stylesheet">
    <link href="/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <title>Furni Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co </title>
    <style>
        #chatMessages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f7f7f7;
        }

        .chat-bubble {
            max-width: 75%;
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .chat-left {
            background-color: #e4e6eb;
            color: #000;
            text-align: left;
            border-bottom-left-radius: 0;
        }

        .chat-right {
            background-color: #0d6efd;
            color: #fff;
            text-align: right;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }
    </style>

</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarsFurni">
                @auth
                    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/productint') }}">Indoor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/productext') }}">Outdoor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/chat') }}">Chat</a>
                        </li>
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/customrequests') }}">Custom Request</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/report') }}">Report</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/invoice') }}">Invoice</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <span class="nav-link disabled" style="cursor: default; color: #ffffff; font-weight: 500;">
                                <b>Welcome, {{ Auth::user()->name }}</b>
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                @endauth
                @guest
                    <ul>
                        <li>
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        </li>
                @endguest
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->

    <div class="d-flex h-100">

        <!-- Sidebar with list of chats -->
        <div style="width: 300px; border-right: 1px solid #ddd;">
            <input id="chatSearch" class="form-control m-2" placeholder="Search or start a new chat"
                oninput="filterChats()" />
            <ul class="list-group" id="chatList" style="height: calc(100vh - 60px); overflow-y: auto;"></ul>
        </div>

        <!-- Main chat area -->
        <div class="flex-fill d-flex flex-column">
            <div id="chatMessages"></div>
            <div class="p-3 border-top d-flex align-items-center gap-2">
                <button class="btn btn-outline-primary btn-sm"
                    onclick="sendTemplateMessage('Apakah ada yang bisa kami bantu?')">Template 1</button>
                <button class="btn btn-outline-secondary btn-sm" onclick="openCustomRequestModal()">Custom
                    Request</button>
                <button class="btn btn-outline-danger btn-sm"
                    onclick="sendTemplateMessage('Baik, apabila sudah selesai, maka kami izin mengakhiri sesi kali ini. Apabila ada kendala silahkan langsung hubungi kami kembali.')">Template
                    3</button>
                <input id="messageInput" type="text" class="form-control" placeholder="Type a message" />
                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
            </div>
        </div>

    </div>

    <!-- Modal for Custom Request -->
    <div class="modal fade" id="customRequestModal" tabindex="-1" aria-labelledby="customRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="customRequestList">
                    <!-- Load your custom requests here -->
                    <p>Daftar Custom Request placeholder (load via API)</p>
                </div>
            </div>
        </div>
    </div>



    <script src="/assets/js/bootstrap.bundle.min./assets/js"></script>
    <script src="/assets/js/tiny-slider./assets/js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let allChats = [];
        let currentChatId = null;

        async function loadChats() {
            try {
                const res = await fetch('/api/admin/chats');
                const chats = await res.json();
                allChats = chats;
                renderChatList(chats);
            } catch (err) {
                console.error('Failed to load chats', err);
            }
        }

        function renderChatList(chats) {
            console.log("CHAT LIST LOADED:", chats); // 👈 Tambahkan log ini
            const chatList = document.getElementById('chatList');
            chatList.innerHTML = '';
            chats.forEach(chat => {
                console.log("Rendering chat:", chat); // 👈 Tambahkan log ini
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.style.cursor = 'pointer';
                li.innerHTML = `
          <div>
            <strong>${chat.user_name}</strong><br/>
            <small class="text-truncate" style="max-width: 180px;">${chat.latest_message}</small>
          </div>
          <small>${chat.last_timestamp}</small>
        `;
                li.onclick = () => selectChat(chat.chat_id, li);
                chatList.appendChild(li);
            });
        }



        // Search filter
        function filterChats() {
            const val = document.getElementById('chatSearch').value.toLowerCase();
            renderChatList(allChats.filter(c => c.user_name.toLowerCase().includes(val)));
        }

        async function selectChat(chatId, selectedLi) {
            currentChatId = chatId;
            document.querySelectorAll('#chatList li').forEach(li => li.classList.remove('active'));
            if (selectedLi) selectedLi.classList.add('active');

            try {
                const res = await fetch(`/api/admin/chats/${chatId}`);
                const messages = await res.json();
                console.log("MESSAGES:", messages);
                renderMessages(messages);
            } catch (err) {
                console.error('Failed to load messages', err);
            }
        }


        function renderMessages(messages) {
            const container = document.getElementById('chatMessages');
            container.innerHTML = '';
            messages.forEach(msg => {
                const wrapper = document.createElement('div');
                const bubble = document.createElement('div');

                wrapper.className = 'd-flex';
                if (msg.sender === 'admin') {
                    wrapper.classList.add('justify-content-end');
                    bubble.className = 'chat-bubble chat-right';
                } else {
                    wrapper.classList.add('justify-content-start');
                    bubble.className = 'chat-bubble chat-left';
                }

                bubble.innerText = msg.message;
                wrapper.appendChild(bubble);
                container.appendChild(wrapper);
            });

            container.scrollTop = container.scrollHeight;
        }


        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text || !currentChatId) return alert('Pilih chat dan isi pesan terlebih dahulu');
            try {
                const res = await fetch(`/api/admin/chats/${currentChatId}/messages`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ sender: 'admin', message: text })
                });
                if (res.ok) {
                    input.value = '';
                    selectChat(currentChatId); // reload messages
                    loadChats(); // reload sidebar for preview update
                } else {
                    alert('Gagal mengirim pesan');
                }
            } catch (err) {
                alert('Error dalam pengiriman pesan');
            }
        }

        function sendTemplateMessage(text) {
            document.getElementById('messageInput').value = text;
            sendMessage();
        }

        // Placeholder modal open
        function openCustomRequestModal() {
            const modalEl = document.getElementById('customRequestModal');
            const modalInstance = new bootstrap.Modal(modalEl);
            modalInstance.show();
        }

        // Load chats on page load
        document.addEventListener('DOMContentLoaded', function () {
            console.log("DOM loaded, loading chats...");
            loadChats();
        });



    </script>
</body>

</html>