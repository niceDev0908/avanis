<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav" style="padding: 0px !important;">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}">
                        <i class="icon-speedometer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
                <li class="{!! (Request::is('admin/roles/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('roles.index')}}">
                        <i class="ti-lock"></i>
                        <span class="hide-menu">Roles & Permissions</span>
                    </a>
                </li>
                @endif
                <li class="{!! (Request::is('admin/users/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('admin.users')}}">
                        <i class="icon-people"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                <li class="{!! (Request::is('admin/receivables/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('admin.receivables')}}">
                        <i class="fas fa-pound-sign"></i>
                        <span class="hide-menu">Transactions</span>
                    </a>
                </li>
                <li class="{!! (Request::is('admin/annual-compliance/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('admin.annual-compliance')}}">
                        <i class="fas fa-file"></i>
                        <span class="hide-menu">Annual Compliance</span>
                    </a>
                </li>
                @if(Auth::user()->roles[0]->name == 'Super Admin' || Auth::user()->roles[0]->name == 'Admin')
<!--                <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0);">
                        <i class="ti-rss"></i>
                        <span class="hide-menu">Broadcast</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0);">
                        <i class="ti-id-badge"></i>
                        <span class="hide-menu">Due Diligence</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0);">
                        <i class="ti-money"></i>
                        <span class="hide-menu">Transactional</span>
                    </a>
                </li>-->
                <li class="{!! (Request::is('admin/reports/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('admin.reports')}}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="hide-menu">Reports</span>
                    </a>
                </li>
                <li class="{!! (Request::is('admin/settings/*')  ? 'active' : '' ) !!}">
                    <a class="waves-effect waves-dark" href="{{route('admin.settings')}}">
                        <i class="fas fa-cog"></i>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>