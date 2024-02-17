<?php
    if(isset($_POST["crear"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $calle = $_POST["calle"];
        $horario = $_POST["horario"];
        $idUsuario = $_SESSION["username"]["id"];

        $negocio = new Negocio($nombre, $descripcion, $email, $telefono, $calle, $horario, $idUsuario);

        if(Negocio::registrarNegocio($negocio) == true){
            header("Location: ../index.php");
        }else{
            echo "<h2>" . Negocio::registrarNegocio($negocio) . "</h2>";
        }
    }
?>