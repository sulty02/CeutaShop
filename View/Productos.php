<div class="articulos-container">
    <?php
        include_once("Model/Producto.php");
        //Obtenemos los artículos de la base de datos.
        $productos = Producto::getProductos();

        if(count($productos) > 0){
            //Recorremos el array mostrando cada artículo en un div.
            foreach($productos as $producto){
                echo "<div class='articulo'>
                        <h2>" . $producto->getTitulo() . "</h2>
                        <p>" . $producto->getContenido() . "</p>
                        <p class='fecha'>" . $producto->getFecha() . "</p>
                        <a class='eliminar' href='Controller/Controller.php?id=" . $articulo->getID() . "&numOperacion=2'>Eliminar artículo</a>
                    </div>";
            }
        }else{
            echo "<h2>Aún no hay productos disponibles</h2>";
        }
    ?>
</div>