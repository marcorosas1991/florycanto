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
        <div id="nav">
          <ul>
            <li><a href="index.php"> Inicio</a></li>
            <li><a href="cerrarSesion.php" id="align_right"> Cerrar Sesi&oacute;n</a></li>
          </ul>
        </div>
          <img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>
      </div>

      <?php

      $claveColeccion = $_GET['claveColeccion'];

      $link = mysql_connect("localhost", "root", "");
      mysql_select_db("florycanto", $link);

      // seleccionar la coleccion
      $result = mysql_query("SELECT * FROM coleccion WHERE id=$claveColeccion", $link);
      $coleccion = mysql_fetch_array($result);

      $nombre = $coleccion['nombre'];
      $descripcion = $coleccion['descripcion'];

      echo'<div id="feature" class="grid_12">
        <h3><p> Productos Colecci&oacute;n: '.$nombre.' </p></h3>
        <p>'.$descripcion.'</p>
      </div>';

      //seleccionar los articulos
      $resultarticulos = mysql_query("SELECT * FROM producto_pieza WHERE coleccionid=$claveColeccion", $link);
      $num_rows = mysql_num_rows($resultarticulos);

      while($row = mysql_fetch_array($resultarticulos)){

        echo '<a href="verproducto.php?claveColeccion=' . $row['idProducto'] . '"><div class="article grid_4">
        <h4><p>' . $row['idProducto'] .'</p></h4>
        <img src="'.$row['imagen'].'" style="width: 174px; height: 143px;" /><br><br>
        <a href="editarproucto.php?claveColeccion=' . $row['idProducto'] . '"><img id="left_image" src="images/Edit.png"></a>
        </div></a>';

      }

      mysql_close($link);
      ?>

      <a href="crearproducto.php"><div class="article grid_4">
        <h4><p>Agregar</p></h4>
        <img src="images/add.png" alt="Event" />
        <p>Hacer click para agregar un<br>nuevo producto.</p>
      </div></a>


      <div id="footer" class="grid_12">
        <p>&copy; Copyright 2014. Algunos derechos reservados, Flor y Canto Joyeria 2014</p>
      </div>
    </div> <!-- .container_12 -->

  </body>
</html>
