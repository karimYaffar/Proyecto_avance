<?php
  require_once('./config/DBConnection.php');

  class TablaProductos {
      private $dbConnection;
      
      public function __construct() {
          $this->dbConnection = new DBConnection();
      }
      
      public function insertarProducto($nombreProducto, $descripcion, $precio, $existencias, $iva) {
          $conexion = $this->dbConnection->getConnection();
          
          // Insertar datos en la tabla "Productos"
          $sql = "INSERT INTO Productos (Nombre_Producto, Descripcion, Precio, Existencias, IVA)
                  VALUES ('$nombreProducto', '$descripcion', '$precio', '$existencias', '$iva')";
          $conexion->query($sql);
          
          // Obtener el ID generado de la tabla "Productos"
          $insertId = $conexion->insert_id;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return $insertId;
      }
      
      public function eliminarProducto($productoId) {
          $conexion = $this->dbConnection->getConnection();
          
          // Eliminar producto de la tabla Productos
          $sql = "DELETE FROM Productos WHERE ID_producto = '$productoId'";
          $conexion->query($sql);
          
          // Verificar si se eliminó el producto 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
      
      public function actualizarProducto($productoId, $nombreProducto, $descripcion, $precio, $existencias, $iva) {
          $conexion = $this->dbConnection->getConnection();
          
          // Actualizar datos del producto en la tabla productos
          $sql = "UPDATE Productos SET Nombre_Producto = '$nombreProducto', Descripcion = '$descripcion', Precio = '$precio', Existencias = '$existencias', IVA = '$iva'
                  WHERE ID_producto = '$productoId'";
          $conexion->query($sql);
          
          // Verificar si se actualizó el producto 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
  }
  
    


    
?>