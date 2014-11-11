<style>

@import url(http://fonts.googleapis.com/css?family=Courgette);

*{
    font-family: 'Courgette';
}
    
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
    background-color: #7DB739;
    outline: 0;

    background-image: linear-gradient(45deg, rgba(0, 0, 0, 0.05) 25%, transparent 25%, transparent),
                      linear-gradient(-45deg, rgba(0, 0, 0, 0.05) 25%, transparent 25%, transparent),
                      linear-gradient(45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%),
<<<<<<< HEAD
<<<<<<< HEAD
                      linear-gradient(-45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%);
}


.header{
    font-color:#7DB739;
    font-family: Monotype-cursiva;
}

=======
                      linear-gradient(-45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%); 
}

    
.header{
    font-color:#7DB739;
    font-family: Monotype-cursiva;
}  
    
>>>>>>> alan
=======
                      linear-gradient(-45deg, transparent 75%, rgba(0, 0, 0, 0.05) 75%); 
}

    
>>>>>>> emilio
</style>

<html>
  <head>
    <title>Inicio de Sesi&oacute;n</title>
  </head>

  <body>
    <center><img src="http://i98.photobucket.com/albums/l273/Pompovaz/florycanto_zps017d7eb8.png"/>
    <p class="header" style="color: #E12A83; font-family: Courgette; font-size: 30px;"> Ingreso al Sistema </p>
    <form action="validaUsuario.php" method="post">
      <span style="font-family: Courgette;">Usuario: <input type="text" name="user"> </span>
      <br>
      <br>
      <span style="font-family: Courgette; font-color: #444444;">Contrase&ntilde;a: <input type="password" name="password"> </span>
      <br>
      <br>
      <input type="submit" value="Ingresar" class="boton">
      </form>
      </center>
  </body>
</html>
