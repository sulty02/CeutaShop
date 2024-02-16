<?php
    echo "<form action='Controller/CrearNegocio.php' method='POST'>
            <label>Nombre: <input type='text' name='nombre'></label>
            
            <p></p>
            
            <label>Descripción: <input type='text' name='descripcion'></label>
            
            <p></p>
            
            <label>Email: <input type='text' name='email'></label>
            
            <p></p>
            
            <label>Teléfono: <input type='text' name='telefono'></label>
            
            <p></p>
            
            <label>Calle: <input type='text' name='calle'></label>
            
            <p></p>
            
            <label>Horario: <input type='text' name='horario'></label>
            
            <p></p>

            <input type='submit' name='crear' value='Crear negocio'>
        </form>";
?>