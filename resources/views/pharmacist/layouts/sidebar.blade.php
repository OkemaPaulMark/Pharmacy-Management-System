<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Pharmacy M.S</div>
</a>

  
  <!-- Dashboard -->
  <li class="nav-item">
  <a class="nav-link" href="{{url('pharmacist/dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

    <!-- Sales -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('posterminal.index') }}">
    <i class="fas fa-shopping-cart"></i>
      <span>POS Terminal</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="{{ route('patients.index') }}">
    <i class="fas fa-user-plus"></i>
      <span>Add New Patient</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('medicalhistories.index') }}">
    <i class="fas fa-file-medical"></i>
      <span>Medical History</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{url('saleshistory')}}">
    <i class="fas fa-history"></i>
      <span>Sales History</span>
    </a>
  </li>

  <!-- Patients -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('patients.index') }}" data-toggle="collapse" data-target="#collapsePatients">
    <i class="fas fa-user-plus mr-2"></i>
      <span>Add New Patient</span>
    </a>
    <div id="collapsePatients" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Patient Management</h6>
        <a class="collapse-item" href="{{ route('patients.index') }}">
          <i class="fas fa-user-plus mr-2"></i>Add New Patient
        </a>
        <a class="collapse-item" href="{{ route('medicalhistories.index') }}">
          <i class="fas fa-file-medical mr-2"></i>Medical History
        </a>
      </div>
    </div>
  </li> -->
</ul>



