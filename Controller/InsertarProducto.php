<?php
/*Mohamed Abdeselam*/
    require_once("../Model/Producto.php");
    require_once("../Model/Negocio.php");

    session_start();

    $idUsuario = $_SESSION["usuario"]["id"];
    $idNegocio = Negocio::obtenerNegocioByIDUsuario($idUsuario)["id"];

    if(isset($_POST["insertar"])){
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $tipo = $_POST["tipo"];
        $categorias = $_POST["categorias"];
        $talla = $_POST["talla"];
        $precio = $_POST["precio"];
        $unidades = $_POST["unidades"];
        
        $producto = new Producto($nombre, $descripcion, $tipo, $categorias, $talla, $precio, $unidades, $imagen='', $id='', $idNegocio);

        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            
            if($check !== false){
                $image = $_FILES['imagen']['tmp_name'];
                $imgContent = file_get_contents($image);

                //Se añade el contenido de la imagen al producto.
                $producto->setImagen($imgContent);
            }
        }

        
        if(Producto::insertarProducto($producto)){
            header("Location: ../View/InsertarProductoForm.php?ok=ok");
        }
    }
?>