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

      $result = mysql_query("SELECT * FROM coleccion WHERE id=$claveColeccion", $link);
      $num_rows = mysql_num_rows($result);

      echo'<div id="feature" class="grid_12">
        <h3><p> Productos Colecci&oacute;n: '.$claveColeccion.' </p></h3>
      </div>';

      while($row = mysql_fetch_array($result)){

        echo '<a href="vercoleccion.php?claveColeccion=' . $row['id'] . '"><div class="article grid_4">
        <h4><p>' . $row['nombre'] .'</p></h4>
        <img src="'.$row['logo'].'" alt="Event" /><br><br>
        <a href="editarcoleccion.php?claveColeccion=' . $row['id'] . '"><img id="left_image" src="images/Edit.png"></a>
        </div></a>';

      }

      mysql_close($link);
      ?>

      <a href="crearcoleccion.php"><div class="article grid_4">
        <h4><p>Agregar</p></h4>
        <img src="images/add.png" alt="Event" />
        <p>Hacer click para agregar <br>nueva colecci&oacute;n.</p>
      </div></a>


      <div id="footer" class="grid_12">
        <p>&copy; Copyright 2014. Algunos derechos reservados, Flor y Canto Joyeria 2014</p>
      </div>
    </div> <!-- .container_12 -->

  </body>
</html>
