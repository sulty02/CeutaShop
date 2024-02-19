<?php
/*Mohamed Abdeselam*/
    require_once("../Model/Producto.php");

    if(isset($_GET["id"])){
        if(Producto::eliminarProducto($_GET["id"])){
            header("Location: ../index.php");
        }
    }
?>