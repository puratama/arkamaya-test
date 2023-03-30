<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MRP <sup>Test</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ \Request::segment(1) == null ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        DATA
    </div>

    <li class="nav-item {{ \Request::segment(1) == 'clients' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/clients') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Client</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ \Request::segment(1) == 'projects' || \Request::segment(1) == 'project' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-briefcase"></i>
            <span>Projects</span>
        </a>
        <div id="collapseTwo" class="collapse {{ \Request::segment(1) == 'projects' || \Request::segment(1) == 'project' ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ \Request::segment(1) == 'projects' && \Request::segment(2) == null || \Request::segment(1) == 'project' ? 'active' : '' }}" href="{{ url('/projects') }}">Regular</a>
                <a class="collapse-item {{ \Request::segment(1) == 'projects' && \Request::segment(2) == 'api' ? 'active' : '' }}" href="{{ url('/projects/api') }}">Using jQuery</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>