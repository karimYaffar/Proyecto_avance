<?php
  require_once('./config/DBConnection.php');

  class TablaPedidoDetalle {
      private $dbConnection;
      
      public function __construct() {
          $this->dbConnection = new DBConnection();
      }
      
      public function insertarPedidoDetalle($pedidoId, $subTotal, $comision, $total, $fechaPedido, $fechaEnvio, $cuentaBancariaId) {
          $conexion = $this->dbConnection->getConnection();
          
          // Insertar datos en la tabla Pedidos_detalle
          $sql = "INSERT INTO Pedidos_detalle (ID_pedido, Fk_pedidos, Sub_total, Comision, Total, Fecha_pedido, Fecha_envio, Fk_cuenta_bancaria)
                  VALUES ('$pedidoId', '$pedidoId', '$subTotal', '$comision', '$total', '$fechaPedido', '$fechaEnvio', '$cuentaBancariaId')";
          $conexion->query($sql);
          
          // Obtener el ID generado de la tabla Pedidos_detalle
          $insertId = $conexion->insert_id;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return $insertId;
      }
      
      public function eliminarPedidoDetalle($pedidoDetalleId) {
          $conexion = $this->dbConnection->getConnection();
          
          // Eliminar detalle del pedido en la tabla Pedidos_detalle
          $sql = "DELETE FROM Pedidos_detalle WHERE ID_pedido = '$pedidoDetalleId'";
          $conexion->query($sql);
          
          // Verificar si se eliminó el detalle del pedido 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
      
      public function actualizarPedidoDetalle($pedidoDetalleId, $subTotal, $comision, $total, $fechaPedido, $fechaEnvio, $cuentaBancariaId) {
          $conexion = $this->dbConnection->getConnection();
          
          // Actualizar datos del detalle del pedido en la tabla Pedidos_detalle
          $sql = "UPDATE Pedidos_detalle SET Sub_total = '$subTotal', Comision = '$comision', Total = '$total', Fecha_pedido = '$fechaPedido', Fecha_envio = '$fechaEnvio', Fk_cuenta_bancaria = '$cuentaBancariaId'
                  WHERE ID_pedido = '$pedidoDetalleId'";
          $conexion->query($sql);
          
          // Verificar si se actualizó el detalle del pedido 
          $affectedRows = $conexion->affected_rows;
          
          // Cerrar la conexión
          $this->dbConnection->closeConnection();
          
          return ($affectedRows > 0);
      }
  }
  
    
?>