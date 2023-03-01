<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" style="margin-left: 30px;">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <b>
                    <img src="{{URL::asset('public/images/logo.svg')}}" style="width: 75px; height: 100%;" class="light-logo" />
                </b>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::user()->image)
                            <!--<img src="{{URL::to('/')}}/public/uploads/users/{{Auth::user()->id . '/' . Auth::user()->image}}" alt="user" class="">-->
                        @else
                            <!--<img src="{{URL::asset('public/images/no-image.png')}}" alt="user" class="">-->
                        @endif
                        <span class="hidden-md-down">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} &nbsp;<i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                        <a href="{{ route('admin.myprofile') }}" class="dropdown-item">
                            <i class="ti-user"></i> My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>