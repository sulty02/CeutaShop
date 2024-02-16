<div class="productos-container">
    <?php
        //Obtenemos los artículos de la base de datos.
        $productos = Producto::getProductos();

        //Recorremos el array mostrando cada artículo en un div.
        foreach($productos as $producto){
            echo "<div class='producto'>
                    <h2>" . $producto->getTitulo() . "</h2>
                    <p>" . $producto->getContenido() . "</p>
                    <p class='fecha'>" . $producto->getFecha() . "</p>
                    <a class='eliminar' href='Controller/Controller.php?id=" . $articulo->getID() . "&numOperacion=2'>Eliminar artículo</a>
                </div>";
        }
    ?>
</div>