<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        @if(Auth::user()->role == 'admin')
            <li class="nav-item menu-open">
                <a href="{{ route('admins.index') }}" class="nav-link {{ (request()->is('admins*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Admin Portal
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            </li>
        
        @endif

        
        
    </ul>
</nav>