<style>
    
.boton
{
    margin-top: 10px;
    font-size: 1em !important;
    font-family: 'Ubuntu Mono' !important;
    border-radius: .3em;
    
    letter-spacing:2px;
    width: 25%;
    height: 30px;
    border: 0px;
    background-color: #F5A9F2;
    outline: 0;

    background-image: linear-gradient(45deg, rgba(0, 0, 0, 0.05) 25%, transparent 25%, transparent),
                      linear-gradient(-45deg, rgba(0, 0, 0, 0.05) 25%, transparent 25%, transparent),
                      linear-gradient(45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%),
                      linear-gradient(-45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%);    
}
</style>

<html>
  <head>
    <title>Inicio de Sesi&oacute;n</title>
  </head>

  <body>
    <center><img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>
    <h1> Ingreso al Sistema </h1>
    <form action="validaUsuario.php" method="post">
      <span>Usuario: <input type="text" name="user"> </span>
      <br>
      <br>
      <span>Contrase&ntilde;a: <input type="password" name="password"> </span>
      <br>
      <br>
      <input type="submit" value="Ingresar" class="boton">
      </form>
      </center>
  </body>
</html>
