<?php
   require_once('./config/DBConnection.php');

   class TablaPedido {
       private $dbConnection;
       
       public function __construct() {
           $this->dbConnection = new DBConnection();
       }
       
       public function insertarPedido($fkUsuario, $fkDireccion, $fkProducto, $cantidad, $fkEstado) {
           $conexion = $this->dbConnection->getConnection();
           
           // Insertar datos en la tabla pedidos
           $sql = "INSERT INTO pedidos (Fk_usuario, Fk_direccion, Fk_producto, cantidad, Fk_estado)
                   VALUES ('$fkUsuario', '$fkDireccion', '$fkProducto', '$cantidad', '$fkEstado')";
           $conexion->query($sql);
           
           // Obtener el ID generado de la tabla pedidos
           $insertId = $conexion->insert_id;
           
           // Cerrar la conexión
           $this->dbConnection->closeConnection();
           
           return $insertId;
       }
   
       public function eliminarPedido($pedidoId) {
           $conexion = $this->dbConnection->getConnection();
           
           // Eliminar pedido de la tabla pedidos
           $sql = "DELETE FROM pedidos WHERE ID_pedido = '$pedidoId'";
           $conexion->query($sql);
           
           // Verificar si se eliminó el pedido 
           $affectedRows = $conexion->affected_rows;
           
           // Cerrar la conexión
           $this->dbConnection->closeConnection();
           
           return ($affectedRows > 0);
       }
       
       public function actualizarPedido($pedidoId, $fkUsuario, $fkDireccion, $fkProducto, $cantidad, $fkEstado) {
           $conexion = $this->dbConnection->getConnection();
           
           // Actualizar datos del pedido en la tabla pedidos
           $sql = "UPDATE pedidos SET Fk_usuario = '$fkUsuario', Fk_direccion = '$fkDireccion', Fk_producto = '$fkProducto', cantidad = '$cantidad', Fk_estado = '$fkEstado'
                   WHERE ID_pedido = '$pedidoId'";
           $conexion->query($sql);
           
           // Verificar si se actualizó el pedido 
           $affectedRows = $conexion->affected_rows;
           
           // Cerrar la conexión
           $this->dbConnection->closeConnection();
           
           return ($affectedRows > 0);
       }
   }
   
?>