<?php
    class UserModel{
        //creamos un atributo para manipular los datos en la bd
        private $UserConnection;

        //definimos el contructor de la clase usermodel
        public function __construct(){
            //requiero la clase dbconnection 
            require_once('../config/DBConnection.php');
            //instranciamos userconnection con dbconnection 
            $this->userConnection=new DBConnection();
        }

        //a partir de esto vienen los metodos logicos de la app

        //metodo para obtener todos los usuarios
        public function getAll(){
            //paso 1 creo la consulta
            $sql="SELECT * FROM usuarios";
            //paso 2 llamo a la conneccion 
            $connection =$this->userConnection->getConnection();
            //paso 3 ejecuto la consulta
            $result=$connection->query($sql);
            //paso 4 verifico y acomodo datos 
            //paso 4.1 creo un arreglo para almacenar los usuarios de la bd 
            $users=array();
            //tengo que recorrer $result para ir extrayendo los renglones (registros de usuarios)
            //ocupare un while y la instruccion fetch_assoc
            while($user=$result->fetch_assoc()){
                $users[]=$user;
            }
            //paso 5 cierro la coneccion 
            $this->userConnection->closeConnection();
            //paso 6 arrojo resultados
            return $users;
        }

        //metodo de dirreccion
        

        //getById metodo que extrae un usuario por su id
        public function getById($id){
            //paso 1 creamos la consulta
            $sql="SELECT * FROM usuario WHERE ID_usuario = $id_usuario";
            //paso 2 obtenemos la coneccion
            $connection=$this->userConnection->getConnection();
            //paso 3 ejecutamos la consulta
            $result=$connection->query($sql);
            //paso 4 verificamos que existan resultados
            if($result && $result->num_rows >0){
                $user=$result->fetch_assoc();                
            }else{
                $user=false;
            }
            //paso 5 cerramos la coneccion
            $this->userConnection->closeConnection();
            //paso 6
            return $user;
        }

        //metodo para verificar credenciales de logeo
        public function getCredentials($us,$ps){
            //paso 1 creamos la consulta
            $sql="SELECT * FROM usuario WHERE ID_suario = $id_usuario AND Password = $ps";
            //paso 2 obtenemos la coneccion
            $connection=$this->userConnection->getConnection();
            //paso 3 ejecutamos la consulta
            $result=$connection->query($sql);
            //paso 4 verificamos que existan resultados
            if($result && $result->num_rows >0){
                $user=$result->fetch_assoc();                
            }else{
                $user=false;
            }
            //paso 5 cerramos la coneccion
            $this->userConnection->closeConnection();
            //paso 6 arrojamos el resultado
            return $user;
        }

        //metodo para insertar usuarios
       
        
        
        
        //metodo para editar usuario
     
        

        //metodo para eliminar usuarios

      
        



    }
?>