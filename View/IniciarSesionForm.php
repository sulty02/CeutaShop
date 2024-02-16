<?php
    echo "<form action='../Controller/IniciarSesion.php' method='POST'>
            <label>Nombre de usuario: <input type='text' name='username'></label>
            
            <p></p>

            <label>Contraseña: <input type='text' name='password'></label>
            
            <p></p>

            <input type='submit' name='iniciar'>
        </form>";

    echo "<form action='' method='POST'>
            <label>Nombre de usuario: <input type='text' name='username'></label>
            
            <p></p>

            <label>Email: <input type='text' name='email'></label>
            
            <p></p>

            <label>Telefono: <input type='number' max='999999999' name='telefono'></label>
            
            <p></p>

            <label>Contraseña: <input type='text' name='password'></label>
            
            <p></p>

            <label>Rol:</label>
            <label><input type='radio' name='rol' value='cliente'> Cliente</label>
            <label><input type='radio' name='rol' value='negocio'> Negocio</label>
            
            <p></p>

            <input type='submit' name='registrar'>
        </form>";
?>