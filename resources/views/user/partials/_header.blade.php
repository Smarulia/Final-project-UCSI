<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Website</title>
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
</head>
<style>
    .navbar-nav .nav-item .nav-link.active::after {
        content: "";
        display: block;
        width: 100%;
        height: 2px;
        background-color: red;
        /* Sesuaikan dengan warna garis bawah yang diinginkan */
    }

</style>

<body>
    <nav class="navbar navbar-expand-lg bg-light mb-5">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{asset('gambar/logoucsi.png')}}" alt="Logo" class="navbar-logo">
            </a>

            <!-- Tombol Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Konten Navbar -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <!-- Menu -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-page="Room" href="{{ route("user.dashboard") }}">Book Discussion Room</a>
                    </li>
                    @if (Auth::user()->role != "culture")
                    <li class="nav-item">
                        <a class="nav-link" data-page="PAL" href="{{route ( "user.pal") }}">Book P.A.L</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" data-page="History" href="{{ route("user.history") }}">History</a>
                    </li>

                    
                </ul>
            </div>

            <!-- nama yang login -->
            <ol class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                    <a class="dropdown-item" href="{{ route("logout") }}">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>

                <a class="dropdown-item" href="{{ route("user.change.password") }}">
                        <i class="fas fa-key mr-2 text-gray-400"></i>
                        Reset Password
                    </a>
                </div>
            </ol>
        </div>
    </nav>

    <div class="container">
        <!-- Konten halaman lainnya -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                var activeLink = $('.navbar-nav .nav-link.active');
                var activeLine = $('<div class="active-line"></div>');
                activeLink.append(activeLine);

                function moveActiveLine(link) {
                    var linkWidth = link.outerWidth();
                    var linkLeft = link.position().left;

                    activeLine.css('width', linkWidth + 'px');
                    activeLine.css('left', linkLeft + 'px');
                }

                $('.navbar-nav .nav-link').on('click', function (e) {
                    e.preventDefault();
                    var clickedLink = $(this);
                    var targetPage = clickedLink.data('page');

                    if (!clickedLink.hasClass('active')) {
                        $('.navbar-nav .nav-link').removeClass('active');
                        clickedLink.addClass('active');
                        moveActiveLine(clickedLink);

                        // Pindah ke halaman baru setelah 500ms
                        setTimeout(function () {
                            window.location.href = clickedLink.attr('href');
                        }, 500);
                    }
                });

                $(window).on('load', function () {
                    var currentPage = window.location.pathname;
                    var targetLink = $('.navbar-nav .nav-link[data-page="' + currentPage.substring(1) +
                        '"]');
                    $('.navbar-nav .nav-link').removeClass('active');
                    targetLink.addClass('active');
                    moveActiveLine(targetLink);
                });
            });

        </script>
</body>
