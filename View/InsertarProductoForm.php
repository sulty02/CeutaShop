<?php
/*Mohamed Abdeselam*/
    include_once("Assets/Templates/AperturaForm.php");

    echo "<a class='boton' href='../index.php'>Volver</a>";

    if(isset($_GET["ok"]) && $_GET["ok"] == "ok"){
        echo "<h2>Se ha añadido el producto con éxito.</h2>";
    }

        echo "<div class=contenedor-formulario>";

        echo "
            <form class='formulario' action='../Controller/InsertarProducto.php' enctype='multipart/form-data' method='POST'>
                <label>Nombre: </label>
                <input type='text' name='nombre' required>

                <p></p>

                <label>Descripción: </label>
                <input type='text' name='descripcion' required>

                <p></p>

                <label>Tipo: </label>
                <input type='text' name='tipo' required>

                <p></p>

                <label>Categorías: Sepáralas con ', '</label>
                <input type='text' name='categorias' required>

                <p></p>

                <label>Talla: </label>
                <input type='text' name='talla' required>

                <p></p>

                <label>Precio: </label>
                <input type='number' step='0.01' name='precio' required>
                
                <p></p>

                <label>Unidades: </label>
                <input type='number' name='unidades' required>

                <p></p>

                <label>Imagen: </label>
                <input type='file' name='imagen' required>

                <p></p>

                <input type='submit' name='insertar' value='Añadir producto'>
            </form>
        ";
    echo "</div>";
?>