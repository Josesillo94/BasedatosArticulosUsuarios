<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosIndex.css">
    <title>Index.php</title>
</head>
<body>
    <?php

include "BaseDatos.php";


//Mostramos un menu de login y si el usuario esta registrado le permitimos avanzar

?>
<form method="post" action="Index.php" name="formulario">
    <div class="div-usuario">
        <label >Usuario:</label>
        <input type="text" name="usuario" required  />
    </div>
    <div class="div-gmail">
        <label>Gmail</label>
        <input type="text" name="gmail" required />
    </div>
    <button type="submit" name="acceder" value="login">Acceder</button>
    <?php 
    session_start();
    error_reporting(0);
    comprobarUsuario($_POST['usuario'], $_POST['gmail'])?>
    
</form>

</body>
</html>