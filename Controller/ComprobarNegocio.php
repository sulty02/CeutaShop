<?php
    include_once("Model/CeutaShopDB.php");

    function verificarNegocio(){
        $idUsuario = $_SESSION["usuario"]["id"];

        $conexion = CeutaShopDB::conectarDB();

        //Consulta para comprobar si existe.
        $consultaNegocio = $conexion->prepare("SELECT * FROM negocio WHERE idUsuario = :idUsuario");
        $consultaNegocio->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $consultaNegocio->execute();

        //Si se ha encontrado el negocio, se devuelve true. De lo contrario se devuelve false.
        return $consultaNegocio->rowCount() > 0;
    }
?>