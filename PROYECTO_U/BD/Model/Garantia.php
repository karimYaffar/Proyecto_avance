<?php
  require_once('./config/DBConnection.php');

  class TablaGarantia {
      private $dbConnection;
      
      public function __construct() {
          $this->dbConnection = new DBConnection();
      }
      
      public function insertarGarantia($fkProducto, $fkUsuario, $formaDevolucion, $fecha, $razon) {
          $conexion = $this->dbConnection->getConnection();
          
          // Insertar datos en la tabla garantia
          $sql = "INSERT INTO garantia (Fk_producto, Fk_usuario, Forma_Devolucion, Fecha, Razon)
                  VALUES ('$fkProducto', '$fkUsuario', '$formaDevolucion', '$fecha', '$razon')";
          $conexion->query($sql);
          
          // Obtener el ID generado de la tabla garantia
          $insertId = $conexion->insert_id;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return $insertId;
      }
      
      public function actualizarGarantia($garantiaId, $fkProducto, $fkUsuario, $formaDevolucion, $fecha, $razon) {
          $conexion = $this->dbConnection->getConnection();
          
          // Actualizar datos en la tabla garantia
          $sql = "UPDATE garantia
                  SET Fk_producto = '$fkProducto', Fk_usuario = '$fkUsuario', Forma_Devolucion = '$formaDevolucion', Fecha = '$fecha', Razon = '$razon'
                  WHERE ID_garantia = '$garantiaId'";
          $conexion->query($sql);
          
          // Verificar si se actualizó la garantía 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
      
      public function eliminarGarantia($garantiaId) {
          $conexion = $this->dbConnection->getConnection();
          
          // Eliminar garantía de la tabla "garantia"
          $sql = "DELETE FROM garantia WHERE ID_garantia = '$garantiaId'";
          $conexion->query($sql);
          
          // Verificar si se eliminó la garantía 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
  }
  
    
?>