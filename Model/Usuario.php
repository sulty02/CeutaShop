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

        //OK
        public function __construct($username, $email, $telefono, $password, $role, $id=""){
            $this->username = $username;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->password = $password;
            $this->role = $role;
            $this->id = $id;
        }

        //OK
        public static function getUsuarioByID($idUsuario){
            $conexion = CeutaShopDB::conectarDB();
            
            $select = "SELECT * FROM usuario WHERE id=:id;";
            
            $stmt = $conexion->prepare($select);
            $stmt->bindParam(":id", $idUsuario);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            //Si se ha encontrado un artículo con ese id devolvemos un nuevo objeto Articulo con los datos obtenidos.
            if($resultado){
                return new Usuario($resultado['username'], $resultado['email'], $resultado['telefono'], $resultado['password'], $resultado['role'], $resultado['id']);
            }else{
                return "No se ha encontrado ningún producto con ese id.";
            }
        }

        //OK / Se recogen los datos del form en el controlador, se crea un objeto y se le pasa a la función.
        public static function registrarUsuario($usuario){
            $conexion = CeutaShopDB::conectarDB();
            
            //Obtenemos los datos y la contraseña cifrada.
            $username = $usuario->getUsername();
            $email = $usuario->getEmail();
            $telefono = $usuario->getTelefono();
            $passwordHash = password_hash($usuario->getPassword(), PASSWORD_ARGON2I);
            $role = $usuario->getRole();

            $insert = "INSERT INTO usuario (username, email, telefono, password, role) VALUES (:username, :email, :telefono, :password, :role);";
            
            //Consultamos en la base de datos si hay un usuario con ese nombre.
            $consulta = $conexion->prepare("SELECT COUNT(*) FROM usuario WHERE username = :username;");
            $consulta->bindParam(':username', $username, PDO::PARAM_STR);
            $consulta->execute();

            $usuarioExistente = $consulta->fetchColumn();

            //Si no existe un registro con ese username se procede con el registro.
            if($usuarioExistente == 0){
                try{
                    $stmt = $conexion->prepare($insert);
                    $stmt->bindParam(":username", $username);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":telefono", $telefono);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":role", $role);

                    $stmt->execute();

                    //Verificamos si se ha insertado el usuario.
                    if($stmt->rowCount() > 0){
                        return 1;
                    }else{
                        return 2;
                    }
                }catch(PDOException $error) {
                    return "Error " . $error->getCode() . ": " . $error->getMessage();
                }
            }else{
                return 3;
            }
        }

        //OK / Recoge los datos del form post mediante el controller iniciarSesion.php. Controller: si devuelve true se redirige al index, si no muestra mensaje.
        public static function iniciarSesion($username, $password){
            $conexion = CeutaShopDB::conectarDB();

            //Preparamos la consulta para obtener el usuario por su username.
            $consultaUsuario = $conexion->prepare("SELECT id, username, password, role FROM usuario WHERE username = :username");
            $consultaUsuario->bindParam(':username', $username, PDO::PARAM_STR);
            
            //Ejecutar la consulta.
            $consultaUsuario->execute();
        
            //Obtenemos la información del usuario.
            $datosUsuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
        
            //Si se encuentra el usuario:
            if($datosUsuario){
                //Si la contraseña obtenida del formulario es igual a la obtenida del registro del usuario:
                if(password_verify($password, $datosUsuario['password'])){
                    //Iniciar la sesión.
                    session_start();
        
                    //Guardar en la sesión con el id, username y role.
                    $_SESSION['usuario'] = [
                        'id' => $datosUsuario['id'],
                        'username' => $datosUsuario['username'],
                        'role' => $datosUsuario['role']
                    ];
        
                    //Cerramos la conexión de la base de datos.
                    $conexion = null;
                    return 1;
                }else{
                    //Cerramos la conexión y devolvemos un mensaje de error.
                    $conexion = null;
                    return 2;
                }
            }else{
                //Cerramos la conexión y devolvemos un mensaje de error.
                $conexion = null;
                return 3;
            }
        }

        //OK
        public static function updateUsuario($idUsuario, $nuevoUsername, $nuevoEmail, $nuevoTelefono){
            try {
                $conexion = CeutaShopDB::conectarDB();
        
                $sql = "UPDATE usuario SET username = :nuevoUsername, email = :nuevoEmail, telefono = :nuevoTelefono WHERE id = :idUsuario";
        
                $stmt = $conexion->prepare($sql);
        
                $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $stmt->bindParam(':nuevoUsername', $nuevoUsername, PDO::PARAM_STR);
                $stmt->bindParam(':nuevoEmail', $nuevoEmail, PDO::PARAM_STR);
                $stmt->bindParam(':nuevoTelefono', $nuevoTelefono, PDO::PARAM_STR);
        
                $stmt->execute();
        
                $filasAfectadas = $stmt->rowCount();
        
                if($filasAfectadas > 0){
                    echo "<h2>Se han modificado correctamente los datos</h2>";
                }else{
                    echo "<h2>No han habido cambios en los datos</h2>";
                }

                $conexion = null;
            } catch (PDOException $e) {
                $conexion = null;
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        //OK / Elimina tanto el usuario como el negocio si el role es negocio. Por lo que en el Model Negocio no hay un delete.
        /*public static function deleteUsuarioByUsername(){
            $conexion = CeutaShopDB::conectarDB();

            //Si es un usuario de negocio se elimina de la tabla usuario y de la tabla negocio. 
            if($_SESSION["username"]["role"] == "negocio"){
                //Obtenemos idUsuario por username.
                $selectIdUsuario = "SELECT idUsuario FROM usuario WHERE username=:username;";
                $stmtSelectIdUsuario = $conexion->prepare($selectIdUsuario);
                $stmtSelectIdUsuario->bindParam(":username", $_SESSION["username"]);
                $stmtSelectIdUsuario->execute();
                $idUsuario = $stmtSelectIdUsuario->fetchColumn();

                //Eliminamos el registro de la tabla negocio.
                $deleteNegocio = "DELETE FROM negocio WHERE idUsuario=:idUsuario;";
                $stmtDeleteNegocio = $conexion->prepare($deleteNegocio);
                $stmtDeleteNegocio->bindParam(":idUsuario", $idUsuario);
                $stmtDeleteNegocio->execute();
            }

            //Si el usuario es cliente se elimina solo de la tabla usuario.
            $deleteUsuario = "DELETE FROM usuario WHERE username=:username;";
            $stmtDeleteUsuario = $conexion->prepare($deleteUsuario);
            $stmtDeleteUsuario->bindParam(":username", $_SESSION["username"]);
            $stmtDeleteUsuario->execute();

            header("Location: ../index.php");
        }*/

    //OK
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