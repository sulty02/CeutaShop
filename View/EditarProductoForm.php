<?php
/*Mohamed Abdeselam*/
  require_once("../Model/Producto.php");
  require_once("../Model/Negocio.php");
  include_once("Assets/Templates/AperturaForm.php");

  echo "<a class='boton' href='../index.php'>Volver</a>";

  if(isset($_GET["ok"]) && $_GET["ok"] == "ok"){
    echo "<h2>Se ha actualizado el producto con éxito.</h2>";
  }

  if(isset($_GET["id"])){
    $idProducto = $_GET["id"];
    
    $producto = Producto::getProductoByID($idProducto);
    $nombre = $producto->getNombre();
    $descripcion = $producto->getDescripcion();
    $tipo = $producto->getTipo();
    $categorias = $producto->getCategorias();
    $talla = $producto->getTalla(); 
    $precio = $producto->getPrecio();
    $unidades = $producto->getUnidades();
    $imagen = $producto->getImagen();

    echo "<div class=contenedor-formulario>
        <form class='formulario' action='../Controller/EditarProducto.php' enctype='multipart/form-data' method='POST'>
          <label>Nombre: </label>
          <input type='text' name='nombre' value='$nombre' required>

          <p></p>

          <label>Descripción: </label>
          <input type='text' name='descripcion' value='$descripcion' required>

          <p></p>

          <label>Tipo: </label>
          <input type='text' name='tipo' value='$tipo' required>

          <p></p>

          <label>Categorías: Sepáralas con ', '</label>
          <input type='text' name='categorias' value='$categorias' required>

          <p></p>

          <label>Talla: </label>
          <input type='text' name='talla' value='$talla' required>

          <p></p>

          <label>Precio: </label>
          <input type='number' step='0.01' name='precio' value='$precio' required>
          
          <p></p>

          <label>Unidades: </label>
          <input type='number' name='unidades' value='$unidades' required>

          <p></p>

          <input type='text' name='id' value='$idProducto' hidden>

          <label>Imagen: </label>
          <input type='file' name='imagen'>

          <p></p>

          <input type='submit' name='editar' value='Añadir producto'>
        </form>";

    echo "</div>";
  }
?>