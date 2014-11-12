<?php

  session_start();
  if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
  }

?>

<?php


  $id  = $_POST["idProducto"];
  $coleccion = $_POST["coleccionid"];
  $categoria = $_POST["categoria"];
  $tamano = $_POST["tamano"];
  $cantidad = $_POST["cantidad"];
  $descripcion = $_POST["descripcion"];
  $costop = $_POST["costoProduccion"];
  $costov = $_POST["costoVenta"];
  $empaque = $_POST["empaque"];


  $link = mysql_connect("localhost", "root", "");
  mysql_select_db("florycanto", $link);

  mysql_query("set autocommit=0;", $link);
  mysql_query("start_transaction;", $link);

  $result = mysql_query("INSERT INTO producto_pieza(idProducto, coleccionid, categoria, tamano, cantidad, descripcion, costoProduccion, costoVenta, imagen, nombreEmpaque) VALUES ('" . $id . "','" . $coleccion . "','" . $categoria . "','" . $tamano . "','" . $tamano . "','" . $cantidad . "','" . $descripcion . "','" . $costoP . "','images/mariposa.png','" . $empaque . "');", $link);

  if ($result) {
    echo "Operacion correcta";
    mysql_query("commit;", $link);
  } else {
    echo "Error";
    mysql_query("rollback;", $link);
  }
  
  mysql_close($link);
  header('Location: vercoleccion.php?claveColeccion='.$coleccion.'');


?>
