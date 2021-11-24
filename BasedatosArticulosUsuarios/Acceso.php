<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosAcceso.css">
    <title>Acceso.php</title>
</head>
<body>
    <div class="div">
    <div class="div__interno"><a href="Articulos.php">Artículos</a></div>
    <?php 
    include "BaseDatos.php";
     //Mostramos articulos y buscamos si el usuario es admin para mostrar usuarios
      localizarAdmin();  

    ?>

    
    <button><a href="index.php">Volver</a></button>
    </div>

</body>
</html>