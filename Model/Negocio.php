<?php
/*Jorge Muñoz García y Mohamed Abdeselam*/
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

        //Se crea un objeto Negocio en el controller y se le pasa por parámetros. / Si devuleve true se redirige al index.
        public static function registrarNegocio($negocio){
            $conexion = CeutaShopDB::conectarDB();
            
            $nombre = $negocio->getNombre();
            $descripcion = $negocio->getDescripcion();
            $email = $negocio->getEmail();
            $telefono = $negocio->getTelefono();
            $calle = $negocio->getCalle();
            $horario = $negocio->getHorario();
            $idUsuario = $negocio->getIDUsuario();

            $insert = "INSERT INTO negocio (nombre, descripcion, email, telefono, calle, horario, idUsuario) VALUES (:nombre, :descripcion, :email, :telefono, :calle, :horario, :idUsuario);";
            
            try{
                $stmt = $conexion->prepare($insert);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":descripcion", $descripcion);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":calle", $calle);
                $stmt->bindParam(":horario", $horario);
                $stmt->bindParam(":idUsuario", $idUsuario);

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

        public static function obtenerNegocioByIDProducto($idProducto){
            $conexion = CeutaShopDB::conectarDB();
            
            //Obtener el idNegocio del producto actual.
            $selectNegocio = "SELECT idNegocio FROM producto WHERE id=:id;";
            
            $stmtNegocio = $conexion->prepare($selectNegocio);
            $stmtNegocio->bindParam(":id", $idProducto);
            $stmtNegocio->execute();
            
            $resultadoNegocio = $stmtNegocio->fetch(PDO::FETCH_ASSOC);
            
            //Verificamos si se obtuvo el idNegocio.
            if($resultadoNegocio && isset($resultadoNegocio['idNegocio'])) {
                $idNegocio = $resultadoNegocio['idNegocio'];
                
                //Obtener los datos del negocio.
                $selectNegocioDatos = "SELECT * FROM negocio WHERE id=:id;";
                
                $stmtNegocioDatos = $conexion->prepare($selectNegocioDatos);
                $stmtNegocioDatos->bindParam(":id", $idNegocio);
                $stmtNegocioDatos->execute();
                
                $negocio = $stmtNegocioDatos->fetch(PDO::FETCH_ASSOC);
                
                //Verificar si se encontraron datos del negocio.
                if($negocio) {
                    return $negocio;
                } else {
                    return "No se encontraron datos del negocio asociado al producto.";
                }
            } else {
                return "No se encontró el negocio asociado al producto.";
            }
        }        

        public static function obtenerNegocioByIDUsuario($idUsuario){
            $conexion = CeutaShopDB::conectarDB();
            
            // Obtener el negocio asociado al usuario.
            $selectNegocio = "SELECT * FROM negocio WHERE idUsuario=:idUsuario;";
            
            $stmtNegocio = $conexion->prepare($selectNegocio);
            $stmtNegocio->bindParam(":idUsuario", $idUsuario);
            $stmtNegocio->execute();
            
            $resultadoNegocio = $stmtNegocio->fetch(PDO::FETCH_ASSOC);
            
            // Verificamos si se obtuvo el resultado.
            if($resultadoNegocio) {
                return $resultadoNegocio;
            } else {
                return "No se encontró el negocio asociado al usuario.";
            }
        }        

        public static function updateNegocio($idUsuario, $nuevoNombre, $nuevaDescripcion, $nuevoEmail, $nuevoTelefono, $nuevaCalle, $nuevoHorario){
            try{
                $conexion = CeutaShopDB::conectarDB();
        
                //Obtenemos el id del negocio mediante el idUsuario.
                $sqlObtenerIdNegocio = "SELECT id FROM negocio WHERE idUsuario = :idUsuario";
                $stmtObtenerIdNegocio = $conexion->prepare($sqlObtenerIdNegocio);
                $stmtObtenerIdNegocio->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $stmtObtenerIdNegocio->execute();
                $resultado = $stmtObtenerIdNegocio->fetch(PDO::FETCH_ASSOC);
 
                $idNegocio = $resultado['id'];
        
                $sqlUpdateNegocio = "UPDATE negocio SET nombre = :nuevoNombre, descripcion = :nuevaDescripcion, email = :nuevoEmail, telefono = :nuevoTelefono, calle = :nuevaCalle, horario = :nuevoHorario WHERE id = :idNegocio";
        
                $stmtUpdateNegocio = $conexion->prepare($sqlUpdateNegocio);
        
                $stmtUpdateNegocio->bindParam(':idNegocio', $idNegocio, PDO::PARAM_INT);
                $stmtUpdateNegocio->bindParam(':nuevoNombre', $nuevoNombre, PDO::PARAM_STR);
                $stmtUpdateNegocio->bindParam(':nuevaDescripcion', $nuevaDescripcion, PDO::PARAM_STR);
                $stmtUpdateNegocio->bindParam(':nuevoEmail', $nuevoEmail, PDO::PARAM_STR);
                $stmtUpdateNegocio->bindParam(':nuevoTelefono', $nuevoTelefono, PDO::PARAM_STR);
                $stmtUpdateNegocio->bindParam(':nuevaCalle', $nuevaCalle, PDO::PARAM_STR);
                $stmtUpdateNegocio->bindParam(':nuevoHorario', $nuevoHorario, PDO::PARAM_STR);
        
                $stmtUpdateNegocio->execute();
        
                $filasAfectadas = $stmtUpdateNegocio->rowCount();
        
                if($filasAfectadas > 0){
                    echo "<h2>Se han modificado correctamente los datos del negocio.</h2>";
                }else{
                    echo "<h2>No han habido cambios en los datos del negocio.</h2>";
                }
        
                $conexion = null;
            }catch (PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
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