<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                            href="javascript:;">{{ $href ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $name ?? '' }}</li>
                </ol>
            </nav>

            <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4 justify-content-end" id="navbar">
                <h6 class="font-weight-bolder mb-0 d-xl-none justify-content-start">{{ $name ?? '' }}</h6>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">

                        <a href="javascript:;" class="nav-link text-body p-0 text-truncate" style="max-width: 200px;">
                            <span class="d-sm-inline  p-1" style="">
                                {{ Auth::user()->name }}
                                <i class="fa fa-cog p-1 fixed-plugin-button-nav"></i>
                            </span>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    {{-- </main> --}}
    <div class="fixed-plugin">
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Dashboard | FASKHP</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>

            <hr class="horizontal dark my-1">

            <div class="card-body pt-sm-3 pt-0">

                <div class="d-flex" id="navbarFixed">
                    <a href="{{ route('profile') }}" class="btn bg-gradient-primary w-38 px-3 mb-2 active">Profile <i
                            class="fa fa-user-circle" style="padding: 0.8px;"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2">Logout <i
                                class="fa fa-sign-out" style="padding: 0.8px;"></i></button>
                    </form>
                </div>

                <hr class="horizontal dark my-sm-4">

                <div class="w-100 text-center">
                    &copy; {{ date('Y') }} <strong>FORUM ALUMNI SMKK HUSADA PRATAMA</strong>. All Rights Reserved
                </div>
            </div>
        </div>
    </div>
