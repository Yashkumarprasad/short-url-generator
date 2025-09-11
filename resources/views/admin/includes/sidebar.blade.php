@php
    $currenturl = Request::segment(2);
    $currentMethod = Request::segment(3);
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="mt-4"></li>
        <li class="nav-item @if (in_array($currenturl, ['dashboard', ''])) active @endif">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="fa fa-tachometer menu-icon" aria-hidden="true"></i>
            </a>
        </li>

        @if(Auth::guard('admin')->user()->user_type != MEMBER)
            <li class="nav-item @if (in_array($currenturl, ['user'])) active @endif">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" @if (in_array($currenturl, ['user']))
                aria-expanded="true" @else aria-expanded="false" @endif aria-controls="ui-user">
                    <span class="menu-title">User</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-users menu-icon"></i>
                </a>
                <div class="collapse @if (in_array($currenturl, ['user'])) show @endif" id="ui-user">
                    <ul class="nav flex-column sub-menu">

                        <li class="nav-item"> <a
                                class="nav-link @if (in_array($currenturl, ['user']) && $currentMethod == 'add') active @endif"
                                href="{{ route('admin.user.add') }}">Invite
                                {{ (Auth::guard('admin')->user()->user_type == SUPER_ADMIN) ? "Client" : "Team Member" }}</a>
                        </li>

                        <li class="nav-item"> <a
                                class="nav-link @if (in_array($currenturl, ['user']) && !in_array($currentMethod, ['add', 'edit'])) active @endif"
                                href="{{ route('admin.user.list') }}">Manage {{ (Auth::guard('admin')->user()->user_type == SUPER_ADMIN) ? "Clients" : "Team Members"}}</a></li>
                    </ul>
                </div>
            </li>
        @endif

        <li class="nav-item @if (in_array($currenturl, ['url'])) active @endif">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-url" @if (in_array($currenturl, ['url']))
            aria-expanded="true" @else aria-expanded="false" @endif aria-controls="ui-url">
                <span class="menu-title">URLs</span>
                <i class="menu-arrow"></i>
                <i class="fa fa-link menu-icon"></i>
            </a>
            <div class="collapse @if (in_array($currenturl, ['url'])) show @endif" id="ui-url">
                <ul class="nav flex-column sub-menu">

                    @if(Auth::guard('admin')->user()->user_type != SUPER_ADMIN)
                        <li class="nav-item"> <a
                                class="nav-link @if (in_array($currenturl, ['url']) && $currentMethod == 'add') active @endif"
                                href="{{ route('admin.url.add') }}">Add URL</a></li>
                    @endif

                    <li class="nav-item"> <a
                            class="nav-link @if (in_array($currenturl, ['url']) && !in_array($currentMethod, ['add', 'edit'])) active @endif"
                            href="{{ route('admin.url.list') }}">Manage URLs</a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>