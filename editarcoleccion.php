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
	$id = $_POST['id'];
} else {
	$claveColeccion = $_GET['claveColeccion'];
	$query = "SELECT * FROM coleccion WHERE id =" . $claveColeccion . ";";
	$result = mysql_query($query, $link);
	$coleccion = mysql_fetch_array($result);
}

if (isset($_POST['eliminarColeccion'])) {
	$sql = "DELETE FROM coleccion WHERE id ='" . $id . "'";
	$result = mysql_query($sql, $link);
	header("Location: index.php");

	if($result){
		echo "OK, coleccion actualizada";
	}else{
		echo "Error";
	}
}
if (isset($_POST['submitColeccion'])) {

	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["file"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	
	//END FILE UPLOADER CODE

	echo $id;
	$result = mysql_query("UPDATE coleccion SET nombre = '".$nombre."', descripcion ='" . $descripcion . "', logo = '" . $target_file . "' WHERE id ='".$id."'", $link);

	if($result){
		echo "OK, coleccion actualizada";
	}else{
		echo "Error";
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
		<title>Editar Colecci&oacute;n</title>

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
			<h1 style="margin-top:-30px; padding-left: 50px">Editar Colecci&oacute;n:<h2>
		</div>

		<div class="instrucciones">
			<h3>Llenar Datos:</h3>
		</div>
		<?php echo $output; ?>
		<div class="formulario">
			<form action="editarcoleccion.php" method="POST" id="register-form" novalidate="novalidate" enctype="multipart/form-data">
				<div class="nombreEvento" style="padding-top:10px">
					<div class="textoFormulario" style="float:left;">
						Nombre:
					</div>
					<div class="campoDeTextoFormulario" style="width:500px; padding-top:30px">
						<?php
							echo '<input type="text" placeholder="" value= "'. $coleccion['nombre'] . '" name="nombre"/>'
						?>
					</div>
				</div>

				<div class="descripcionEvento" style="padding-top:10px;">
					<div class="textoFormulario" style="float:left;">
						Descripci&oacute;n:
					</div>
					<div class="campoDeTextoFormulario" style="width:500px; padding-top:30px">
						<?php
							echo '<textarea maxlength="200" name="descripcion">'. $coleccion['descripcion'] . '</textarea>'
						?>
					</div>
				</div>

				<div class="imagenEvento" style="padding-top:10px">
					<div class="textoFormulario" style="float:left">
						Subir logo:
					</div>
					<div style="padding-top:25px">
					<?php
						echo '<input name="file" id="file" class="botonSubir" type="file" = "'. $coleccion['logo'] . '"style="padding: 5px;width: 400px">'
						
					?>
					</div>
				</div>
				<div class="contenedorBotonEliminar">
					<div>
						<input type="submit" name="eliminarColeccion" class="boton" value="Eliminar Coleccion" style="width:200px"></input>
					</div>
				</div>
				<div class="contenedorBotonEnviar">
					<div>
						<input type="submit" name="submitColeccion" class="boton" value="Actualizar" style="width:200px"></input>
					</div>
				</div>
					<?php
						echo '<input type="hidden" value= "'. $claveColeccion . '" name="id"/>'
					?>
			</form>
		</div>

	</body>

	<footer>

		<p>codeName:florycanto<br>
			date: 10 de noviembre, 2014 <br>
		</p>
	</footer>
</html>
