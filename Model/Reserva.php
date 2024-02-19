<?php
/*Jorge Muñoz García*/
    require_once("CeutaShopDB.php");
    
    //Esta clase servirá como plantilla para realizar operaciones CRUD en su tabla correspondiente.
    class Reserva{
        private string $idCliente;
        private string $idProducto;
        private string $idNegocio;

        public function __construct($idCliente="", $idProducto="", $idNegocio=""){
            $this->idCliente = $idCliente;
            $this->idProducto = $idProducto;
            $this->idNegocio = $idNegocio;
        }

        public static function getReservasByIDCliente($idCliente){
            $conexion = CeutaShopDB::conectarDB();
            $articulos = array();
            
            $select = "SELECT * FROM articulo;";
            $stmt = $conexion->prepare($select);
            $stmt->execute();

            //Obtenemos todos los resultados en un array asociativo.
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //Recorremos cada resultado para crear un objeto con los datos y guardarlos en el array.
            foreach($filas as $fila){
                $articulo = new Articulo($fila['titulo'], $fila['contenido'], $fila['fecha'], $fila['id']);
                array_push($articulos, $articulo);
            }

            //Devolvemos el array de objetos.
            return $articulos;
        }

        public static function getReservasByIDNegocio($idNegocio){
            $conexion = CeutaShopDB::conectarDB();
            $articulos = array();
            
            $select = "SELECT * FROM articulo;";
            $stmt = $conexion->prepare($select);
            $stmt->execute();

            //Obtenemos todos los resultados en un array asociativo.
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //Recorremos cada resultado para crear un objeto con los datos y guardarlos en el array.
            foreach($filas as $fila){
                $articulo = new Articulo($fila['titulo'], $fila['contenido'], $fila['fecha'], $fila['id']);
                array_push($articulos, $articulo);
            }

            //Devolvemos el array de objetos.
            return $articulos;
        }

        public static function insertReservaByIDCliente($idCliente){
            $conexion = CeutaShopDB::conectarDB();
            
            $select = "SELECT * FROM articulo WHERE id=:id;";
            
            $stmt = $conexion->prepare($select);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            //Si se ha encontrado un artículo con ese id devolvemos un nuevo objeto Articulo con los datos obtenidos.
            if($resultado){
                return new Articulo($resultado['titulo'], $resultado['contenido'], $resultado['fecha'], $resultado['id']);
            }else{
                return "No se ha encontrado ningún articulo con ese id.";
            }
        }

        public static function deleteReservaByIDCliente($idCliente){
            $conexion = CeutaShopDB::conectarDB();
            
            $delete = "DELETE FROM articulo WHERE id=:id;";
            
            $stmt = $conexion->prepare($delete);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return "";
        }

        public function getIDCliente(){
            return $this->idCliente;
        }
        public function setIDCliente($idCliente){
            $this->idCliente = $idCliente;
        }

        public function getIDProducto(){
            return $this->idProducto;
        }
        public function setIDProducto($idProducto){
            $this->idProducto = $idProducto;
        }

        public function getIDNegocio(){
            return $this->idNegocio;
        }
        public function setIDNegocio($idNegocio){
            $this->idNegocio = $idNegocio;
        }
    }
?>