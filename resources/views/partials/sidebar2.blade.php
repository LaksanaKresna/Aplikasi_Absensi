<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ setActiveMenu(['dashboard'],'active') }}">
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @can('isAdmin')
        <li class="nav-item {{ setActiveMenu(['jobtitle', 'maritalstatus', 'status'],'active') }}">
            <a class="nav-link" data-toggle="collapse" href="#administrative_menu" aria-expanded="false" aria-controls="administrative_menu">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Administrative</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setActiveMenu(['jobtitle', 'maritalstatus', 'status'],'show') }}" id="administrative_menu">
                <ul class="nav flex-column sub-menu">
               
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['jobtitle'],'active') }}"  href="{{ route('jobtitle.index') }}">Job Title</a></li>
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['maritalstatus'],'active') }}"  href="{{ route('maritalstatus.index') }}">Marital Status</a></li>
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['status'],'active') }}"  href="{{ route('status.index') }}">General Status</a></li>
                </ul>
            </div>
        </li>
        @endcan
        <li class="nav-item {{ setActiveMenu(['employee'],'active') }}">
            <a class="nav-link" data-toggle="collapse" href="#employee_menu" aria-expanded="false" aria-controls="employee_menu">
                <i class="icon-paper-clip menu-icon"></i>
                <span class="menu-title">Employees</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setActiveMenu(['employee'],'show') }}" id="employee_menu">
                <ul class="nav flex-column sub-menu">
                   
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['employee'],'active') }}" href="{{ route('employee.index') }}">Employees</a></li>
                </ul>
            </div>
        </li>
       
        <li class="nav-item {{ setActiveMenu(['attandance','attandancestatus'],'active') }}">
            <a class="nav-link" data-toggle="collapse" href="#att_menu" aria-expanded="false" aria-controls="att_menu">
                <i class="icon-clock menu-icon"></i>
                <span class="menu-title">Attandances</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setActiveMenu(['attandance','attandancestatus'],'show') }}" id="att_menu">
                <ul class="nav flex-column sub-menu">
                   @can('isAdmin')
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['attandancestatus'],'active') }}" href="{{ route('attandancestatus.index') }}">Status</a></li>
                    @endcan
                    <li class="nav-item"> <a class="nav-link {{ setActiveMenu(['attandance'],'active') }}"  href="{{ route('attandance.index') }}">Attandance</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/" target="_blank">
                <i class="icon-map menu-icon"></i>
                <span class="menu-title">Face Recognition</span>
            </a>
        </li>

        @can('isAdmin')
        <li class="nav-item {{ setActiveMenu(['user'],'active') }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>

        <li class="nav-item {{ setActiveMenu(['setting'],'active') }}">
            <a class="nav-link" href="{{ route('setting.edit',1) }}">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        @endcan
        
       
     
    </ul>
</nav>