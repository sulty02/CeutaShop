<?php
    require_once("../Model/Usuario.php");
    require_once("../Model/Negocio.php");

    session_start();

    if(!isset($_SESSION['usuario'])){
        header("Location: ../index.php");
        exit();
    }

    include_once("Assets/Templates/AperturaForm.php");

    echo "<a class='boton' href='../index.php'>Volver</a>";

    if(isset($_GET["ok"])){
        echo "<h2>Se han modificado los datos correctamente</h2>";
    }

    echo "<div class=contenedor-formulario>";

    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente"){
        $usuario = Usuario::getUsuarioByID($_SESSION["usuario"]["id"]);
        $username = $usuario->getUsername();
        $email = $usuario->getEmail();
        $telefono = $usuario->getTelefono();

        echo "<form class='formulario' action='../Controller/EditarPerfiles.php' method='POST'>
                <label>Nombre de usuario: </label>
                <input type='text' name='username' value='$username'>
                
                <p></p>

                <label>Email: </label>
                <input type='email' name='email' value='$email'>
                
                <p></p>

                <label>Télefono: </label>
                <input type='number' max='999999999' name='telefono' value='$telefono'>

                <p></p>

                <input type='submit' name='editarUsuario' value='Editar datos'>
            </form>";
    }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
        $usuario = Usuario::getUsuarioByID($_SESSION["usuario"]["id"]);
        $username = $usuario->getUsername();
        $email = $usuario->getEmail();
        $telefono = $usuario->getTelefono();

        echo "<form class='formulario' action='../Controller/EditarPerfiles.php' method='POST'>
                <label>Nombre de usuario: </label>
                <input type='text' name='username' value='$username'>
                
                <p></p>

                <label>Email: </label>
                <input type='email' name='email' value='$email'>
                
                <p></p>

                <label>Télefono: </label>
                <input type='number' max='999999999' name='telefono' value='$telefono'>

                <p></p>

                <input type='submit' name='editarUsuario' value='Editar datos usuario'>
            </form>";

        $negocio = Negocio::obtenerNegocioByIDUsuario($_SESSION["usuario"]["id"]);
        
        $nombre = $negocio["nombre"];
        $descripcion = $negocio["descripcion"];
        $emailNegocio = $negocio["email"];
        $telefonoNegocio = $negocio["telefono"];
        $calle = $negocio["calle"];
        $horario = $negocio["horario"];  

        echo "<form class='formulario' action='../Controller/EditarPerfiles.php' method='POST'>
                <label>Nombre del negocio: </label>
                <input type='text' name='nombre' value='$nombre'>
                
                <p></p>

                <label>Descripción del negocio: </label>
                <input type='text' name='descripcion' value='$descripcion'>
                
                <p></p>

                <label>Email del negocio: </label>
                <input type='email' name='email' value='$emailNegocio'>
                
                <p></p>

                <label>Télefono del negocio: </label>
                <input type='number' max='999999999' name='telefono' value='$telefonoNegocio'>

                <p></p>

                <label>Calle: </label>
                <input type='text' name='calle' value='$calle'>

                <p></p>

                <label>Horario: </label>
                <textarea rows='5' name='horario'>$horario</textarea>

                <p></p>

                <input type='submit' name='editarNegocio' value='Editar datos negocio'>
            </form>";
    }
    echo "</div>";
?>