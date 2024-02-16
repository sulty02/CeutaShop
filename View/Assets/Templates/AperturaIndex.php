<?php
/*Jorge Muñoz García*/

    echo "<!DOCTYPE html>
          <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                
            if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["role"] == "invitado" || $_SESSION["usuario"]["role"] == "cliente")){
                echo "<link rel='stylesheet' href='Views/Assets/CSS/IndexCliente.css'>";
            }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
                echo "<link rel='stylesheet' href='Views/Assets/CSS/IndexNegocio.css'>";
            }
                
            echo "<title>CeutaShop</title>
            </head>
            <body>
            <header>
                <h1>CeutaShop</h1>";

                if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "invitado"){
                    echo "<a class='boton' href='Views/IniciarSesion.php'>Iniciar sesión</a>";
                }else if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["role"] == "negocio" || $_SESSION["usuario"]["role"] == "cliente")){
                    echo "<a class='boton' href='Views/CerrarSesion.php'>Cerrar sesión</a>";
                }
                     
            echo "</header>";
?>
