	<?php
		if (isset($title))
		{
	?>

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="sidebar-brand-text mx-3">SISTEMA POS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php echo $active_dashboard;?>">
          <a class="nav-link" href="dashboard.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Facturas -->
      <li class="nav-item <?php echo $active_facturas;?>">
          <a class="nav-link" href="facturas.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Facturas</span></a>
      </li>

      <!-- Nav Item - Productos -->
      <li class="nav-item <?php echo $active_productos;?>">
          <a class="nav-link" href="productos.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Productos</span></a>
      </li>

      <!-- Nav Item - Clientes -->
      <li class="nav-item <?php echo $active_clientes;?>">
          <a class="nav-link" href="clientes.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Clientes</span></a>
      </li>

      <!-- Nav Item - Usuarios -->
      <li class="nav-item <?php echo $active_usuarios;?>">
          <a class="nav-link" href="usuarios.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Usuarios</span></a>
      </li>

      <!-- Nav Item - Usuarios -->
      <li class="nav-item <?php echo $active_perfil;?>">
          <a class="nav-link" href="perfil.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Configuración</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
<!-- End of Sidebar -->
	<?php
		}
	?>