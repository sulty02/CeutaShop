<?php 
/*Jorge Muñoz García*/

//Esta clase se usará para realizar la conexión a la base de datos.
    abstract class CeutaShopDB{
        private static $server = "localhost";
        private static $db = "ceutashop";
        private static $user = "root";
        private static $password = "";

        public static function conectarDB(){
            try{
                $conexion = new PDO("mysql:host=" . CeutaShopDB::$server . ";
                                    dbname=" . CeutaShopDB::$db . ";
                                    charset=utf8", 
                                    CeutaShopDB::$user, 
                                    CeutaShopDB::$password);
            }catch(PDOException $error){
                echo "No se ha podido conectar con el servidor de la base de datos.";
                die("Error " . $error->getCode() . ": " . $error->getMessage());
            }    

            return $conexion;
        }
    }
?>