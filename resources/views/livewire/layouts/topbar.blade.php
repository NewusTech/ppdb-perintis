<header id="page-topbar" class="shadow-lg">
    <div class="navbar-header">
        <div class="d-flex h-100">
            <div class="navbar-brand-box">
                <a href="{{ url('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('/assets/images/logo.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/assets/images/logo-full.svg') }}" alt="" height="50"
                            style="margin-left: -0.4rem; margin-top: -0.4rem">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="align-middle ri-menu-2-line mx-3"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="ml-1 dropdown d-none d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="px-lg-2">
                        <div class="row no-gutters">
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{ url('https://www.smaperintis2.sch.id/') }}">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt="Github">
                                    <span>Website Utama</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{ url('/') }}">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt="bitbucket">
                                    <span>PPDB</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ml-1 dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown flex user-dropdown">
                <button type="button" class="btn header-item waves-effect d-flex align-items-center"
                    id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ auth()->user()->profile_photo_url }}"
                        alt="{{ auth()->user()->name }}">
                    <div class="ml-2 d-none d-lg-flex flex-column text-left">
                        <span> {{ auth()->user()->name }}</span>
                        <span class="mt-n1" style="font-size: 0.7rem">
                            {{ auth()->user()->roles->first()->name }}</span>
                    </div>
                    <i class="mdi mdi-chevron-down d-none d-lg-inline-block ml-2"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url('profile') }}">
                        <i class="mr-1 align-middle ri-user-line"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mr-1 align-middle ri-logout-box-r-line text-danger"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
