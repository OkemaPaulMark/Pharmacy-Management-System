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
  <a class="nav-link" href="{{url('dashboard')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

 <!-- Medicines -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#collapseMedicines" data-toggle="collapse" data-target="#collapseMedicines">
      <i class="fas fa-pills"></i>
      <span>Medicines</span>
    </a>
    <div id="collapseMedicines" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Medicine Operations</h6>
        <!-- <a class="collapse-item" href="/medicines/list">
          <i class="fas fa-list mr-2"></i>Medicine List
        </a> -->
        <a class="collapse-item" href="{{ route('medicines.index') }}">
          <i class="fas fa-plus-circle mr-2"></i>Add Medicine
        </a>
        <a class="collapse-item" href="{{ route('categories.index') }}">
          <i class="fas fa-tags mr-2"></i>Categories
        </a>
      </div>
    </div>
  </li>

   <!-- Inventory -->
   <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory">
      <i class="fas fa-list"></i>
      <span>Inventory</span>
    </a>
    <div id="collapseInventory" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Inventory Operations</h6>
        <a class="collapse-item" href="{{ route('suppliers.index') }}">
          <i class="fas fa-truck-loading mr-2"></i>Suppliers
        </a>
        <a class="collapse-item" href="{{ route('stocks.index') }}">
          <i class="fas fa-plus-circle mr-2"></i>Add Stock
        </a>
      </div>
    </div>
  </li>

  <!-- Patients -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#collapsePatients" data-toggle="collapse" data-target="#collapsePatients">
      <i class="fas fa-user-injured"></i>
      <span>Patients</span>
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

  <!-- Reports -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#collapseReports" data-toggle="collapse" data-target="#collapseReports">
      <i class="fas fa-chart-bar"></i>
      <span>Reports</span>
    </a>
    <div id="collapseReports" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Report Types</h6>
        <a class="collapse-item" href="{{ route('salesreports.index') }}">
          <i class="fas fa-coins mr-2"></i>Sales Reports
        </a>
        <a class="collapse-item" href="{{ route('inventoryreports.index') }}">
          <i class="fas fa-boxes mr-2"></i>Inventory Reports
        </a>
        <a class="collapse-item" href="{{ route('expiryalerts.index') }}">
          <i class="fas fa-exclamation-triangle mr-2"></i>Expiry Alerts
        </a>
      </div>
    </div>
  </li>

</ul>



