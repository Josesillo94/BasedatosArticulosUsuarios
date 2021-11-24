<?php
    function crearConexion(){
        // Datos de Conexión
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "pac3_daw";

        //Establecemos la conexion con la base de datos
        $conexion = mysqli_connect($host, $user, $password, $database);

        //Si hay un error en la conexión, lo mostramos y detenemos.
        
        if(!$conexion){
            die("<br>Error de conexión con la abse de datos: " . mysqli_connect_error());

        }
        //Si está todo correcto, enviamos la conexión con la base de datos.
        else{
            // echo"<br>Conexion correcta a la base de datos:" . $database;
        }
        return $conexion;
    }

    function comprobarUsuario($usuario, $gmail){
     //Comprobamos el usuario en la base de datos, si esta registrado lo dejamos continuar
        $query = mysqli_query(crearConexion(), "SELECT * FROM USER WHERE Email = '$gmail' AND FullName = '$usuario'");
        $result = mysqli_fetch_assoc($query);
        
        if (isset($result)){

            $id = $result['UserID'];
            $_SESSION['usuario'] = $id;
            echo "<p>Bienvenido $usuario, pulsa <a href='acceso.php'>AQUÍ</a> para continuar</p>";
            $fecha = date("y-m-d");
            $query2 = mysqli_query(crearConexion(), "UPDATE user SET LastAccess ='$fecha' WHERE UserID = $id");

        }else if($usuario == "" || $gmail == ""){
            
        }else{
            echo("<br>El usuario introducido no es correcto");
        }

    }
    function localizarAdmin(){
 // Localizamos al superadmin para que muestre Usuarios
        session_start();
        $id = sprintf($_SESSION["usuario"]);
        $query = mysqli_query(crearConexion(), 'SELECT * FROM setup SuperAdmin');

        
        
        $result = mysqli_fetch_assoc($query);
        
        if ( $result['SuperAdmin'] == $id){

            echo '<div class="div__interno"><a href= "Usuarios.php">Usuarios<a/></div>';
            

        }else{ 
        }
    }
    function localizarAdministrador($superadministrador){

        
        $id = sprintf($_SESSION["usuario"]);
        
        $query = mysqli_query(crearConexion(), 'SELECT * FROM setup SuperAdmin');
        

        
        
        $result = mysqli_fetch_assoc($query);
        
        
        if ( $result['SuperAdmin'] == $id){
            
            $superadministrador = true;
            return $superadministrador;
            

        }else{ 
        }
    }
    
    
    
    function mostrarTabla($numElementos, $id, $categoria, $nombre, $coste, $precio){
            // Ejecutamos una query que muestra la tabla de articulos
        $ordenar = "ProductID";

        if(isset($categoria)){
            $ordenar = $categoria;
        }elseif(isset($nombre)){
            $ordenar = $nombre;
        }elseif(isset($coste)){
            $ordenar = $coste;
        }elseif(isset($precio)){
            $ordenar = $precio;
        }

        
        $sql = "SELECT * FROM product WHERE ProductID <= 90 ORDER BY $ordenar ASC  ";
        $query = mysqli_query(crearConexion(), $sql);
        
        
        
        
        
        return $query;
            
        
        

    }
    function agregarProducto($id, $categoria, $nombre, $coste, $precio){
       //Ejecutamos una query que agrega un nuevo producto
        
        $valor = $id;
        
        
        $query = mysqli_query(crearConexion(), "SELECT * FROM product WHERE ProductID LIKE $valor");
        $result = mysqli_fetch_assoc($query);  
        if(isset($result)){
            echo "<br> Coincide un Valor";
        }else{

            switch($categoria){
                case "PANTALÓN":
                    $categoria = 1;
                    break;
                case "CAMISA":
                    $categoria = 2;
                    break; 
                case "JERSEY":
                    $categoria = 3;
                    break; 
                case "CHAQUETA":
                    $categoria = 4;
                    break;  
            }
            $query2 = mysqli_query(crearConexion(), "INSERT INTO product (ProductID, Name, Cost, Price, CategoryID) VALUES('$id', '$nombre', '$coste', '$precio', '$categoria');");
            echo '<link href="./ocultarForm.css" type="text/css" rel="stylesheet">';
            
            
        }

    }
    function modificarProducto($id, $categoria, $nombre, $coste, $precio){
       
        //Ejecutamos una query que modifica un articulo ya existente
        
        switch($categoria){
            case "PANTALÓN":
                $categoria = 1;
                break;
            case "CAMISA":
                $categoria = 2;
                break; 
            case "JERSEY":
                $categoria = 3;
                break; 
            case "CHAQUETA":
                $categoria = 4;
                break;  
        }
        session_start();
        $idpost = $_SESSION['postinfo1'];
        
        
        $query = mysqli_query(crearConexion(), "UPDATE product SET ProductID = '$id' WHERE ProductID = '$idpost'");
        
        $query1 = mysqli_query(crearConexion(), "UPDATE product SET CategoryID = '$categoria' WHERE ProductID = '$id'");
        
        $query2 = mysqli_query(crearConexion(), "UPDATE product SET Name = '$nombre' WHERE ProductID = '$id'");
        
        $query3 = mysqli_query(crearConexion(), "UPDATE product SET Cost = '$coste' WHERE ProductID = '$id'");
        
        $query4 = mysqli_query(crearConexion(), "UPDATE product SET Price = '$precio' WHERE ProductID = '$id'");
        echo '<link href="./ocultarFormmodificar.css" type="text/css" rel="stylesheet">';
        
        
        
            
            
        

    }
    function eliminarProducto($id, $categoria, $nombre, $coste, $precio){
       //Ejecutamos una query que elimina un producto
        
        $valor = (int)$id;

        $query = mysqli_query(crearConexion(), "DELETE FROM product WHERE ProductID =  '$valor'");
        echo '<link href="./ocultarFormeliminar.css" type="text/css" rel="stylesheet">';
        
        
        
        
            
            
        

    }
    function personalAutorizado($autorizado){
        // Ejecutamos una query que nos indica si el usuario esta autorizado o no
        session_start();
        $id = $_SESSION['usuario'];
        $query = mysqli_query(crearConexion(), "SELECT UserID FROM user WHERE Enabled LIKE 1");
        $result = mysqli_fetch_assoc($query);
        if(isset($result)){
            
        $coincidencia = $result['UserID']; 
        
        if($coincidencia == $id){
            $autorizado = true;
            return $autorizado;
            
        }else{
            
        }
        }
        

    }
    function mostrarUsuarios($id, $nombre, $gmail, $ultimoacceso, $autorizado){
        //Ejecutamos unas querys que muestran todos los usuarios ordenados de diferente forma
        session_start();
        $ordenar = "UserID";
    
        if(isset($id)){
            $ordenar = $id;
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }elseif(isset($nombre)){
            $ordenar = $nombre;
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }elseif(isset($gmail)){
            $ordenar = $gmail;
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }elseif(isset($ultimoacceso)){
            $ordenar = $ultimoacceso;
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }elseif(isset($autorizado)){
            $ordenar = $autorizado;
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }else{
            $query = mysqli_query(crearConexion(), "SELECT * FROM user ORDER BY `{$ordenar}` ASC");
        }
        
        
        return $query;
    }
    function agregarUsuario($idpost, $nombrepost, $gmailpost, $ultimoaccesopost, $autorizadopost){
        //Ejecutamos una query que agrega un usuario cuando su id no esta en uso
        
        $query = mysqli_query(crearConexion(), "SELECT * FROM user WHERE UserID LIKE $idpost");
        $result = mysqli_fetch_assoc($query);  
        var_dump($result);
        if(isset($result)){
            echo "<br> Coincide un Valor";
        }else{

            $query2 = mysqli_query(crearConexion(), "INSERT INTO user (UserID, FullName, Email, LastAccess, Enabled) VALUES('$idpost', '$nombrepost', '$gmailpost', '$ultimoaccesopost', '$autorizadopost');");
            echo '<link href="./ocultarForm.css" type="text/css" rel="stylesheet">';
            
            
            
        }
    }
    function eliminarUsuario($id){
        //Ejecutamos una query que elimina a un usuario
        $query = mysqli_query(crearConexion(), "DELETE FROM user WHERE UserID =  '$id'");
        echo '<link href="./ocultarFormeliminar.css" type="text/css" rel="stylesheet">';

    }
    function modificarUsuario($idpostt, $nombrepost, $gmailpost, $ultimoaccesopost, $autorizadopost){
       //Ejecutamos una query que modifica los valores de un usuario ya existente
        
        session_start();
        $valoriduser= $_SESSION['postinfo2'];
        
        
        
        $query = mysqli_query(crearConexion(), "UPDATE user SET UserID = '$idpostt' WHERE UserID = '$valoriduser'");
        
        $query1 = mysqli_query(crearConexion(), "UPDATE user SET FullName = '$nombrepost' WHERE UserID = '$valoriduser'");
        
        $query2 = mysqli_query(crearConexion(), "UPDATE user SET Email = '$gmailpost' WHERE UserID = '$valoriduser'");
        
        $query3 = mysqli_query(crearConexion(), "UPDATE user SET LastAccess = '$ultimoaccesopost' WHERE UserID = '$valoriduser'");
        
        $query4 = mysqli_query(crearConexion(), "UPDATE user SET Enabled = '$autorizadopost' WHERE UserID = '$valoriduser'");
        echo '<link href="./ocultarFormmodificar.css" type="text/css" rel="stylesheet">';
        
        
        
            
            
        

    }
    
    
    
    


    

?>