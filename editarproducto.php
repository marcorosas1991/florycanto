<?php
	session_start();
	if (!isset($_SESSION['usuario'])) {
		header('Location:login.php');
	}

?>

<?php

$link = mysql_connect("localhost", "root", "");
mysql_select_db("florycanto", $link);

if($_POST) {
	$id = $_POST['idProducto'];
} else {
	$idProducto = $_GET['idProducto'];
	$query = "SELECT * FROM producto_pieza WHERE idProducto ='" . $idProducto . "';";
	$result = mysql_query($query, $link);
	$coleccion = mysql_fetch_array($result);
}

if (isset($_POST['eliminarProducto'])) {
	$sql = "DELETE FROM producto_pieza WHERE idProducto ='" . $id . "'";
	$result = mysql_query($sql, $link);
	header("Location: index.php");

	if($result){
		echo "OK, coleccion de productos actualizada";
	}else{
		echo "Error";
	}
}
if (isset($_POST['go'])) {

	$cantidad = $_POST['cantidad'];
	$idProducto = $_POST['idProducto'];
	$categoria = $_POST['categoria'];
	$costoProduccion = $_POST['costoProduccion'];
	$costoVenta = $_POST['costoVenta'];
	$tamano = $_POST['tamano'];
	$descripcion = $_POST['descripcion'];
	$target_dir = "images/";
	$empaque=$_POST['empaque'];
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	//END FILE UPLOADER CODE

	echo $id;
	$result = mysql_query("UPDATE producto_pieza SET cantidad = '".$cantidad."', descripcion ='" . $descripcion ."', categoria ='" . $categoria ."', costoProduccion ='" . $costoProduccion."', costoVenta ='" . $costoVenta."', tamano ='" . $tamano."', nombreEmpaque ='" . $empaque.  "', imagen = '" . $target_file . "' WHERE idProducto ='".$id."'", $link);

	if($result){
		echo "OK, coleccion de productos actualizada";
	}else{
		echo mysql_error();
	}

	mysql_close($link);
	header("Location: index.php");

	exit;
}

// variables de conexion

$user = "root";
$nombre = '';
$lugar = '';
$descripcion = '';
$output = '';

if($_POST) {
  // collect all input and trim to remove leading and trailing whitespaces
  $nombre = trim($_POST['nombre']);
  $descripcion = trim($_POST['descripcion']);

  $errors = array();

  // Validate the input
  if (strlen($nombre) == 0)
    array_push($errors, "Por favor, ingresa el nombre del evento");

  if (strlen($descripcion) == 0)
    array_push($errors, "Por favor, ingresa una descripción del evento");

  // Si no se encontraron errores
  if (count($errors) == 0) {
    array_push($errors, "No se encontraron Errores. Gracias!");
  }

  // preparar erores para salida
  $output = '';
  foreach($errors as $val) {
    $output .= "<p class='output'>$val</p>";
  }

}

?>


<html>

	<head>
		<title>Editar Producto</title>

		<link type="text/css" rel="stylesheet" href="css/960_12_col.css"/>
		<style type="text/css">
   			#register-form label.error, .output {color:#ff3300;font-weight:bold;font-family:sans-serif}
  		</style>

		  <!-- Load jQuery and the validate plugin -->
		  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

		  <!-- jQuery Form Validation code -->
		  <script>

		  // When the browser is ready...
		  $(function() {

		    // Setup form validation on the #register-form element
		    $("#register-form").validate({

		        // Specify the validation rules
		        rules: {
		            nombre: "required",
		            descripcion: "required",
		        },

		        // Specify the validation error messages
		        messages: {
		            nombre: "Por favor, ingresa el nombre de la colecci&oacute;n",
		            descripcion: "Por favor, ingresa una descripci&oacute;n de la colecci&oacute;n",
		        },

		        submitHandler: function(form) {
		            form.submit();
		        }
		    });

		  });

		  </script>
		 <meta charset="utf-8"/>
	</head>
	<body>
	<div class="topBar">
			<!-- <h4><?php echo $_SESSION['username']?></h4> -->

			<Form name ="closeSessionForm" Method ="POST" Action ="index.php">
					<input type="submit" name="closeSession"class="botonCerrarSesion" value="Cerrar Sesi&oacute;n" style="width:120px; height:20px"/>
			</form>

		</div>

		<div class="textAlignLeft returnSection">
			<a href="index.php">
				<h4>Regresar</h4>
			</a>
			<h1 style="margin-top:-30px; padding-left: 50px">Editar Producto:<h2>
		</div>
		<?php echo $output; ?>
		<form action="editarproducto.php" class="base" method="post" enctype="multipart/form-data">
			<table width="100%">
				<tr>
					<th>Id Producto</th><th>Categoria</th><th>Tamaño</th><th>Cantidad</th><th>Descripción</th>
				</tr>
				<tr>
					<td align="center">
						<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['idProducto'] . '" name="idProducto"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['categoria'] . '" name="categoria"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['tamano'] . '" name="tamano"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['cantidad'] . '" name="cantidad"/>'
						?>
					</td>
					<td align="center">
					<?php
							echo '<textarea maxlength="200" name="descripcion">'. $coleccion['descripcion'] . '</textarea>'
						?>
					</td>
				</tr>
				<tr>
					<th>Costo de Producción</th><th>Costo de Venta</th><th>Coleccion</th><th>Empaque</th><th>Imagen del producto</th>
				</tr>
				<tr>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['costoProduccion'] . '" name="costoProduccion"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['costoVenta'] . '" name="costoVenta"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['categoria'] . '" name="empaque"/>'
						?>
					</td>
					<td align="center">
					<?php
								echo '<input type="text" placeholder="" value= "'. $coleccion['nombreEmpaque'] . '" name="empaque"/>'
						?>
					</td>
					<td align="center">
					<?php
						echo '<input name="file" id="file" class="botonSubir" type="file" = "'. $coleccion['imagen'] . '"style="padding: 5px;width: 400px">'

					?>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
				<td></td>
				<td align="center"><input type="submit" name="eliminarColeccion" class="boton" value="Eliminar Coleccion" style="width:200px"></input></td><td></td><td align="center"><input type="submit" name="go" value="Enviar" style="width:200"></input></td>
				</tr>
			</table>
			<?php
						echo '<input type="hidden" value= "'. $idProducto . '" name="id"/>'
					?>
		</form>
		</div>
	</body>
</html>
