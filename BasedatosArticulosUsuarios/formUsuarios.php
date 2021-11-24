<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosformArticulos.css">
    <title>Articulos.php</title>
</head>
<body>
    <?php require "BaseDatos.php";?>
    
    <form method="post" action="formUsuarios.php">
        <?php error_reporting(0);
        
       
        
        $idpost = $_POST['infoutil1'];
        $nombrepost = $_POST['infoutil2'];
        $gmailpost = $_POST['infoutil3'];
        $ultimoaccesopost = $_POST['infoutil4'];
        $autorizadopost = $_POST['infoutil5'];
        
        if($_POST['modifico'] == "modificar"){
            
            session_start();
            
            $_SESSION['postinfo1'] = $idpost;
            $_SESSION['postinfo2'] = $_SESSION['postinfo1'];
            
            
            
            echo <<<EOT
            <p>Se está modificando un usuario</p>
            <div class="div__id"><label>ID:</label><input value="$idpost" type="number" required name="id"></input ></div>
            </select></div>
            <div class="div__coste"><label>Nombre:</label><input value="$nombrepost" type="text" name="nombre" required></input></div>
            <div class="div__nombre"><label>Contraseña:</label><input value="**********" type="text" required name="contra"></input></div>
            <div class="div__nombre"><label>Correo:</label><input value="$gmailpost" type="text" required name="gmail"></input></div>
            <div class="div__precio"><label>Ultimo Acceso:</label> <input value="$ultimoaccesopost" type="date" name="fecha" required></input></div>
            EOT;
            if($autorizadopost == 1){
                echo '<div class="div__precio"><label>Autorizado:</label> <input value="1" type="radio" name="enable" required checked>si</input>';
                echo '<input value="$preciopost" type="radio" name="enable" required >no</input></div>';
            }else{
                echo '<div class="div__precio"><label>Autorizado:</label> <input value="1" type="radio" name="enable" required>si</input>';
                echo '<input value="$preciopost" type="radio" name="enable" required checked >no</input></div>';
            }
            
            
            echo '<div class="volver"><a href="Usuarios.php">Volver</a></div>';
            echo '<input name ="modificopost"class="añadir__value" type="submit" value="Modificar"></input>';
            
            
            $idpost = $_POST["id"];
            $nombrepost = $_POST["nombre"];
            $gmailpost = $_POST["gmail"];
            $ultimoaccesopost = $_POST["fecha"];
            $autorizadopost = $_POST["enable"];
            
            
            
        }else if($_POST['elimino'] == "eliminar"){
            session_start();
            
            $_SESSION['postinfo1'] = $idpost;
            
            echo <<<EOT
            <p>Se está eliminando un usuario</p>
            <div class="div__id"><label>ID:</label><input value="$idpost" type="number" required name="id"></input ></div>
            </select></div>
            <div class="div__coste"><label>Nombre:</label><input value="$nombrepost" type="text" name="nombre" required></input></div>
            <div class="div__nombre"><label>Contraseña:</label><input value="**********" type="text" required name="contra"></input></div>
            <div class="div__nombre"><label>Correo:</label><input value="$gmailpost" type="text" required name="gmail"></input></div>
            <div class="div__precio"><label>Ultimo Acceso:</label> <input value="$ultimoaccesopost" type="date" name="fecha" required></input></div>
            EOT;
            if($autorizadopost == 1){
                echo '<div class="div__precio"><label>Autorizado:</label> <input value="1" type="radio" name="enable" required checked>si</input>';
                echo '<input value="$preciopost" type="radio" name="enable" required >no</input></div>';
            }else{
                echo '<div class="div__precio"><label>Autorizado:</label> <input value="1" type="radio" name="enable" required>si</input>';
                echo '<input value="$preciopost" type="radio" name="enable" required checked >no</input></div>';
            }
            
            
            echo '<div class="volver"><a href="Usuarios.php">Volver</a></div>';
            echo '<input name ="eliminopost"class="añadir__value" type="submit" value="Eliminar"></input>';
            
            
            $idpost = $_POST["id"];
            $nombrepost = $_POST["nombre"];
            $gmailpost = $_POST["gmail"];
            $ultimoaccesopost = $_POST["fecha"];
            $autorizadopost = $_POST["enable"];
            
        }else{
            session_start();
            
            $_SESSION['postinfo1'] = $idpost;
            
            echo <<<EOT
            <p>Se está agregando un usuario</p>
            <div class="div__id"><label>ID:</label><input  type="number" required name="id"></input ></div>
            </select></div>
            <div class="div__coste"><label>Nombre:</label><input  type="text" name="nombre" required></input></div>
            <div class="div__nombre"><label>Contraseña:</label><input value="" type="password" required name="contra"></input></div>
            <div class="div__nombre"><label>Correo:</label><input  type="text" required name="gmail"></input></div>
            <div class="div__precio"><label>Ultimo Acceso:</label> <input  type="date" name="fecha" required></input></div>
            EOT;
            if($autorizadopost == 1){
                echo '<div ><label>Autorizado:</label> <input class="div__autorizado" value="1" type="radio" name="enable" required checked>si</input>';
                echo '<input class="div__autorizado"  value="$preciopost" type="radio" name="enable" required >no</input></div>';
            }else{
                echo '<div ><label>Autorizado:</label> <input class="div__autorizado" value="1" type="radio" name="enable" required>si</input>';
                echo '<input class="div__autorizado" value="$preciopost" type="radio" name="enable" required checked >no</input></div>';
            }
            
            
            echo '<div class="volver"><a href="Usuarios.php">Volver</a></div>';
            echo '<input name ="agregopost"class="añadir__value" type="submit" value="Agregar"></input>';
            
            
            $idpost = $_POST["id"];
            $nombrepost = $_POST["nombre"];
            $gmailpost = $_POST["gmail"];
            $ultimoaccesopost = $_POST["fecha"];
            $autorizadopost = $_POST["enable"];
            
            
        }
        
        ?>
        
        <?php 
        
        $procedimiento = "nada";
        $agregopost = $_POST["agregopost"];
        $eliminopost = $_POST["eliminopost"];
        $modificopost = $_POST["modificopost"];
        
        if($agregopost == "Agregar"){
            
            agregarUsuario($idpost, $nombrepost, $gmailpost, $ultimoaccesopost, $autorizadopost);

        }else if($eliminopost == "Eliminar"){
            
           eliminarUsuario($idpost);

        }else if($modificopost == "Modificar"){
            
           modificarUsuario($idpost, $nombrepost, $gmailpost, $ultimoaccesopost, $autorizadopost);

        }
        
        ?>
        
        
        
        
        
        




    </form>
    <h4 class="texto__oculto">Se ha creado el Usuario</h4>
    <h4 class="texto__oculto-modificar">Se ha modificado el Usuario</h4>
    <h4 class="texto__oculto-borrar">Se ha borrado el Usuario</h4>
    <button id="volver__oculto"><a href="Usuarios.php">Volver</a></button>

</body>
</html>