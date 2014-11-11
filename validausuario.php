<?php

  $link = mysql_connect("localhost", "root", "");
  mysql_select_db("florycanto", $link);

  if ((isset($_POST['user']) && $_POST['user'] != "") && (isset($_POST[password]) && $_POST[password] != "")) {

    $user = $_POST['user'];
    $password = $_POST[password];


    $query = "select user from users where user='" . $user . "' and password='" . $password . "';";

    $result = mysql_query($query, $link);

    $num_rows = mysql_num_rows($result);

    if($num_rows > 0){
      session_start();
      $_SESSION[usuario]="admin";
      header('Location:index.php');
    }else{
      header('Location:login.php');
    }

  }else{
    header('Location:login.php');
    echo("no hay conexion con BD");
  }

mysql_close($link);

?>
