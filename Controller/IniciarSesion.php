<?php
    if(isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $inicioSesion = Usuario::iniciarSesion($username, $password);
        
        if($inicioSesion == true){
            header("Location: ../index.php");
        }
    }
?>