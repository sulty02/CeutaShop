<?php
/*Jorge Muñoz García*/

    session_start();

    if(isset($_SESSION['usuario'])){
        header("Location: ../index.php");
        exit();
    }

    include_once("Assets/Templates/AperturaForm.php");

    echo "<a class='boton' href='../index.php'>Volver</a>";

    if(isset($_GET["resultadoRegistro"])){
        switch($_GET["resultadoRegistro"]){
            case 1:
                echo "<h2>Cuenta registrada con éxito.</h2>";
                break;

            case 2:
                echo "<h2>No se ha podido completar el registro.</h2>";
                break;

            case 3:
                echo "<h2>El nombre de usuario ya está registrado. Por favor, elige otro.</h2>";
                break;
        }
    }

    if(isset($_GET["resultadoInicio"])){
        switch($_GET["resultadoInicio"]){
            case 2:
                echo "<h2>La contraseña no es correcta.</h2>";
                break;

            case 3:
                echo "<h2>No se ha encontrado ningún usuario con ese nombre.</h2>";
                break;
        }
    }

    echo "
        <div class='contenedor-formulario'>
            <div class='formulario'>
                <h2>Iniciar sesión</h2>    

                <form action='../Controller/IniciarSesion.php' method='POST'>
                    <label>Nombre de usuario:</label> 
                    <input type='text' name='username'>
                    
                    <p></p>

                    <label>Contraseña:</label>
                    <input type='password' name='password'>
                    
                    <p></p>

                    <input type='submit' name='iniciar'  value='Iniciar'>
                </form>
            </div>

            <div class='formulario'>
                <h2>Registro</h2>

                <form action='../Controller/RegistrarUsuario.php' method='POST'>
                    <label>Nombre de usuario:</label>
                    <input type='text' name='username' required>

                    <p></p>

                    <label>Email:</label> 
                    <input type='text' name='email' required>
                    
                    <p></p>

                    <label>Telefono:</label> 
                    <input type='number' max='999999999' name='telefono' required>
                    
                    <p></p>

                    <label>Contraseña:</label>
                    <input type='password' name='password' required>
                    
                    <p></p>

                    <label>Rol:</label>
                    <p>
                        <label><input type='radio' name='rol' value='cliente'> Cliente</label> 
                        <label><input type='radio' name='rol' value='negocio'> Negocio</label>
                    </p>
                    
                    <p></p>

                    <input type='submit' name='registrar' value='Registrar'>
                </form>
            </div>
        </div>";

include_once("Assets/Templates/Cierre.php");
?>