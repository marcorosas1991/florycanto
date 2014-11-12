<?php

  session_start();
  if (!isset($_SESSION['usuario'])) {
    header('Location:login.php');
  }

?>

<html>
<head>

  <title>Agregar Producto</title>
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <script type="text/javascript"
    src="valida.js">
  </script>


</head>

<body>
  <h1>Agregar Producto</h1>

  <br>
  <form action="insertarProducto.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)">
    <table class="signup" border="0" cellpadding="2" cellspacing="15" bgcolor="#eeeeee">
      <tbody>
        <tr>
          <td>ID producto</td>
          <td><input maxlength="30" type="text" name="idProducto"></td>
        </tr>
        <tr>
          <td>Colecci&oacute;n</td>
          <td><input maxlength="30" type="text" name="coleccionid"></td>
        </tr>
        <tr>
          <td>Categor&iacute;a</td>
          <td><input maxlength="50" type="text" name="categoria"></td>
        </tr>
        <tr>
          <td>Tama&ntilde;o</td>
          <td><input maxlength="50" type="text" name="tamano"></td>
        </tr>
        <tr>
          <td>Cantidad</td>
          <td><input maxlength="50" type="text" name="cantidad"></td>
        </tr>
        <tr>
          <td>Descripci&oacute;n</td>
          <td><textarea style="height: 150px; width:400px" maxlength="200" type="text" name="descripcion"></textarea></td>
        </tr>
        <tr>
          <td>Costo producci&oacute;n</td>
          <td><input maxlength="50" type="text" name="costoProduccion"></td>
        </tr>
        <tr>
          <td>Costo venta</td>
          <td><input maxlength="50" type="text" name="costoVenta"></td>
        </tr>
        <tr>
          <td>Empaque</td>
          <td><input maxlength="50" type="text" name="empaque"></td>
        </tr>
        <tr>
          <td>Subir imagen</td>
          <td><input class="botonSubir" type="file" accept=".png, .jpg" name="image"></td>
        </tr>

        <tr>
          <td colspan="2"><input name="Submit" type="submit" value="Agregar Producto" /></td>
        </tr>

      </tbody>
    </table>
  </form>


</body>

</html>
