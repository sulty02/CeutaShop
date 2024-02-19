<?php
/*Jorge Muñoz García*/

    echo "<div class='formulario-container'>
            <form class='formulario' action='Controller/CrearNegocio.php' method='POST'>
                <label>Nombre:</label>
                <input type='text' name='nombre'>
                
                <p></p>
                
                <label>Descripción:</label>
                <input type='text' name='descripcion'>
                
                <p></p>
                
                <label>Email:</label>
                <input type='text' name='email'>
                
                <p></p>
                
                <label>Teléfono:</label>
                <input type='text' name='telefono'>
                
                <p></p>
                
                <label>Calle:</label>
                <input type='text' name='calle'>
                
                <p></p>
                
                <label>Horario:</label>
                <input type='text' name='horario'>
                
                <p></p>

                <input type='submit' name='crear' value='Crear negocio'>
            </form>
        </div>";
?>