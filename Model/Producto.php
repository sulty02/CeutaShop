<?php
/*Jorge Muñoz García*/
    require_once("CeutaShopDB.php");

    //Esta clase servirá como plantilla para realizar operaciones CRUD en su tabla correspondiente.
    class Producto{
        private string $id;
        private string $nombre;
        private string $descripcion;
        private string $tipo;
        private string $categorias;
        private string $talla;
        private float $precio;
        private string $idTienda;

        public function __construct($nombre, $descripcion, $tipo, $categorias, $talla, $precio, $id="", $idTienda=""){
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->tipo = $tipo;
            $this->categorias = $categorias;
            $this->talla = $talla;
            $this->precio = $precio;
            $this->id = $id;
            $this->idTienda = $idTienda;
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

        public static function getProductoByID($idProducto){
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

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function getTipo(){
            return $this->tipo;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

        public function getCategorias(){
            return $this->categorias;
        }
        public function setCategorias($categorias){
            $this->categorias = $categorias;
        }
        
        public function getTalla(){
            return $this->talla;
        }
        public function setTalla($talla){
            $this->talla = $talla;
        }

        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function getIDTienda(){
            return $this->idTienda;
        }
        public function setIDTienda($idTienda){
            $this->idTienda = $idTienda;
        }
    }
?>