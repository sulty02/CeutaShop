<div class="productos-container">
    <?php
        include_once("Model/Producto.php");
        
        //Obtenemos los artículos de la base de datos.
        $productos = Producto::getProductos();

        if(count($productos) > 0){
            //Recorremos el array mostrando cada artículo en un div.
            foreach($productos as $producto){
                echo "<div class='producto'>
                        <h2>" . $producto->getNombre() . "</h2>
                        <p>" . $producto->getDescripcion() . "</p>
                        <p>" . $producto->getTipo() . "</p>
                        <p>" . $producto->getCategorias() . "</p>
                        <p>" . $producto->getTalla() . "</p>
                        <p>" . $producto->getTalla() . "</p>
                        <p>" . $producto->getPrecio() . "</p>
                        <img src='". base64_encode($producto->getImagen()) . "'/>
                        <a class='boton' href='Controller/EditarProducto.php?id=" . $producto->getID() . "&numOperacion=1'>Editar</a>
                        <a class='boton' href='Controller/EliminarProducto.php?id=" . $producto->getID() . "&numOperacion=2'>Eliminar</a>
                    </div>";
            }
        }else{
            echo "<h2>Aún no hay productos disponibles</h2>";
        }
    ?>
</div>