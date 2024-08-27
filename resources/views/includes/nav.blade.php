<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <div class="app-menu">

    </div>

    <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
            <!-- User Account-->
            <li class="dropdown user user-menu">
                <a href="#" class="waves-effect waves-light dropdown-toggle"
                    data-bs-toggle="dropdown" title="User">
                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated flipInX">
                    <li class="user-body">
                        <div class="dropdown-item"><i class="ti-user text-muted me-2"></i>{{Auth::user()->name}}</div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="ti-user text-muted me-2"></i>
                            Profile</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti-lock text-muted me-2"></i> Logout
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
