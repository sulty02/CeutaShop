<?php
/*Jorge Muñoz García*/
    
    include_once("../Model/Usuario.php");

    if(isset($_POST["registrar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $password = $_POST["password"];
        $role = $_POST["rol"];

        $usuario = new Usuario($username, $email, $telefono, $password, $role);
        $resultado = Usuario::registrarUsuario($usuario);
        
        header("Location: ../View/LogUsuariosForm.php?resultadoRegistro=$resultado");
    }
?>