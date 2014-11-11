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

if (isset($_POST['submitColeccion'])) {

	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$file = $_POST['file'];

	session_start();
	$_SESSION['nombre'] = $nombre;
	$_SESSION['descripcion'] = $descripcion;
	$_SESSION['file'] = $file; 
	header("Location: index.php");

	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("florycanto", $link);

	$nombre = $_SESSION['nombre'];
	$descripcion = $_SESSION['descripcion'];
	$imagen;
	$file = $_SESSION['file'];
	$estado = 0;


	// FILE UPLOADER CODE
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["file"]["error"] > 0) {
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  } else {
	    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	    echo "Type: " . $_FILES["file"]["type"] . "<br>";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
	    if (file_exists("upload/" . $_FILES["file"]["name"])) {
	      echo $_FILES["file"]["name"] . " already exists. ";
	    } else {
	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "upload/" . $_FILES["file"]["name"]);
	      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	      
	      $imagen = "upload/" . $_FILES["file"]["name"];
	    }
	  }
	} else {
	  echo "Invalid file";
	}
	//END FILE UPLOADER CODE

	$result = mysql_query("INSERT INTO coleccion(nombre, descripcion, logo) VALUES ('" . $nombre . "','" . $descripcion . "','$file');", $link);

	if($result){
		echo "OK, coleccion registrada";
	}else{
		echo "Error";
	}

	mysql_close($link);
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
				<h4 >Regresar</h4>
			</a>
			<h1 style="margin-top:-30px; padding-left: 50px"> Agregar Colecci&oacute;n:<h2>
		</div>

		<div class="instrucciones">
			<h3>Llenar Datos:</h3>
		</div>
		<?php echo $output; ?>
		<div class="formulario">
			<form action="crearcoleccion.php" method="POST" id="register-form" novalidate="novalidate" enctype="multipart/form-data">
				<div class="nombreEvento" style="padding-top:10px">
					<div class="textoFormulario" style="float:left;">
						Nombre:	
					</div>
					<div class="campoDeTextoFormulario" style="width:500px; padding-top:30px">
						<input type="text" placeholder="nombre del evento" name="nombre"/>
					</div>
				</div>
	
				<div class="descripcionEvento" style="padding-top:10px;">
					<div class="textoFormulario" style="float:left;">
						Descripci&oacute;n:
					</div>
					<div class="campoDeTextoFormulario" style="width:500px; padding-top:30px">
						<textarea maxlength="200" name="descripcion" placeholder ="Descripci&oacute;n del evento"></textarea>
					</div>
				</div>

				<div class="imagenEvento" style="padding-top:10px">
					<div class="textoFormulario" style="float:left">
						Subir logo:
					</div>
					<div style="padding-top:25px">
						<input name="file" id="file" class="botonSubir" type="file" style="padding: 5px;width: 400px">
					</div>
				</div>
	
				<div class="contenedorBotonEnviar">
					<div>
						<input type="submit" name="submitColeccion" class="boton" value="Submit" style="width:200px"></input>
					</div>
				</div>
			</form>
		</div>

	</body>

	<footer>

		<p>codeName:florycanto<br>
			date: 10 de noviembre, 2014 <br>
		</p>
	</footer>
</html>