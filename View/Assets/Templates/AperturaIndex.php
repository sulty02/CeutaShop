<?php
/*Jorge Muñoz García*/

    echo "<!DOCTYPE html>
          <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                
            //Si la sesión se ha iniciado con role negocio se carga el CSS negocio.
            if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
                echo "<link rel='stylesheet' href='View/Assets/CSS/IndexNegocio.css'>";
                
            //Con cualquier otra sesión se muestra el CSS de cliente.
            }else if(!isset($_SESSION["usuario"]) || (isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["role"] == "cliente" || $_SESSION["usuario"]["role"] == "invitado"))){
                echo "<link rel='stylesheet' href='View/Assets/CSS/IndexCliente.css'>";
            }
                
            echo "<title>CeutaShop</title>
            </head>
            <body>
            <header>
                <h1>CeutaShop</h1>";

                //Si aún no se ha iniado la sesión con un usuario se muestra el botón iniciar sesión.
                if(!isset($_SESSION["usuario"]) || (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "invitado")){
                    echo "<a class='boton' href='View/LogUsuariosForm.php'>Iniciar sesión</a>";
                
                //Si se ha iniciado la sesión con un usuario con role negocio o cliente se muestra el botón cerrar sesión.
                }else if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["role"] == "negocio" || $_SESSION["usuario"]["role"] == "cliente")){
                    echo "<a class='boton' href='Controller/CerrarSesion.php'>Cerrar sesión</a>";
                    echo "<a class='boton' href='Controller/Reservas.php'>Mis reservas</a>";
                    echo "<a class='boton' href='View/EditarPerfilForm.php'>Editar perfil</a>";
                }
                     
            echo "</header>";
?>
