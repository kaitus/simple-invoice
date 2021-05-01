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
	$active_productos="active";
	$active_clientes="";
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


                <div class="panel-heading">
                    <div class="btn-group pull-right">
                        <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nuevo Producto</button>
                    </div>
                    <h4><i class='glyphicon glyphicon-search'></i> Buscar Productos</h4>
                </div>
                <div class="panel-body">
                    <?php
                    include("modal/registro_productos.php");
                    include("modal/editar_productos.php");
                    ?>
                    <form class="form-horizontal" role="form" id="datos_cotizacion">
                        <div class="form-group row">
                            <label for="q" class="col-md-2 control-label">Código o nombre</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
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
  <script type="text/javascript" src="js/productos.js"></script>

</body>
</html>
<script>
$( "#guardar_producto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_producto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_producto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var codigo_producto = $("#codigo_producto"+id).val();
			var nombre_producto = $("#nombre_producto"+id).val();
			var estado = $("#estado"+id).val();
			var precio_producto = $("#precio_producto"+id).val();
			$("#mod_id").val(id);
			$("#mod_codigo").val(codigo_producto);
			$("#mod_nombre").val(nombre_producto);
			$("#mod_precio").val(precio_producto);
			$("#mod_estado").val(estado);
		}
</script>
