<?php
// Miguel Gutiérrez Noguera
require_once("CeutaShopDB.php");
require_once("Producto.php");
class Carrito{

    private string $idProducto;
   
    public function __construct($idProducto){
        $this->idProducto=$idProducto;
    }
    

    public static function crearCestaCookies(&$totalCookies,$idProducto,$nombreUsuario){
        $arrayTablaProductos=Producto::getProductos();

        // obtenemos los datos del producto
        foreach($arrayTablaProductos as $producto){
            if($idProducto==$producto->getID()){
                $idProducto=$producto->getID(); 
                $nombreProducto=$producto->getNombre();
                $precio=$producto->getPrecio();
            }
        }

        // creamos la cookie para contar total cookies
        if(!isset($_COOKIE[$nombreUsuario.'totalCookies'])){
            $totalCookies=0;
        }else{
            $totalCookies=$_COOKIE[$nombreUsuario.'totalCookies'];
        }
        setcookie($nombreUsuario.'totalCookies',$totalCookies,time()+60*30); 

                //comprobamos si se ha creado ese producto elegido anteriormente 
                if(isset($_COOKIE[$nombreUsuario.$idProducto])){

                    // Cuando sea necesario, deserializar la cadena de texto de la cookie para obtener el array de vuelta
                    $valoresCookie = unserialize($_COOKIE[$nombreUsuario.$idProducto]);
             
                    // Ahora puedes utilizar el array de valores de la cookie
                    foreach ($valoresCookie as $indice=> $valor) {
                        if($indice=="numeroUnidades"){
                            $contaCookie=++$valor;
                        } 
                    }
                    $valores = array("nombreProducto"=>$nombreProducto,"precio"=> $precio,"numeroUnidades"=> $contaCookie);
                    $cookieValor=serialize($valores);
                    setcookie($nombreUsuario.$idProducto, $cookieValor, time() + (86400 * 30), '/');
                    
                }else{
                    $contaCookie=1;
                    // Definir los valores que se guardarán en la cookie
                    $valores = array("nombreProducto"=>$nombreProducto,"precio"=> $precio,"numeroUnidades"=> $contaCookie);

                    $cookieValor=serialize($valores);
                    //creamos una cookie del producto elegido
                    // Establecer la cookie con los valores serializados
                    setcookie($nombreUsuario.$idProducto, $cookieValor, time() + (86400 * 30), '/');     
                }

                setcookie($nombreUsuario.'totalCookies',++$totalCookies);
                header('Location:../index.php');

        // opciones de modificación de nº cookies
        if(isset($_GET['accion'])){
            if($_GET['accion']=="eliminar"){
                setcookie( $nombreUsuario.$idProducto."[nombre]",$nombreProducto,time()-60*40);
                setcookie( $nombreUsuario.$idProducto."[precio]",$precio,time()-60*40);
                setcookie( $nombreUsuario.$idProducto."[sesion]",$nombreUsuario,time()-60*40);
                setcookie( $nombreUsuario.$idProducto."[contaCookie]",$contaCookie,time()-60*40);
                setcookie($nombreUsuario.'totalCookies',$totalCookies=$totalCookies-$_COOKIE[$nombreUsuario.$idProducto]['contaCookie']);
                header('Location:../index.php');
            }elseif($_GET['accion']=="suma"){
                $contaCookie=$_COOKIE[$nombreUsuario.$idProducto]['contaCookie']+1;
                setcookie( $nombreUsuario.$idProducto."[contaCookie]",$contaCookie);
                setcookie($nombreUsuario.'totalCookies',++$totalCookies);
                header('Location:../index.php'); 
            }elseif($_GET['accion']=="resta"){
                if($contaCookie=$_COOKIE[$nombreUsuario.$idProducto]['contaCookie']>1){
                    $contaCookie=$_COOKIE[$nombreUsuario.$idProducto]['contaCookie']-1;
                    setcookie( $nombreUsuario.$idProducto."[contaCookie]",$contaCookie);
                    setcookie($nombreUsuario.'totalCookies',--$totalCookies);
                    header('Location:../index.php'); 
                }else{
                    setcookie( $nombreUsuario.$idProducto."[nombre]",$nombreProducto,time()-60*40);
                    setcookie( $nombreUsuario.$idProducto."[precio]",$precio,time()-60*40);
                    setcookie( $nombreUsuario.$idProducto."[sesion]",$nombreUsuario,time()-60*40);
                    setcookie( $nombreUsuario.$idProducto."[contaCookie]",$contaCookie,time()-60*40);
                    setcookie($nombreUsuario.'totalCookies',$totalCookies=$totalCookies-$_COOKIE[$nombreUsuario.$idProducto]['contaCookie']);
                    header('Location:../index.php'); 
                }              
            }    
        }
    }

    public function getIdproducto(){
        return $this->idProducto;
    }
}


     


?>