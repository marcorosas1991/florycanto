<?php

session_start();

// if(empty($_SESSION['username'])) {
// 	session_start();
// 	$_SESSION['loginStatus'] = "necesitas identificarte!";
// 	header("Location: login.php");
// }

if (isset($_POST['closeSession'])) {

	session_unset();
	session_destroy();
	header("Location: index.php");
	exit;
}
$link = mysql_connect("localhost", "root", "");
mysql_select_db("florycanto", $link);
if (isset($_POST['submitColeccion'])) {

	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$target_dir = "images/";
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
	$_SESSION['nombre'] = $nombre;
	$_SESSION['descripcion'] = $descripcion;

	$nombre = $_SESSION['nombre'];
	$descripcion = $_SESSION['descripcion'];
	$imagen;
	$estado = 0;
	//END FILE UPLOADER CODE

	$result = mysql_query("INSERT INTO coleccion(nombre, descripcion, logo) VALUES ('" . $nombre . "','" . $descripcion . "','" . $target_file ."');", $link);

	if($result){
		echo "OK, coleccion registrada";
	}else{
		echo "Error";
	}

	header("Location: index.php");
	mysql_close($link);
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
  $file = trim($_POST['file']);
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
		<title>Agregar Colecci&oacute;n</title>

		<link type="text/css" rel="stylesheet" href="css/960_12_col.css"/>
		<style type="text/css">
   			#register-form label.error, .output {color:#ff3300;font-weight:bold;font-family:sans-serif}
            * {
				font-family: Arial, Verdana, sans-serif;
				color: #665544;
				text-align: center;}

			#nav, #feature, .article, #footer {
				background-color: #efefef;
				margin-top: 20px;
				padding: 10px 0px 5px 0px;}

			#feature, .article {
				height: 60px;}

			li {
				display: inline;
				padding: 5px;}
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
<img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>

        <div id="nav">
					<ul>
						<li><a href="index.php"> Inicio</a></li>
						<li><a href="login.php" id="align_right"> Cerrar Sesi&oacute;n</a></li>
					</ul>
				</div>

        <div id="footer" class="grid_12" style="padding-left: 28%; padding-right: 32%;"><h1 style="margin-top:10px;"> Agregar Colecci&oacute;n</h1>

		<div class="instrucciones">
			<h3>Llenar Datos:</h3>
		</div>
		<?php echo $output; ?>
		<div class="formulario">
			<form action="crearcoleccion.php" method="POST" id="register-form" novalidate="novalidate" enctype="multipart/form-data">
				<div class="nombreEvento" style="padding-top:0px">
					<div class="textoFormulario">Nombre:
					</div>
					<div class="campoDeTextoFormulario" style="width:500px;">
						<input type="text" placeholder="nombre del evento" name="nombre"/>
					</div>
				</div>

				<div class="descripcionEvento" style="padding-top:10px;">
					<div class="textoFormulario">
						Descripci&oacute;n:
					</div>
					<div class="campoDeTextoFormulario" style="width:500px;">
						<textarea style="height: 150px; width:400px" maxlength="200" name="descripcion" placeholder ="Descripci&oacute;n del evento"></textarea>
					</div>
				</div>

				<div class="imagenEvento" style="padding-top:10px">
					<div class="textoFormulario">
						Subir logo:
					</div>
					<div>
						<input name="file" id="file" class="botonSubir" type="file" style="padding: 5px;width: 400px">
					</div>
				</div>

				<div class="contenedorBotonEnviar">
					<div>
						<br><input type="submit" name="submitColeccion" class="boton" value="Terminar" style="width:200px"></input>
					</div>
				</div>
			</form>
		</div>
    </div>
        </center>
	</body>

	<footer>

	</footer>
</html>
