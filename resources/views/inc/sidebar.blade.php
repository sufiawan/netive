<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="/images/face.png" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->name }}</p>
                        <div>
                            <small class="designation text-muted">{{ Auth::user()->role->name }}</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>              
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role->name == 'Administrator')
        <li class="nav-item">
            <a class="nav-link" href="/user">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Master User</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-server-network"></i>
                <span class="menu-title">Network Devices</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/accesspoint">Access Point</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bandwidthmanagement">Bandwidth Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/firewall">Firewall</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gateway">Gateway</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/router">Router</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/server">Server</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/networkswitch">Switch</a>
                    </li>                    
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/virtuallan">
                <i class="menu-icon mdi mdi-file-tree"></i>
                <span class="menu-title">Virtual LAN</span>
            </a>
        </li>        
        <li class="nav-item">
            <a class="nav-link" href="/enddevice">
                <i class="menu-icon mdi mdi-laptop-windows"></i>
                <span class="menu-title">Endpoint Device</span>
            </a>
        </li>          
<!--        <li class="nav-item">
            <a class="nav-link" href="/switchportmap">
                <i class="menu-icon mdi mdi-lan"></i>
                <span class="menu-title">Switch Port Map</span>
            </a>
        </li>          -->
        <hr />
        <li class="nav-item">
            <a class="nav-link" href="/user/{{ Auth::user()->id }}">
                <i class="menu-icon mdi mdi-key"></i>
                <span class="menu-title">Change Password</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault();
                    bootbox.confirm('Are you sure want to log out?', function (result) {
                        if (result) {
                            document.getElementById('logout-form').submit();
                        }
                    })">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </li>          
    </ul>
</nav>