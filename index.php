<?php
/*Jorge Muñoz García*/

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
        include_once("View/Productos.php");

    //Si el usuario es cliente se muestran los productos y el carrito.
    }else if(isset($_SESSION["usuario"]) && $_SESSION["usuario"]["role"] == "cliente"){
        include_once("View/Productos.php");
        //include_once("View/Carrito.php");
    }

    include_once("View/Assets/Templates/Cierre.php");
?>