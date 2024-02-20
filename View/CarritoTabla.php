<?php


include_once("Model/Carrito.php");
include_once("Model/CeutaShopDB.php");

        // //Nos conectamos a la base de datos
          $conexionDB = new mysqli('localHost', 'root','', 'ceutashop');

        // // //creamos la consulta
          $consulta="SELECT * FROM producto";

        //  //conectamos la consulta con la base de datos
          $resultadoConsulta=mysqli_query($conexionDB,$consulta);
          $nombreUsuario=$_SESSION['usuario']['username'];
        
        // // //visualizamos los valores de la cookie
          while($elemento=mysqli_fetch_array($resultadoConsulta,MYSQLI_ASSOC)){
            if(isset($_COOKIE[$nombreUsuario.$elemento['id']])){
                   
              echo "<div class='cookie'>";
                // Cuando sea necesario, deserializar la cadena de texto de la cookie para obtener el array de vuelta
                $valoresCookie = unserialize($_COOKIE[$nombreUsuario.$elemento['id']]);
                echo '<img src="data:image/jpg;base64,'.base64_encode( $elemento['imagen']  ).'"/>';

                // Ahora puedes utilizar el array de valores de la cookie
                foreach ($valoresCookie as $indice=> $valor) {
                  echo" $indice:$valor <br>"; 
                }
                echo "<a href=?>Eliminar</a>";
              echo "</div>";
            }
          }
?>