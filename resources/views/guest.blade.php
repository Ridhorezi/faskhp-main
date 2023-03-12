<!--Header-->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="author" content="Ridho Suhaebi Arrowi" />

    <meta name="google-site-verification" content="" />

    <meta property="og:type" content="website">

    <meta property="og:title" content="Forum Alumni SMK KESEHATAN HUSADA PRATAMA">

    <meta property="og:description" content="Forum Alumni SMK KESEHATAN HUSADA PRATAMA">

    <meta property="og:url" content="https://forumalumnismkkkhp.org">

    <meta property="og:site_name" content="Forum Alumni SMK KESEHATAN HUSADA PRATAMA">

    <link rel="canonical" href="https://forumalumnismkkkhp.org">

    <link rel="shortlink" href="https://forumalumnismkkkhp.org">

    <link rel="shortcut icon" href="{{ asset('assets/guest/img') }}/favicon.png" rel="favicon" />

    <meta name="description" content="Forum Alumni SMK KESEHATAN HUSADA PRATAMA" />

    <meta name="keywords"
        content="Forum Alumni SMK KESEHATAN HUSADA PRATAMA, forum alumni smk kesehatan husada pratama, smk kesehatan husada pratama, forum alumni husada, alumni husada pratama, husada pratama" />

    <meta name="robot" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

    <meta name="copyright" content="Copyright © 2023 Forum Alumni SMKK HUSADA PRATAMA" />

    <meta name="language" content="indonesia" />

    <title>Forum Alumni SMKK HUSADA PRATAMA | Selamat Datang Di Forum Alumni SMK KESEHATAN HUSADA PRATAMA</title>

    @livewireStyles
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800&display=swap"
        rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Public Sans&display=swap' rel='stylesheet'>

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('mix_guest/guest.css') }}">
    <link href="{{ asset('assets/guest/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/guest/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    @stack('styles')
</head>
<!--End Header-->

{{-- oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;" --}}

<body>
    <header wire:ignore id="header" class="d-flex align-items-center">
        <div class="container-fluid container-xxl d-flex align-items-center">

            <div id="logo" class="me-auto">
                <a href=""><img src="{{ asset('assets/gallery') }}/logo-husada.png" alt="logo"></a>
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">
                @if (!Auth::check())
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link scrollto" href="#venue">Information</a></li>
                        <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('home') }}"
                                class="nav-link {{ str_starts_with('home', Route::currentRouteName()) === true ? 'active' : '' }}">Home</a>
                        </li>
                        <li><a href="{{ route('user.kerja') }}"
                                class="nav-link {{ str_contains('user.kerja', Route::currentRouteName()) === true ? 'active' : '' }}">Kerja</a>
                        </li>
                        <li><a href="{{ route('user.kuliah') }}"
                                class="nav-link {{ str_starts_with('user.kuliah', Route::currentRouteName()) === true ? 'active' : '' }}">Kuliah</a>
                        </li>
                        <li><a href="{{ route('user.kerjakuliah') }}"
                                class="nav-link {{ preg_match('[user.kerjakuliah]', Route::currentRouteName()) === 1 ? 'active' : '' }}">Kerja
                                Kuliah</a></li>
                        <li><a href="{{ route('user.mencarikerja') }}"
                                class="nav-link {{ str_starts_with('user.mencarikerja', Route::currentRouteName()) === true ? 'active' : '' }}">Mencari
                                Kerja</a></li>
                        <li><a href="{{ route('user.usaha') }}"
                                class="nav-link {{ str_starts_with('user.usaha', Route::currentRouteName()) === true ? 'active' : '' }}">Membuka
                                Usaha</a></li>
                        <li><a href="{{ route('user.loker') }}"
                                class="nav-link {{ str_starts_with('loker', Route::currentRouteName()) === true ? 'active' : '' }}">Lowongan
                                Kerja</a>
                        </li>
                    </ul>
                @endif
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
            @auth
                <div class="dropdown">
                    <button class="buy-tickets dropdown-toggle" type="button" id="profileDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li>
                            <h6 class="dropdown-header">Manage Profiles</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile') }}">{{ Auth::user()->name }}</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                        @if (Auth::user()->hasPermissionTo('participate'))
                            <li>
                                <hr class="dropdown-divider">
                                <h6 class="dropdown-header">Participate</h6>
                            </li>
                            @if (empty(App\Models\Request::where('user_id', Auth::user()->id)->where('table_type', 'Kerja')->where('status', 'accepted')->first()
                                ))
                                <li><a class="dropdown-item" href="{{ route('user.add.kerja') }}">Kerja</a></li>
                            @endif
                            @if (empty(App\Models\Request::where('user_id', Auth::user()->id)->where('table_type', 'Kuliah')->where('status', 'accepted')->first()
                                ))
                                <li><a class="dropdown-item" href="{{ route('user.add.kuliah') }}">Kuliah</a></li>
                            @endif
                            @if (empty(App\Models\Request::where('user_id', Auth::user()->id)->where('table_type', 'KerjaKuliah')->where('status', 'accepted')->first()
                                ))
                                <li><a class="dropdown-item" href="{{ route('user.add.kerjakuliah') }}">Kerja &
                                        Kuliah</a>
                                </li>
                            @endif
                            @if (empty(App\Models\Request::where('user_id', Auth::user()->id)->where('table_type', 'MencariKerja')->where('status', 'accepted')->first()
                                ))
                                <li><a class="dropdown-item" href="{{ route('user.add.mencarikerja') }}">Mencari
                                        Kerja</a>
                                </li>
                            @endif
                            @if (empty(App\Models\Request::where('user_id', Auth::user()->id)->where('table_type', 'Usaha')->where('status', 'accepted')->first()
                                ))
                                <li><a class="dropdown-item" href="{{ route('user.add.usaha') }}">Membuka Usaha</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <hr class="dropdown-divider">
                                <h6 class="dropdown-header">Request On Going</h6>
                            </li>
                            <li><a href="{{ route('user.request') }}" class="dropdown-item">Your Request</a></li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                            <h6 class="dropdown-header">Kas</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('user.payment') }}">Payment Method</a></li>

                        <li>
                            <hr class="dropdown-divider">
                            <h6 class="dropdown-header">Meet Alumni</h6>
                        </li>
                        {{-- <li><a class="dropdown-item" href="{{ route('chatify') }}">Chatting</a></li> --}}
                        <li><a class="dropdown-item" href="https://t.me/+9SES_3WSmnU1OTRl">Chatting</a></li>

                    </ul>
                </div>
            @else
                <a class="buy-tickets" href="{{ route('register') }}">Sign Up</a>
                <a class="buy-tickets" href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </header>
    <!-- End Header -->
    {{ $slot }}
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; {{ date('Y') }} <strong>Forum Alumni SMK KESEHATAN HUSADA PRATAMA.</strong> All Rights
                Reserved. <br>
                {{-- <strong>Donate for Creator</strong> <a href="https://saweria.co/ridhosuhaebi"><i
                        class="fas fa-donate"></i> Ridho Suhaebi Arrowi</a> --}}
            </div>
        </div>
    </footer>
    <!-- End  Footer -->

    <a href="#hero" class="back-to-top scrollto d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @livewireScripts

    <!-- Vendor JS Files -->
    <script src="{{ asset('mix_guest/guest.js') }}"></script>
    <script src="{{ asset('assets/guest/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        Livewire.on('showAlert', (type, message) => {
            toastr[type](message);
        });
    </script>
</body>

</html>
