<div class="productos-container">
    <?php
        include_once("Model/Producto.php");
        //Obtenemos los artículos de la base de datos.
        $productos = Producto::getProductos();

        if(isset($productos) && count($productos) > 0){
            //Recorremos el array mostrando cada artículo en un div.
            foreach($productos as $producto){
                echo "<div class='producto'>
                        <h2>" . $producto->getNombre() . "</h2>
                        <img src='data:image/jpeg;base64,". base64_encode($producto->getImagen()) . "'/>
                        <p>" . $producto->getDescripcion() . "</p>
                        <p><strong>" . $producto->getPrecio() . "€</strong></p>
                        <a class='boton' href='Controller/Carrito.php?id=" . $producto->getID() . "&numOperacion=1'>Añadir al carrito</a>
                    </div>";
            }
        }else{
            echo "<h2>Aún no hay productos disponibles</h2>";
        }
    ?>
</div>