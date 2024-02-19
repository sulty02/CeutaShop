<?php
    require_once("../Model/Usuario.php");
    require_once("../Model/Negocio.php");

    session_start();

    echo "<a href='../index.php'></a>";
    echo "<div class=contenedor-form>";
    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente"){
        $usuario = Usuario::getUsuarioByID($_SESSION["usuario"]["id"]);
        var_dump($usuario);

        echo "<form action='' method='POST'>
                <
        ";
    }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
        $negocio = Negocio::obtenerNegocioByIDUsuario($_SESSION["usuario"]["id"]);
        var_dump($negocio);

        $usuario = Usuario::getUsuarioByID($_SESSION["usuario"]["id"]);
        var_dump($usuario);

        echo "";
    }
    echo "</div>";
?>