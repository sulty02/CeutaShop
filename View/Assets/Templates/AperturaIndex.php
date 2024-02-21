<?php
/*Jorge Muñoz García*/
    require_once("Model/Negocio.php");

    echo "<!DOCTYPE html>
          <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='View/Assets/JS/Confirmaciones.js'></script>";
                
            //Si la sesión se ha iniciado con role negocio se carga el CSS negocio.
            if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
                echo "<link rel='stylesheet' href='View/Assets/CSS/IndexNegocio.css'>";
                
            //Con cualquier otra sesión se muestra el CSS de cliente.
            }else if(!isset($_SESSION["usuario"]) || (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente")){
                echo "<link rel='stylesheet' href='View/Assets/CSS/IndexCliente.css'>";
            }
                
            echo "<title>CeutaShop</title>
            </head>
            <body>
            <header>";
            
                if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
                    echo "<h1>CeutaShop - Bienvenido " . Negocio::obtenerNegocioByIDUsuario($_SESSION["usuario"]["id"])["nombre"] . "</h1>";
                }else{
                    echo "<h1>CeutaShop</h1>";
                }
            
                //Si aún no se ha iniado la sesión con un usuario se muestra el botón iniciar sesión.
                if(!isset($_SESSION["usuario"]) || (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "invitado")){
                    echo "<a class='boton' href='View/LogUsuariosForm.php'>Iniciar sesión</a>";
                
                //Si se ha iniciado la sesión con un usuario con role negocio o cliente se muestra el botón cerrar sesión.
                }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente"){
                    echo "<a class='boton' href='javascript:void(0);' onclick='confirmarCerrarSesion()'>Cerrar sesión</a>";
                    echo "<a class='boton' href='Controller/Reservas.php'>Mis reservas</a>";
                    echo "<a class='boton' href='View/EditarPerfilForm.php'>Editar perfil</a>";
                
                //Si se ha iniciado la sesión con un usuario con role negocio se añade el botón añadir producto.
                }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
                    echo "<a class='boton' href='javascript:void(0);' onclick='confirmarCerrarSesion()'>Cerrar sesión</a>";
                    echo "<a class='boton' href='View/InsertarProductoForm.php'>Añadir producto</a>";
                    echo "<a class='boton' href='Controller/Reservas.php'>Mis reservas</a>";
                    echo "<a class='boton' href='View/EditarPerfilForm.php'>Editar perfil</a>";
                }
                     
            echo "</header>";

            echo "<div id='myModal' class='modal'>
                    <div class='modal-content'>
                    <p>¿Estás seguro de que deseas eliminar este producto?</p>
                    <button id='confirmarBtn'>Confirmar</button>
                    <button id='cancelarBtn'>Cancelar</button>
                    </div>
                </div>
                
                <div id='logoutModal' class='modal'>
                    <div class='modal-content'>
                        <p>¿Estás seguro de que deseas cerrar sesión?</p>
                        <button id='confirmarLogoutBtn'>Confirmar</button>
                        <button id='cancelarLogoutBtn'>Cancelar</button>
                    </div>
                </div>
                
                <div id='sesionModal' class='modal'>
                    <div class='modal-content'>
                        <p id='sesionMensaje'></p>
                        <button id='confirmarSesionBtn'>OK</button>
                    </div>
                </div>";
?>
