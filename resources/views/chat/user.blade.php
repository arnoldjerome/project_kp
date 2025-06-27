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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
            display: inline-block;
            word-wrap: break-word;
        }

        .chat-left {
            background-color: #e4e6eb;
            color: #000;
            text-align: left;
            align-self: flex-start;
            border-bottom-left-radius: 0;
            margin-right: auto;
        }

        .chat-right {
            background-color: #0d6efd;
            color: #fff;
            text-align: right;
            align-self: flex-end;
            border-bottom-right-radius: 0;
            margin-left: auto;
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

    <div class="container py-5">
        <h4 class="mb-3">Chat dengan Admin</h4>
        <div class="border rounded p-3" id="chatMessages"
            style="height: 550px; overflow-y: auto; display: flex; flex-direction: column;">
        </div>


        <div class="input-group mt-3">
            <input id="messageInput" type="text" class="form-control" placeholder="Tulis pesan..." />
            <button class="btn btn-primary" onclick="sendMessage()">Kirim</button>
        </div>
    </div>

    <div class="modal fade" id="customRequestModal" tabindex="-1" aria-labelledby="customRequestLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="customRequestForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customRequestLabel">Buat Custom Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="requestTitle" class="form-label">Judul Request</label>
                        <input type="text" class="form-control" id="requestTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="requestImage" class="form-label">Upload Gambar Sketsa</label>
                        <input type="file" class="form-control" id="requestImage" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="requestDescription" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="requestDescription" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kirim Request</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentChatId = null;

        async function loadOrCreateChat() {
            const userId = {{ Auth::id() }};
            const res = await fetch('/api/admin/chats'); // mengambil semua
            const chats = await res.json();
            console.log('List chat dari API:', chats);
            const existing = chats.find(c => c.user_id == userId);

            if (existing) {
                console.log('✅ Chat ditemukan:', existing);
                currentChatId = existing.chat_id;
                loadMessages();
            } else {
                console.log('❌ Chat tidak ditemukan, membuat baru...');
                const create = await fetch('/api/admin/chats/start', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: userId })
                });

                const newChat = await create.json();
                currentChatId = newChat.id;
            }
        }

        async function loadMessages() {
            const res = await fetch(`/api/admin/chats/${currentChatId}`);
            const messages = await res.json();
            const container = document.getElementById('chatMessages');
            container.innerHTML = '';

            messages.forEach(msg => {
                const div = document.createElement('div');
                div.className = 'chat-bubble ' + (msg.sender === 'user' ? 'chat-right' : 'chat-left');

                if (msg.message === '[custom_request_button]') {
                    div.innerHTML = `<button class="btn btn-warning btn-sm" onclick="openCustomRequestModal()">Buat Custom Request</button>`;
                } else {
                    div.innerText = msg.message;
                }

                container.appendChild(div);
            });


            container.scrollTop = container.scrollHeight;
        }



        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text || !currentChatId) return;
            const res = await fetch(`/api/user/chats/${currentChatId}/messages`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: text })
            });

            if (res.ok) {
                input.value = '';
                loadMessages();
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadOrCreateChat();
            await loadMessages();
            setInterval(loadMessages, 3000); // polling tiap 3 detik
        });

        function openCustomRequestModal() {
            const modal = new bootstrap.Modal(document.getElementById('customRequestModal'));
            modal.show();
        }

        document.getElementById('customRequestForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const title = document.getElementById('requestTitle').value.trim();
            const description = document.getElementById('requestDescription').value.trim();
            const imageFile = document.getElementById('requestImage').files[0];

            if (!title || !description || !imageFile || !currentChatId) return;

            const formData = new FormData();
            formData.append('chat_id', currentChatId);
            formData.append('title', title);
            formData.append('description', description);
            formData.append('image', imageFile);
            formData.append('user_id', {{ Auth::id() }});

            const res = await fetch(`/api/admin/custom-request`, {
                method: 'POST',
                body: formData
            });

            if (res.ok) {
                bootstrap.Modal.getInstance(document.getElementById('customRequestModal')).hide();
                document.getElementById('customRequestForm').reset();
                alert('Request berhasil dikirim!');
            } else {
                alert('Gagal mengirim request.');
            }
        });


    </script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>