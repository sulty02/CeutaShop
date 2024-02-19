<h2>Tus productos: </h2>
<div class="productos-container">
    <?php
    /*Jorge Muñoz García y Mohamed Abdeselam*/
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
                            <p><strong>Tienda: </strong>" . $nombreNegocio . "</p>
                            <p>Unidades disponibles: " . $producto->getUnidades() . "</p>
                            <a class='boton' href='View/EditarProductoForm.php?id=" . $producto->getID() . "'>Editar</a>
                            <a class='boton' onclick='confirmarEliminarProducto(" . $producto->getID() . ")'>Eliminar</a>
                        </div>
                    </div>";
            }
        }else{
            echo "<h2>Aún no hay productos disponibles</h2>";
        }
    ?>
</div>