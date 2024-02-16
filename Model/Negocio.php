<?php
/*Jorge Muñoz García*/
    require_once("CeutaShopDB.php");
    
    //Esta clase servirá como plantilla para realizar operaciones CRUD en su tabla correspondiente.
    class Negocio{
        private string $id;
        private string $nombre;
        private string $descripcion;
        private string $email;
        private string $telefono;
        private string $calle;
        private string $horario;
        private string $idUsuario;

        public function __construct($nombre, $descripcion, $email, $telefono, $calle, $horario, $idUsuario="", $id=""){
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->calle = $calle;
            $this->horario = $horario;
            $this->idUsuario = $idUsuario;
            $this->id = $id;
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

        //HACERLO YA!!!!! Se crea un objeto Negocio en el controller y se le pasa por parámetros. / Si devuleve true se redirige al index.
        public static function registrarNegocio($negocio){
            $conexion = CeutaShopDB::conectarDB();
            
            $insert = "INSERT INTO negocio (nombre, descripcion, email, telefono, calle, horario, idUsuario) VALUES (:nombre, :descripcion, :email, :telefono, :calle, :horario, :idUsuario);";
            
            try{
                $stmt = $conexion->prepare($insert);
                $stmt->bindParam(":nombre", $negocio->nombre);
                $stmt->bindParam(":descripcion", $negocio->descripcion);
                $stmt->bindParam(":email", $negocio->email);
                $stmt->bindParam(":telefono", $negocio->telefono);
                $stmt->bindParam(":calle", $negocio->calle);
                $stmt->bindParam(":horario", $negocio->horario);
                $stmt->bindParam(":idUsuario", $negocio->idUsuario);

                $stmt->execute();

                //Verificamos si se ha insertado el elemento.
                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return "No se ha podido crear el negocio. Inténtalo de nuevo.";
                }
            }catch(PDOException $error) {
                return "Error " . $error->getCode() . ": " . $error->getMessage();
            }
        }

        public function getID(){
            return $this->id;
        }
        public function setID($id){
            $this->id = $id;
        }

        public function getIDUsuario(){
            return $this->idUsuario;
        }
        public function setIDUsuario($idUsuario){
            $this->idUsuario = $idUsuario;
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

        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function getTelefono(){
            return $this->telefono;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        public function getCalle(){
            return $this->calle;
        }
        public function setCalle($calle){
            $this->calle = $calle;
        }

        public function getHorario(){
            return $this->horario;
        }
        public function setHorario($horario){
            $this->horario = $horario;
        }
    }
?>