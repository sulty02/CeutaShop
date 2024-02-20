<?php
    include_once(__DIR__ . "/../Model/Producto.php");
    include_once(__DIR__ . "/../Model/Negocio.php");

    //Obtener el término de búsqueda desde la solicitud AJAX.
    $terminoBusqueda = isset($_GET['search']) ? trim($_GET['search']) : '';

    $output = "";
    
    $productos = Producto::buscarProductos($terminoBusqueda);

    echo "<div class='productos-container' id='productos-container' hidden>";

    if (isset($productos) && count($productos) > 0) {
        foreach ($productos as $producto) {
            $idProducto = $producto->getID();

            $negocio = Negocio::obtenerNegocioByIDProducto($idProducto);
            $idNegocio = $negocio["id"];
            $nombreNegocio = $negocio["nombre"];

            $output .= "<div class='producto'>
                    <img src='data:image/jpeg;base64," . base64_encode($producto->getImagen()) . "'/>
                    <div class='producto-info'>
                        <h2>" . $producto->getNombre() . "</h2>
                        <p>" . $producto->getDescripcion() . "</p>
                        <p><strong>" . $producto->getPrecio() . "€</strong></p>
                        <p><strong>Tienda: </strong>" . $nombreNegocio . "</p>
                        <p>Unidades disponibles: " . $producto->getUnidades() . "</p>
                        <a class='boton' onclick='comprobarSesion($idProducto, $idNegocio, " . $producto->getUnidades() . ")'>Añadir al carrito</a>
                    </div>
                </div>";
        }
    } else {
        $output = "<h2>No se encontraron productos con el término de búsqueda: $terminoBusqueda</h2>";
    }

    if(isset($output)){
        echo $output;
    }    

    echo "</div>";
?>
