<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./estilosUsuarios.css">
    <title>Usuarios.php</title>
</head>
<body>
    <?php include "BaseDatos.php";?>
    <div class="div__crear"><a href="formUsuarios.php">Crear nuevo Usuario</a></div>
    <table>

    <thead>
            <tr>
                <form method="post" action="Usuarios.php">
                    <th scope="col"><button value="UserID" name="id" type="submit">ID</button></th>
                    <th scope="col"><button value="FullName" name="nombre" type="submit">Nombre</button></th>
                    <th scope="col"><button value="Email" name="gmail" type="submit">Email</button></th>
                    <th scope="col"><button value="LastAccess" name="ultimoacceso" type="submit">Último Acceso</button></th>
                    <th scope="col"><button value="Enabled" name="autorizado" type="submit">Enabled</button></th>
                    <th colspan="2" scope="col"><label class="label__manejo" value="Editar" name="editar" type="text" >Manejo</label></th>
                    
                    
                    
                </form>
                
                <?php 
                error_reporting(0);
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $gmail = $_POST['gmail'];
                $ultimoacceso = $_POST['ultimoacceso'];
                $autorizado = $_POST['autorizado'];
                
                
                
                ?>
            
            


            </tr>
        </thead>
        
            <?php 
            
           
            
            $query = mostrarUsuarios($id, $nombre, $gmail, $ultimoacceso, $autorizado);
                 
        
            
           
            foreach ($query as $fila){?>
        <tbody> 
            
                <tr>
                    
                    
                    <td><?php echo $fila['UserID']; ?></td>
                
                    
                    <td><?php  
                   
                    if ($fila['FullName'] == 3){
                        echo "PANTALÓN";
                        $categoriaPrenda = "PANTALÓN";

                    }else{
                        echo $fila['FullName'];
                    }
                    
                    
                    
                    ?></td>
                    <td><?php echo $fila['Email']; ?></td>
                    <td><?php echo $fila['LastAccess']; ?></td>
                    <td><?php echo $fila['Enabled']; ?></td>
                
                <?php 
                        
                        $superadministrador = false;

                        $informacion1 = $fila['UserID'];
                        $informacion2 = $fila['FullName'];
                        $informacion3 = $fila['Email'];
                        $informacion4 = $fila['LastAccess'];
                        $informacion5 = $fila['Enabled'];
                        $valor = 3;
                        
                        
                        
                    
                        
                        if($fila['UserID'] !=$valor){
                            
                            
                            echo <<<EOT

                            <script src="https://kit.fontawesome.com/62ea397d3a.js" crossorigin="anonymous"></script>
                            <form class="manejoform" method="post" action="formUsuarios.php">
                            <td><button  type="submit" name = "modifico" value="modificar" class="icono fas fa-pencil-alt"></button></<td>
                            <td><button type="submit" name = "elimino"   value="eliminar"  class="icono fas fa-times"></button></<td>
                            <input type="text" name = "infoutil1"  class="infodetallada" value="$informacion1"></input>
                            <input type="text" name = "infoutil2"  class="infodetallada" value="$informacion2"></input>
                            <input type="text" name = "infoutil3"  class="infodetallada" value="$informacion3"></input>
                            <input type="text" name = "infoutil4"  class="infodetallada" value="$informacion4"></input>
                            <input type="text" name = "infoutil5"  class="infodetallada" value="$informacion5"></input>
                            </form> 
                            EOT;

                        }else{
                            echo <<<EOT

                            <script src="https://kit.fontawesome.com/62ea397d3a.js" crossorigin="anonymous"></script>
                            <form class="manejoform" method="post" action="formUsuarios.php">
                            <td><label  name = "modifico" class="icono fas fa-pencil-alt"></label></<td>
                            <td><label  name = "elimino" class="icono fas fa-times"></label></<td>
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
          
    

    
    

</body>
</html>