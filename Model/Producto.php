<?php
/*Mohamed Abdeselam*/
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
        private string $unidades;
        private string $imagen;
        private string $idNegocio;

        //OK
        public function __construct($nombre, $descripcion, $tipo, $categorias, $talla, $precio, $unidades, $imagen, $id="", $idNegocio=""){
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->tipo = $tipo;
            $this->categorias = $categorias;
            $this->talla = $talla;
            $this->precio = $precio;
            $this->unidades = $unidades;
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
                $producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['tipo'], $fila['categorias'], $fila['talla'], $fila['precio'], $fila['unidades'], $fila['imagen'], $fila['id'], $fila['idNegocio']);
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
                return new Producto($resultado['nombre'], $resultado['descripcion'], $resultado['tipo'], $resultado['categorias'], $resultado['talla'], $resultado['precio'], $resultado['unidades'], $resultado['imagen'], $resultado['id'], $resultado['idNegocio']);
            }else{
                return "No se ha encontrado ningún producto con ese id.";
            }
        }

        //OK / Se obtiene el id de $_SESSION["usuario"]["id"] del usuario con role negocio para obtener el id del negocio.
        public static function getProductosByIDUsuario($idUsuario){
            $conexion = CeutaShopDB::conectarDB();
        
            //Obtener el idNegocio del usuario actual.
            $selectNegocio = "SELECT id FROM negocio WHERE idUsuario=:idUsuario;";
        
            $stmtNegocio = $conexion->prepare($selectNegocio);
            $stmtNegocio->bindParam(":idUsuario", $idUsuario);
            $stmtNegocio->execute();
        
            $resultadoNegocio = $stmtNegocio->fetch(PDO::FETCH_ASSOC);
        
            //Verificamos si se obtuvo el idNegocio.
            if($resultadoNegocio && isset($resultadoNegocio['id'])) {
                $idNegocio = $resultadoNegocio['id'];
        
                // Obtener todos los productos del negocio.
                $selectProductos = "SELECT * FROM producto WHERE idNegocio=:idNegocio;";
        
                $stmtProductos = $conexion->prepare($selectProductos);
                $stmtProductos->bindParam(":idNegocio", $idNegocio);
                $stmtProductos->execute();
        
                $productos = array();
        
                // Obtener todos los productos del negocio.
                while($fila = $stmtProductos->fetch(PDO::FETCH_ASSOC)){
                    $producto = new Producto($fila['nombre'], $fila['descripcion'], $fila['tipo'], $fila['categorias'], $fila['talla'], $fila['precio'], $fila['unidades'], $fila['imagen'], $fila['id'], $fila['idNegocio']);
                    array_push($productos, $producto);
                }
        
                return $productos;
            } else {
                return "No se encontró el negocio asociado al usuario.";
            }
        }        
        
        //OK
        public static function eliminarProducto($idProducto){
            try {
                $conexion = CeutaShopDB::conectarDB();

                $sql = "DELETE FROM producto WHERE id = :idProducto";
        
                $stmt = $conexion->prepare($sql);
                
                $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
                
                $stmt->execute();
                
                $filasAfectadas = $stmt->rowCount();
                
                if($filasAfectadas > 0){
                    return true;
                }

                $conexion = null;
            } catch (PDOException $e) {
                $conexion = null;
                echo "Error: " . $e->getMessage();
                return false;
            }
        }


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
        
        public function getUnidades(){
            return $this->unidades;
        }
        public function setUnidades($unidades){
            $this->unidades = $unidades;
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