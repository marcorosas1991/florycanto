<?php

	session_start();
	if (!isset($_SESSION['usuario'])) {
		header('Location:login.html');
	}

?>

<html>
	<head>
		<title>Flor y Canto Joyeria</title>
		<link type="text/css" rel="stylesheet"href="css/960_12_col.css" />

		<style>
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
	</head>

	<body>
		<div class="container_12 clearfix">
			<div id="header" class="grid_12">
				<h1>Flor y Canto Joyeria</h1>
                <img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>
				<div id="nav">
					<ul>
						<li><a href="index.php"> Inicio</a></li>
						<li><a href="login.php" id="align_right"> Cerrar Sesi&oacute;n</a></li>
					</ul>
				</div>
			</div>
			<div id="feature" class="grid_12">
				<h3><p> Productos </p></h3>
			</div>


			<a href=""><div class="article grid_4">
				<h4><p>Dije Grabado</p></h4>
				<img src="images/iconos.png" alt="Event" /><br><br>
				<a href="editar.php"><img id="left_image" src="images/Edit.png"></a>

			</div></a>

            <div class="article grid_4">
				<h4><p>Agregar</p></h4>
				<img src="images/add.png" alt="Event" />
				<p>Hacer click para agregar <br>nueva colecci&oacute;n.</p>
			</div>


			<div id="footer" class="grid_12">
				<p>&copy; Copyright 2014. Algunos derechos reservados, Flor y Canto Joyeria 2014</p>
			</div>
		</div> <!-- .container_12 -->

	</body>
</html>
