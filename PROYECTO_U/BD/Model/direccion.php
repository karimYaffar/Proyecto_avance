<?php
 require_once('./config/DBConnection.php');

 class TablaDireccion {
     private $dbConnection;
     
     public function __construct() {
         $this->dbConnection = new DBConnection();
     }
     
     public function insertarDireccion($colonia, $municipio, $localidad, $codigoPostal, $referencia) {
         $conexion = $this->dbConnection->getConnection();
         
         // Insertar los datos en la tabla direccion
         $sql = "INSERT INTO tabla_direccion (colonia, municipio, localidad, codigo_postal, referencia)
                 VALUES ('$colonia', '$municipio', '$localidad', '$codigoPostal', '$referencia')";
         $conexion->query($sql);
         
         // Obtener el id generado de la tabla direccion
         $insertId = $conexion->insert_id;
         
         // Cerrar la conexión
         $this->dbConnection->closeConnection();
         
         return $insertId;
     }
     
     public function eliminarDireccion($direccionId) {
         $conexion = $this->dbConnection->getConnection();
         
         // Eliminar direccion de la tabla direccion
         $sql = "DELETE FROM tabla_direccion WHERE ID_direccion = '$direccionId'";
         $conexion->query($sql);
         
         // Verificar si se eliminó la dirección 
         $affectedRows = $conexion->affected_rows;
         
         // Cerrar la conexión
         $this->dbConnection->closeConnection();
         
         return ($affectedRows > 0);
     }
     
     public function actualizarDireccion($direccionId, $colonia, $municipio, $localidad, $codigoPostal, $referencia) {
         $conexion = $this->dbConnection->getConnection();
         
         // Actualizar datos de la dirección en la tabla direccion
         $sql = "UPDATE tabla_direccion SET colonia = '$colonia', municipio = '$municipio', localidad = '$localidad', codigo_postal = '$codigoPostal', referencia = '$referencia'
                 WHERE ID_direccion = '$direccionId'";
         $conexion->query($sql);
         
         // Verificar si se actualizó la dirección 
         $affectedRows = $conexion->affected_rows;
         
         // Cerrar la conexión
         $this->dbConnection->closeConnection();
         
         return ($affectedRows > 0);
     }
 }
 


    
?>
