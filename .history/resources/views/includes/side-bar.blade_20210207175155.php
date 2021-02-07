  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
          <div class="sidebar-brand-icon">
              <i class="fas fa-user-tie"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Djur</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="{{route('dashboard', Auth::user()->id)}}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
          </a>
      </li>

      <div class="sidebar-heading">
          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          Gestion
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{url('/consultations')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Consultaions</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{url('patients')}}">
              <i class="fas fa-fw fa-plus"></i>
              <span>Patients</span>
          </a>

      </li>




      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{url('proprietaires')}}">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Proprietaires</span>
          </a>
      </li>

      <!-- Divider -->

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
  <!-- End of Sidebar -->