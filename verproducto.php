<?php

  session_start();
  if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
  }

?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Producto</title>
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
        height: 640px;}

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
        <br>
          <img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>
      </div>

      <?php

      $claveProducto = $_GET['claveProducto'];

      $link = mysql_connect("localhost", "root", "");
      mysql_select_db("florycanto", $link);


      $result = mysql_query("SELECT * FROM producto_pieza WHERE idProducto='".$claveProducto."'", $link);
      $num_rows = mysql_num_rows($result);



      $producto = mysql_fetch_array($result);


       $nombre = $producto['idProducto'];
       $nombreEmpaque = $producto['nombreEmpaque'];
       $tamano = $producto['tamano'];
       $cantidad = $producto['cantidad'];
       $descripcion = $producto['descripcion'];
       $costoProduccion = $producto['costoProduccion'];
       $costoVenta = $producto['costoVenta'];
       $coleccionid = $producto['coleccionid'];
       $categoria = $producto['categoria'];


      echo'


        <div id="feature" class="grid_12">
        <a href="verproducto.php?claveproducto=' . $producto['idProducto'] . '">
        <h4><p>' . $producto['idProducto'] .'</p></h4>
        <img src="'.$producto['imagen'].'" style="width: 274px; height: 183px;" /><br><br>
        <a href="editarproducto.php?claveProducto=' . $producto['idProducto'] . '"><img id="left_image" src="images/Edit.png"></a>
        </a>

        <h3><p> Producto:   '.$nombre.' </p></h3>
        <h3><p> Empaque recomendable a utilizar: '.$nombreEmpaque.' </p></h3>
        <h3><p> Tamaño: '.$tamano.' </p></h3>
        <h3><p> Descripcion: '.$descripcion.' </p></h3>
        <h3><p> Categoria:  '.$categoria.' </p></h3>

        <h3><p> Cantidad: '.$cantidad.' </p></h3>

        <h3><p> Costo de Produci&oacute;n: '.$costoProduccion.' </p></h3>
        <h3><p> Costo de Venta: '.$costoVenta.' </p></h3>

      </div>';



      mysql_close($link);
      ?>




      <div id="footer" class="grid_12">
        <p>&copy; Copyright 2014. Algunos derechos reservados, Flor y Canto Joyeria 2014</p>
      </div>
    </div> <!-- .container_12 -->

  </body>
</html>
