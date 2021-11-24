<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosformArticulos.css">
    <title>Articulos.php</title>
</head>
<body>
    <?php require "BaseDatos.php";?>
    <form method="post" action="formArticulos.php">
        <?php error_reporting(0);
        
       
        
        $idpost = $_POST['infoutil1'];
        $categoriapost = $_POST['infoutil2'];
        $nombrepost = $_POST['infoutil3'];
        $costepost = $_POST['infoutil4'];
        $preciopost = $_POST['infoutil5'];
        
        if($_POST['modifico'] == "modificar"){
            session_start();
            $_SESSION['postinfo1'] = $idpost;
            echo <<<EOT
            <p>Se está modificando un artículo</p>
            <div class="div__id"><label>ID:</label><input value="$idpost" type="number" required name="id"></input ></div>
            <div class="div__categoria"><label>Categoría:</label><select value="$categoriapost" name="categoría" id="input" required >
            <option ></option>
            <option value="PANTALÓN">PANTALÓN</option>
            <option value="CAMISA">CAMISA</option>
            <option value="JERSEY">JERSEY</option>
            <option value="CHAQUETA">CHAQUETA</option>
            </select></div>
            <div class="div__nombre"><label>Nombre:</label><input value="$nombrepost" type="text" required name="nombre"></input></div>
            <div class="div__coste"><label>Coste:</label><input value="$costepost" type="number" name="coste" required></input></div>
            <div class="div__precio"><label>Precio:</label> <input value="$preciopost" type="number" name="precio" required></input></div>
            <div class="volver"><a href="Articulos.php">Volver</a></div>
            <input name ="modificopost"class="añadir__value" type="submit" value="Modificar"></input>
            EOT;
            
            $id = $_POST["id"];
            $categoria = $_POST["categoría"];
            $nombre = $_POST["nombre"];
            $coste = $_POST["coste"];
            $precio = $_POST["precio"];
            
            
            
            
        }else if($_POST['elimino'] == "eliminar"){
            echo <<<EOT
            <p>Se va a eliminar un artículo</p>
            <div class="div__id"><label>ID:</label><input value="$idpost" type="number" required name="id"></input ></div>
            <div class="div__categoria"><label>Categoría:</label><select value="$categoriapost" name="categoría" id="input" required >
            <option ></option>
            <option value="PANTALÓN">PANTALÓN</option>
            <option value="CAMISA">CAMISA</option>
            <option value="JERSEY">JERSEY</option>
            <option value="CHAQUETA">CHAQUETA</option>
            </select></div>
            <div class="div__nombre"><label>Nombre:</label><input value="$nombrepost" type="text" required name="nombre"></input></div>
            <div class="div__coste"><label>Coste:</label><input value="$costepost" type="number" name="coste" required></input></div>
            <div class="div__precio"><label>Precio:</label> <input value="$preciopost" type="number" name="precio" required></input></div>
            <div class="volver"><a href="Articulos.php">Volver</a></div>
            <input name ="eliminopost"class="añadir__value" type="submit" value="Eliminar"></input>
            EOT;
            $id = $_POST["id"];
            $categoria = $_POST["categoría"];
            $nombre = $_POST["nombre"];
            $coste = $_POST["coste"];
            $precio = $_POST["precio"];
            
        }else{
            echo'<p>Se va a añadir un artículo nuevo</p>';
            echo'<div class="div__id"><label>ID:</label><input type="number" required name="id"></input ></div>';
            echo'<div class="div__categoria"><label>Categoría:</label><select name="categoría" id="input" required >';
            echo'<option ></option>';
            echo'<option value="PANTALÓN">PANTALÓN</option>';
            echo'<option value="CAMISA">CAMISA</option>';
            echo'<option value="JERSEY">JERSEY</option>';
            echo'<option value="CHAQUETA">CHAQUETA</option>';
            echo'</select></div>';
            echo'<div class="div__nombre"><label>Nombre:</label><input type="text" required name="nombre"></input></div>';
            echo'<div class="div__coste"><label>Coste:</label><input type="number" name="coste" required></input></div>';
            echo'<div class="div__precio"><label>Precio:</label> <input type="number" name="valor" required></input></div>';
            echo'<div class="volver"><a href="Articulos.php">Volver</a></div>';
            echo'<input name ="agregopost" class="añadir__value" type="submit" value="Añadir"></input>';
            $id = $_POST["id"];
            $categoria = $_POST["categoría"];
            $nombre = $_POST["nombre"];
            $coste = $_POST["coste"];
            $precio = $_POST["valor"];
            
            
        }
        
        ?>
        
        <?php 
        $preciomodificado = $_POST["precio"];
        $procedimiento = "nada";
        $agregopost = $_POST["agregopost"];
        $eliminopost = $_POST["eliminopost"];
        $modificopost = $_POST["modificopost"];
        if($agregopost == "Añadir"){
            
            agregarProducto($id, $categoria, $nombre, $coste, $precio);

        }else if($eliminopost == "Eliminar"){
            
            eliminarProducto($id, $categoria, $nombre, $coste, $precio);

        }else if($modificopost == "Modificar"){
            
            modificarProducto($id, $categoria, $nombre, $coste, $preciomodificado);

        }
        
        ?>
        
        
        
        
        
        




    </form>
    <h4 class="texto__oculto">Se ha creado el producto</h4>
    <h4 class="texto__oculto-modificar">Se ha modificado el producto</h4>
    <h4 class="texto__oculto-borrar">Se ha borrado el producto</h4>
    <button id="volver__oculto"><a href="Articulos.php">Volver</a></button>

</body>
</html>