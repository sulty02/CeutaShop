<?php
/*Jorge Muñoz García y Mohamed Abdeselam*/

    include_once(__DIR__ . "/Model/Producto.php");
    include_once(__DIR__ . "/Model/Negocio.php");

    session_start();

    include_once("View/Assets/Templates/AperturaIndex.php");

    //Se incluye para comprobar si el role de la sesión es negocio y el negocio existe o no.
    include_once("Controller/ComprobarNegocio.php");
    
    //Si se ha iniciado la sesión con role negocio:
    if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "negocio"){
        //Si el negocio existe se muestra la vista de los productos del negocio.
        if(verificarNegocio() == true){
            include_once("View/ProductosNegocio.php");

        //Si no existe el negocio se muestra la vista del formulario para crear el negocio.
        }else{
            include_once("View/CrearNegocioForm.php");
        }
        
    //Si el usuario es invitado o la sesión no está iniciada se muestran los productos.
    }else if(!isset($_SESSION["usuario"]) || (isset($_SESSION["usuario"]) && ($_SESSION["usuario"]["role"] == "invitado"))){
        echo "<div class='buscador'>
                <input type='text' placeholder='Buscar productos...' id='search' name='search' oninput='cargarProductos()'>
            </div>";

        include_once("View/Productos.php");

    //Si el usuario es cliente se muestran los productos y el carrito.
    }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente"){
        echo "<div class='buscador'>
                <input type='text' placeholder='Buscar productos...' id='search' name='search' oninput='cargarProductos()'>
            </div>";

        include_once("View/Productos.php");
        //include_once("View/CarritoTabla.php");
        //include_once("View/Carrito.php");
    }

    include_once("View/Assets/Templates/Cierre.php");
?>