<?php
    include_once("../Model/Usuario.php");

    if(isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $inicioSesion = Usuario::iniciarSesion($username, $password);
        
        if($inicioSesion == 1){
            header("Location: ../index.php");
        }else{
            header("Location: ../View/LogUsuariosForm.php?resultadoInicio=$inicioSesion");
        }
    }
?>