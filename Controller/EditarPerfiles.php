<?php
    require_once("../Model/Usuario.php");
    require_once("../Model/Negocio.php");

    session_start();

    if(isset($_POST["editarUsuario"])){
        $idUsuario = $_SESSION["usuario"]["id"];
        $nuevoUsername = $_POST["username"];
        $nuevoEmail = $_POST["email"];
        $nuevoTelefono = $_POST["telefono"];

        Usuario::updateUsuario($idUsuario, $nuevoUsername, $nuevoEmail, $nuevoTelefono);

        header("Location: ../View/EditarPerfilForm.php?ok=ok");
    }else if(isset($_POST["editarNegocio"])){
        $idUsuario = $_SESSION["usuario"]["id"];
        $nuevoNombre = $_POST["nombre"];
        $nuevaDescripcion = $_POST["descripcion"];
        $nuevoEmail = $_POST["email"];
        $nuevoTelefono = $_POST["telefono"];
        $nuevaCalle = $_POST["calle"];
        $nuevoHorario = $_POST["horario"];

        Negocio::updateNegocio($idUsuario, $nuevoNombre, $nuevaDescripcion, $nuevoEmail, $nuevoTelefono, $nuevaCalle, $nuevoHorario);
        
        header("Location: ../View/EditarPerfilForm.php?ok=ok");
    }