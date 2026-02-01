<!-- resources/views/admin/dashboard.blade.php -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 bg-dark text-white min-vh-100">
            <div class="p-3">
                <h4>Menu Admin</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                     
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.medecins.index') }}">
                            <i class="fas fa-user-md"></i> Médecins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.demandes.index') }}">
                            <i class="fas fa-clipboard-list"></i> Demandes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.clients.index') }}">
                            <i class="fas fa-users"></i> Clients
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>