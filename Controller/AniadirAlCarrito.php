<?php
    // Miguel Gutiérrez Noguera
    include_once("../Model/CeutaShopDB.php");
    require_once("../Model/Carrito.php");
    session_start();
    $cookie=new Carrito ($_GET['idProducto']);
    $totalCookies=0;
    $cookie->crearCestaCookies($totalCookies,$cookie->getIdproducto(),$_SESSION['usuario']['username']);
echo "hola";
echo $cookie->getIdproducto();
echo $_SESSION['usuario']['username'];



?>