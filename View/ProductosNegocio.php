<h2>Tus productos: </h2>
<div class="productos-container">
    <?php
        include_once("Model/Producto.php");
        include_once("Model/Negocio.php");

        $idUsuario = $_SESSION["usuario"]["id"];
        //Obtenemos los artículos de la base de datos.
        $productos = Producto::getProductosByIDUsuario($idUsuario);

        if(isset($productos) && count($productos) > 0){
            //Recorremos el array mostrando cada artículo en un div.
            foreach($productos as $producto){
                $idProducto = $producto->getID();
                
                $negocio = Negocio::obtenerNegocioByIDProducto($idProducto);
                $idNegocio = $negocio["id"];
                $nombreNegocio = $negocio["nombre"];

                echo "<div class='producto'>
                        <img src='data:image/jpeg;base64,". base64_encode($producto->getImagen()) . "'/>

                        <div class='producto-info'>
                            <h2>" . $producto->getNombre() . "</h2>
                            <p>" . $producto->getDescripcion() . "</p>
                            <p><strong>" . $producto->getPrecio() . "€</strong></p>
                            <p>Unidades disponibles: " . $producto->getUnidades() . "</p>
                            <p><strong>Tienda: </strong>" . $nombreNegocio . "</p>
                            <a class='boton' href='Controller/EditarProducto.php?id=" . $producto->getID() . "&numOperacion=1'>Editar</a>
                            <a class='boton' href='Controller/EliminarProducto.php?id=" . $producto->getID() . "&numOperacion=2'>Eliminar</a>
                        </div>
                    </div>";
            }
        }else{
            echo "<h2>Aún no hay productos disponibles</h2>";
        }
    ?>
    
</div>