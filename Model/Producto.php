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
        private string $imagen;
        private string $idNegocio;

        //OK
        public function __construct($nombre, $descripcion, $tipo, $categorias, $talla, $precio, $imagen, $id="", $idNegocio=""){
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->tipo = $tipo;
            $this->categorias = $categorias;
            $this->talla = $talla;
            $this->precio = $precio;
            $this->imagen = $imagen;
            $this->id = $id;
            $this->idNegocio = $idNegocio;
        }

        //OK
        public static function getProductos(){
            $conexion = CeutaShopDB::conectarDB();
            $productos = array();
            
            $select = "SELECT * FROM producto;";
            $stmt = $conexion->prepare($select);
            $stmt->execute();

            //Obtenemos todos los resultados en un array asociativo.
            $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //Recorremos cada resultado para crear un objeto con los datos y guardarlos en el array.
            foreach($filas as $fila){
                $producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['tipo'], $fila['categorias'], $fila['talla'], $fila['precio'], $fila['imagen'], $fila['id'], $fila['idNegocio']);
                array_push($productos, $producto);
            }

            //Devolvemos el array de objetos.
            return $productos;
        }

        //OK
        public static function getProductoByID($idProducto){
            $conexion = CeutaShopDB::conectarDB();
            
            $select = "SELECT * FROM producto WHERE id=:id;";
            
            $stmt = $conexion->prepare($select);
            $stmt->bindParam(":id", $idProducto);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            //Si se ha encontrado un artículo con ese id devolvemos un nuevo objeto Articulo con los datos obtenidos.
            if($resultado){
                return new Producto($resultado['nombre'], $resultado['descripcion'], $resultado['tipo'], $resultado['categorias'], $resultado['talla'], $resultado['precio'], $resultado['id'], $resultado['idTienda']);
            }else{
                return "No se ha encontrado ningún producto con ese id.";
            }
        }

        //OK
        public static function getProductosByIDNegocio($idNegocio){
            $conexion = CeutaShopDB::conectarDB();
            
            $select = "SELECT * FROM producto WHERE idNegocio=:idNegocio;";
            
            $stmt = $conexion->prepare($select);
            $stmt->bindParam(":idNegocio", $idNegocio);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            //Si se ha encontrado un artículo con ese id devolvemos un nuevo objeto Articulo con los datos obtenidos.
            if($resultado){
                return new Producto($resultado['nombre'], $resultado['descripcion'], $resultado['tipo'], $resultado['categorias'], $resultado['talla'], $resultado['precio'], $resultado['id'], $resultado['idTienda']);
            }else{
                return "No se ha encontrado ningún producto con ese id.";
            }
        }



        /*Al recoger los datos en el controlador se crea un objeto Producto con los datos. 
        Ese objeto llamará a la función. Si $_SESSION["usuario"]["role"] == "negocio"se 
        tiene que obtener el idUsuario del negocio para insertar/modificar/eliminar el producto.*/
        /*public function insertProductoByIDUsuario($idUsuario){
            $conexion = CeutaShopDB::conectarDB();
            
            $insert = "INSERT INTO producto (nombre, descripcion, tipo, categorias, talla, precio, idNegocio) VALUES (:nombre, :descripcion, :tipo, :categorias, :talla, :precio, :idNegocio);";
            
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

        public static function deleteProductoByIDUsuario($idNegocio){
            $conexion = CeutaShopDB::conectarDB();
            
            $delete = "DELETE FROM producto WHERE id=:id;";
            
            $stmt = $conexion->prepare($delete);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return "";
        }

*/

    //OK
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

        public function getImagen(){
            return $this->imagen;
        }
        public function setImagen($imagen){
            $this->precio = $imagen;
        }

        public function getIDNegocio(){
            return $this->idNegocio;
        }
        public function setIDNegocio($idNegocio){
            $this->idNegocio = $idNegocio;
        }
    }
?>