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
                                <a class="nav-link" href="{{ route('report.index') }}">Report</a>
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
            const chatList = document.getElementById('chatList');
            chatList.innerHTML = '';
            chats.forEach(chat => {
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
            // Remove 'active' from previous
            document.querySelectorAll('#chatList li').forEach(li => li.classList.remove('active'));
            if (selectedLi) selectedLi.classList.add('active');

            try {
                const res = await fetch(`/api/admin/chats/${chatId}`);
                const messages = await res.json();
                renderMessages(messages);
            } catch (err) {
                console.error('Failed to load messages', err);
            }
        }

        function renderMessages(messages) {
            const container = document.getElementById('chatMessages');
            container.innerHTML = '';
            messages.forEach(msg => {
                const div = document.createElement('div');
                div.style.marginBottom = '10px';
                if (msg.sender === 'admin') {
                    div.style.textAlign = 'right';
                    div.innerHTML = `<span class="msg-admin">${msg.message}</span>`;
                } else {
                    div.style.textAlign = 'left';
                    div.innerHTML = `<span class="msg-user">${msg.message}</span>`;
                }
                container.appendChild(div);
            });
            container.scrollTop = container.scrollHeight; // scroll to bottom
        }

        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text || !currentChatId) return alert('Pilih chat dan isi pesan terlebih dahulu');
            try {
                const res = await fetch(`/api/admin/chats/${currentChatId}/send`, {
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
        window.onload = loadChats;

    </script>




    <!-- Start Footer Section -->
    < footer class="footer-section">
        <div class="container relative">

            <div class="sofa-img">
                <img src="/assets/images/sofa.png" alt="Image" class="img-fluid">
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img
                                    src="/assets/images/envelope-outline.svg" alt="Image"
                                    class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
                    <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus
                        malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
                        Pellentesque habitant</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                        <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Chat</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Knowledge base</a></li>
                                <li><a href="#">Live chat</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Jobs</a></li>
                                <li><a href="#">Our team</a></li>
                                <li><a href="#">Leadership</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>

                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Nordic Chair</a></li>
                                <li><a href="#">Kruzo Aero</a></li>
                                <li><a href="#">Ergonomic Chair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script>
                            . All Rights Reserved. &mdash; Designed with love by <a
                                href="https://untree.co">Untree.co</a> Distributed By <a
                                hreff="https://themewagon.com">ThemeWagon</a>
                            <!-- License information: https://untree.co/license/ -->
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
        </footer>
        <!-- End Footer Section -->


        <script src="/assets/js/bootstrap.bundle.min./assets/js"></script>
        <script src="/assets/js/tiny-slider./assets/js"></script>
        <script src="/assets/js/custom.js"></script>
</body>

</html>