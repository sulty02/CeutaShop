<?php
/*Jorge Muñoz García*/
    require_once("CeutaShopDB.php");
    
    //Esta clase servirá como plantilla para realizar operaciones CRUD en su tabla correspondiente.
    class Usuario{
        private string $id;
        private string $username;
        private string $email;
        private int $telefono;
        private string $password;
        private string $role;

        public function __construct($username, $email, $telefono, $password, $role, $id=""){
            $this->username = $username;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->password = $password;
            $this->role = $role;
            $this->id = $id;
        }

        public static function getUsuarioByID($idUsuario){
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

        public static function getReservasUsuario($idUsuario){
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

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            $this->username = $username;
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

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
        }

        public function getRole(){
            return $this->role;
        }
        public function setRole($role){
            $this->role = $role;
        }
    }
?>