<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosArticulos.css">
    <title>Articulos.php</title>
</head>
<body>
    <?php require "BaseDatos.php";
    
    

    ?>
    <div class="div">
        
        <?php
            // Localizo si el usuario es autorizado o superadmin para mostrar crear nuevo producto
            $autorizado = false; 
            $autorizado = personalAutorizado($autorizado);
            $superadministrador = false;
            $superadministrador = localizarAdministrador($superadministrador);
            if($autorizado == true || $superadministrador== true ){
                echo '<div class="div__crear"><a href="formArticulos.php">Crear nuevo producto</a></div>';
            }
        
        ?>
    <table>
        <thead>
            <tr>
                <form method="post" action="Articulos.php">
                    <th scope="col"><button value="ProductID" name="id" type="submit">ID</button></th>
                    <th scope="col"><button value="CategoryID" name="categoria" type="submit">Categoría</button></th>
                    <th scope="col"><button value="Name" name="nombre" type="submit">Nombre</button></th>
                    <th scope="col"><button value="Cost" name="coste" type="submit">Coste</button></th>
                    <th scope="col"><button value="Price" name="precio" type="submit">Precio</button></th>
                    <?php 
                    
                    $superadministrador = false;

                    
                    
                    if(localizarAdministrador($superadministrador) == true){
                       //Si el usuario es superadmin muestro manejo
                        echo '<th colspan="2" scope="col"><label class"label__manejo" value="Editar" name="editar" type="text" >Manejo</label></th>';

                    }?>
                    
                    
                </form>
                
                <?php 
                error_reporting(0);
                $id = $_POST['id'];
                $categoria = $_POST['categoria'];
                $nombre = $_POST['nombre'];
                $coste = $_POST['coste'];
                $precio = $_POST['precio'];
                
                
                ?>
            
            


            </tr>
        </thead>
        
            <?php 
            
            
 
            $numElementos = 10;
            
            // Pasamos los valores a mostrar tabla y lo mandamos a BaseDatos.php y traemos la tabla
            
            $query = mostrarTabla($numElementos, $id, $categoria, $nombre, $coste, $precio);
            
            
                    
        
            
           //Mostramos la tabla
            foreach ($query as $fila){?>
        <tbody> 
            
                <tr>
                    
                    
                    <td><?php echo $fila['ProductID']; ?></td>
                
                    
                    <td><?php  
                    $categoriaPrenda = "";
                    if ($fila['CategoryID'] ==1){
                        echo "PANTALÓN";
                        $categoriaPrenda = "PANTALÓN";

                    }else if($fila['CategoryID'] ==2){
                        echo "CAMISA";
                        $categoriaPrenda = "CAMISA";

                    }else if ($fila['CategoryID'] ==3){
                        echo "JERSEY";
                        $categoriaPrenda = "JERSEY";

                    }else{
                        echo "CHAQUETA";
                        $categoriaPrenda = "CHAQUETA";

                    }
                    
                    
                    
                    ?></td>
                    <td><?php echo $fila['Name']; ?></td>
                    <td><?php echo $fila['Cost']; ?></td>
                    <td><?php echo $fila['Price']; ?></td>
                
                <?php 
                        
                        $superadministrador = false;

                        $informacion1 = $fila['ProductID'];
                        $informacion2 = $categoriaPrenda;
                        $informacion3 = $fila['Name'];
                        $informacion4 = $fila['Cost'];
                        $informacion5 = $fila['Price'];
                        
                        
                        
                        
                    
                        
                        if(localizarAdministrador($superadministrador) == true){

                            //Si el usuario es superadmin pongo un formulario que guarda la info de cada producto y la muestra al darle a
                            // Modificar o eliminar
                            echo <<<EOT

                            <script src="https://kit.fontawesome.com/62ea397d3a.js" crossorigin="anonymous"></script>
                            <form class="manejoform" method="post" action="formArticulos.php">
                            <td><button  type="submit" name = "modifico" value="modificar" class="icono fas fa-pencil-alt"></button></<td>
                            <td><button type="submit" name = "elimino"   value="eliminar"  class="icono fas fa-times"></button></<td>
                            <input type="text" name = "infoutil1"  class="infodetallada" value="$informacion1"></input>
                            <input type="text" name = "infoutil2"  class="infodetallada" value="$informacion2"></input>
                            <input type="text" name = "infoutil3"  class="infodetallada" value="$informacion3"></input>
                            <input type="text" name = "infoutil4"  class="infodetallada" value="$informacion4"></input>
                            <input type="text" name = "infoutil5"  class="infodetallada" value="$informacion5"></input>
                            </form> 
                            EOT;

                        }
                        
                    }?>
                </tr>
            <br>

            

        </tbody>
    </table>
    <form>
        <button class="desplazador__izd"><<<</button>
        <button class="desplazador_dch">>>></button>

    </form>
     
          
    
    
 
    
       
    
        
        
        
        


    
    
    </div>

</body>
</html>