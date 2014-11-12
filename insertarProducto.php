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

  // IMAGE UPLOAD HANDLER
  define ("MAX_SIZE", "100");

  $image=$_FILES['image']['name'];

  if($image) {
    $filename = stripslashes($_FILES['image']['name']);
    $extension = getExtension($filename);
    $extension = strtolower($extension);

    $image_name = time().'.'.$extension;

    $newname = "images/".$image_name;

    $copied = copy($_FILES['image']['tmp_name'], $newname);

    if(!$copied) {
      echo 'copy unseccessfull';
    }
  }

  function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) {
      return "";
    }
    $I = strlen($str) - $i;
    $ext = substr($str, $i+1, $I);
    return $ext;
  }

  $result = mysql_query("INSERT INTO producto_pieza(idProducto, coleccionid, categoria, tamano, cantidad, descripcion, costoProduccion, costoVenta, imagen, nombreEmpaque) VALUES ('" . $id . "','" . $coleccion . "','" . $categoria . "','" . $tamano . "','" . $cantidad . "','" . $descripcion . "','" . $costoP . "','" . $costoV . "','" . $newname . "','" . $empaque . "');", $link);

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
