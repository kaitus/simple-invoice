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
	$active_clientes="";
	$active_usuarios="";	
	$active_perfil="active";		
	$title="Dashboard | Simple Invoice";

    $query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
	$row=mysqli_fetch_array($query_empresa);
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
                <form method="post" id="perfil">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
                        <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class='glyphicon glyphicon-cog'></i> Configuración</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center"> 
                                    <div id="load_img">
                                        <img class="img-responsive" width="300" src="<?php echo $row['logo_url'];?>" alt="Logo">
                                    </div>
                                    <br>				
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-9 col-lg-9 "> 
                                    <table class="table table-condensed">
                                        <tbody>
                                        <tr>
                                            <td>Nombre de la empresa:</td>
                                            <td>
												<div class="form-group">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="nombre_empresa" name="nombre_empresa" aria-describedby="emailHelp"
                                                        value="<?php echo $row['nombre_empresa']?>" required>
                                                </div>
											</td>
                                        </tr>
                                        <tr>
                                            <td>Teléfono:</td>
                                            <td><input type="text" class="form-control input-sm" name="telefono" value="<?php echo $row['telefono']?>" required></td>
                                        </tr>
                                        <tr>
                                            <td>Correo electrónico:</td>
                                            <td><input type="email" class="form-control input-sm" name="email" value="<?php echo $row['email']?>" ></td>
                                        </tr>
                                        <tr>
                                            <td>IVA (%):</td>
                                            <td><input type="text" class="form-control input-sm" required name="impuesto" value="<?php echo $row['impuesto']?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Simbolo de moneda:</td>
                                            <td>
                                                <select class='form-control input-sm' name="moneda" required>
                                                            <?php 
                                                                $sql="select name, symbol from  currencies group by symbol order by name ";
                                                                $query=mysqli_query($con,$sql);
                                                                while($rw=mysqli_fetch_array($query)){
                                                                    $simbolo=$rw['symbol'];
                                                                    $moneda=$rw['name'];
                                                                    if ($row['moneda']==$simbolo){
                                                                        $selected="selected";
                                                                    } else {
                                                                        $selected="";
                                                                    }
                                                                    ?>
                                                                    <option value="<?php echo $simbolo;?>" <?php echo $selected;?>><?php echo ($simbolo);?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dirección:</td>
                                            <td><input type="text" class="form-control input-sm" name="direccion" value="<?php echo $row["direccion"];?>" required></td>
                                        </tr>
                                        <tr>
                                            <td>Ciudad:</td>
                                            <td><input type="text" class="form-control input-sm" name="ciudad" value="<?php echo $row["ciudad"];?>" required></td>
                                        </tr>
                                        <tr>
                                            <td>Región/Provincia:</td>
                                            <td><input type="text" class="form-control input-sm" name="estado" value="<?php echo $row["estado"];?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Código postal:</td>
                                            <td><input type="text" class="form-control input-sm" name="codigo_postal" value="<?php echo $row["codigo_postal"];?>"></td>
                                        </tr>
                                    
                                            
                                        
                                        </tbody>
                                    </table>
                                
                                
                                </div>
                                <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar datos</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

	<!-- Footer -->
	<?php
		include("footer.php");
	?>
	<!-- End of Footer -->

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
  <script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>

</body>
</html>
<script>
$( "#perfil" ).submit(function( event ) {
  $('.guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_perfil.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);

		  }
	});
  event.preventDefault();
})	
</script>

<script>
	function upload_image(){
		var inputFileImage = document.getElementById("imagefile");
		var file = inputFileImage.files[0];
		if( (typeof file === "object") && (file !== null) )
		{
			$("#load_img").text('Cargando...');	
			var data = new FormData();
			data.append('imagefile',file);
			
			
			$.ajax({
				url: "ajax/imagen_ajax.php",        // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					$("#load_img").html(data);
					
				}
			});	
		}
	}
</script>

