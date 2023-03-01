<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-light" style="float: left;">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('public/images/logo.png') }}" alt="" height="27">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('public/images/logo.png') }}" alt="" height="27">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ URL::asset('public/images/default-user.jpg') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                </button>
            </div>
        </div>
    </div>
</header>