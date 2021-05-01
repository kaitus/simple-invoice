<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
    }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_dashboard="";
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";
	$active_perfil="";
	$title="Dashboard | Simple Invoice";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("head.php");?>
</head>

<body id="page-top">

<!-- Page Wrapper -->
  <div id="wrapper">

    <?php
      include("navbar.php");
    ?> 

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php
              include("tolbar.php");
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
			<div class="panel panel-info" ></div>
                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Cliente</button>
                    </div>
					<hr class="sidebar-divider d-none d-md-block">
                    <h4><i class='glyphicon glyphicon-search'></i> Buscar Clientes</h4>
                </div>
                <div class="panel-body">
                    <?php
                        include("modal/registro_clientes.php");
                        include("modal/editar_clientes.php");
                    ?>
                    <form class="form-horizontal" role="form" id="datos_cotizacion">
                        <div class="form-group row">
                            <label for="q" class="col-md-2 control-label">Cliente</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="q" placeholder="Nombre del cliente" onkeyup='load(1);'>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default" onclick='load(1);'>
                                    <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                <span id="loader"></span>
                            </div>
                        </div>
                    </form>
                    <div id="resultados"></div><!-- Carga los datos ajax -->
                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                </div>

                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
          include("footer.php");
        ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script type="text/javascript" src="js/clientes.js"></script>

</body>
</html>