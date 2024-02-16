<?php
    require_once("CeutaShopDB.php");
    
    //Esta clase servirá como plantilla para realizar operaciones CRUD en su tabla correspondiente.
    class Articulo{
        private string $id;
        private string $titulo;
        private string $contenido;
        private string $fecha;

        public function __construct($titulo, $contenido, $fecha, $id=""){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->contenido = $contenido;
            $this->fecha = $fecha;
        }

        public static function getProductos(){
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

        public static function getArticuloByID($idProducto){
            $conexion = CeutaShopDB::conectarDB();
            
            $select = "SELECT * FROM articulo WHERE id=:id;";
            
            $stmt = $conexion->prepare($select);
            $stmt->bindParam(":id", $idProducto);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            //Si se ha encontrado un artículo con ese id devolvemos un nuevo objeto Articulo con los datos obtenidos.
            if($resultado){
                return new Articulo($resultado['titulo'], $resultado['contenido'], $resultado['fecha'], $resultado['id']);
            }else{
                return "No se ha encontrado ningún producto con ese id.";
            }
        }

        public static function getArticulosByNegocio($idNegocio){
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

        public function insert(){
            $conexion = CeutaShopDB::conectarDB();
            
            $insert = "INSERT INTO articulo (titulo, contenido, fecha) VALUES (:titulo, :contenido, :fecha);";
            
            try{
                $stmt = $conexion->prepare($insert);
                $stmt->bindParam(":titulo", $this->titulo);
                $stmt->bindParam(":contenido", $this->contenido);
                $stmt->bindParam(":fecha", $this->fecha);

                $stmt->execute();

                //Verificamos si se ha insertado el elemento.
                if($stmt->rowCount() > 0){
                    return "Se han insertado los datos correctamente.";
                }else{
                    return "No se han insertado los datos. Puede que ya exista un artículo con el mismo título.";
                }
            }catch(PDOException $error) {
                return "Error " . $error->getCode() . ": " . $error->getMessage();
            }
        }

        public static function delete($id){
            $conexion = CeutaShopDB::conectarDB();
            
            $delete = "DELETE FROM articulo WHERE id=:id;";
            
            $stmt = $conexion->prepare($delete);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return "";
        }

        public function getID(){
            return $this->id;
        }
        public function setID($id){
            $this->id = $id;
        }

        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getContenido(){
            return $this->contenido;
        }
        public function setContenido($contenido){
            $this->contenido = $contenido;
        }

        public function getFecha(){
            return $this->fecha;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
    }
?>