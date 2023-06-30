<?php
   require_once('./config/DBConnection.php');

   class TablaEstado {
       private $dbConnection;
       
       public function __construct() {
           $this->dbConnection = new DBConnection();
       }
       
       public function insertarEstado($descripcion) {
           $conexion = $this->dbConnection->getConnection();
           
           // Insertar los datos en la tabla estado
           $sql = "INSERT INTO Estado (Descripcion)
                   VALUES ('$descripcion')";
           $conexion->query($sql);
           
           // Obtener el id generado de la tabla estado
           $insertId = $conexion->insert_id;
           
           // Cerrar la conexión
           $this->dbConnection->closeConnection();
           
           return $insertId;
       }
       
       public function actualizarEstado($estadoId, $descripcion) {
           $conexion = $this->dbConnection->getConnection();
           
           // Actualizar datos del estado en la tabla estado
           $sql = "UPDATE Estado SET Descripcion = '$descripcion'
                   WHERE ID_estado = '$estadoId'";
           $conexion->query($sql);
           
           // Verificar si se actualizó el estado 
           $affectedRows = $conexion->affected_rows;
           
           // Cerrar la conexión
           $this->dbConnection->closeConnection();
           
           return ($affectedRows > 0);
       }
   }
   


    
?>