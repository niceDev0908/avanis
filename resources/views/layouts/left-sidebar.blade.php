<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect {{(Route::currentRouteName() == 'dashboard' ? 'mm-active' : '')}}">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('receivable-actions')}}" class="waves-effect {{(Route::currentRouteName() == 'receivable-actions' || Route::currentRouteName() == 'actions' || Route::currentRouteName() == 'action-files' || Route::currentRouteName() == 'view-requested-uploaded-documents' ? 'mm-active' : '')}}">
                        <i class="bx bx-folder-open"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('messages')}}" class="waves-effect {{(Route::currentRouteName() == 'messages' ? 'mm-active' : '')}}">
                        <i class="bx bx-chat"></i>
                        <span>Messages</span>
                    </a>
                </li>
                @if(Auth::user()->product_type == 'CFP')
                <li>
                    <a href="{{route('user-assets')}}" class="waves-effect {{(Route::currentRouteName() == 'user-assets' ? 'mm-active' : '')}}">
                        <i class="bx bx-table"></i>
                        <span>Assets</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('transfers')}}" class="waves-effect {{(Route::currentRouteName() == 'transfers' ? 'mm-active' : '')}}">
                        <i class="bx bx-pound"></i>
                        <span>Transfers</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->product_type == 'RSA')
                <li>
                    <a href="{{route('receivables')}}" class="waves-effect {{(Route::currentRouteName() == 'receivables' ? 'mm-active' : '')}}">
                        <i class="bx bx-pound"></i>
                        <span>
                            @if(Auth::user()->product_type == 'CFP')
                            CFP Transactions
                            @else
                            Receivables
                            @endif
                        </span>
                    </a>
                </li>
                @endif
<!--                <li>
                    @if(Auth::user()->product_type == 'CFP')
                    <a href="{{URL::asset('public/Fee_Schedule_CFP.pdf')}}" class="waves-effect" target="_blank">
                        <i class="fas fa-file-alt"></i>
                        <span>Fee Schedule</span>
                    </a>
                    @else
                    <a href="{{URL::asset('public/Fee_Schedule_RSA.pdf')}}" class="waves-effect" target="_blank">
                        <i class="fas fa-file-alt"></i>
                        <span>Fee Schedule</span>
                    </a>
                    @endif
                </li>-->
                <li>
                    <a href="{{route('pmc-management')}}" class="waves-effect {{(Route::currentRouteName() == 'pmc-management' ? 'mm-active' : '')}}">
                        <i class="bx bx-table"></i>
                        <span>PMC Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('manage-profile')}}" class="waves-effect {{(Route::currentRouteName() == 'manage-profile' ? 'mm-active' : '')}}">
                        <i class="bx bxs-user-detail"></i>
                        <span>Personal Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('change-password')}}" class="waves-effect {{(Route::currentRouteName() == 'change-password' ? 'mm-active' : '')}}">
                        <i class="bx bx-lock-open-alt"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}" class="waves-effect">
                        <i class="bx bx-power-off"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>