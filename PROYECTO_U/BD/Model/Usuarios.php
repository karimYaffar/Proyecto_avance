<?php
require_once './config/DBConnection.php';
 class Usuario {
    private $dbConnection;
    private $tablaDireccion;
    private $tablaCuentaBancaria;
    
    public function __construct() {
        $this->dbConnection = new DBConnection();
        $this->tablaDireccion = new TablaDireccion();
        $this->tablaCuentaBancaria = new TablaCuentaBancaria();
    }
    
    public function insertarUsuario($nombre, $apellidoPaterno, $apellidoMaterno, $password, $telefono, $correo, $colonia, $municipio, $localidad, $codigoPostal, $referencia, $numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular) {
        $conexion = $this->dbConnection->getConnection();
        
        // Iniciar la transacción
        $conexion->begin_transaction();
        
        try {
            // Insertar datos de la dirección y obtener el ID generado
            $direccionId = $this->tablaDireccion->insertarDireccion($colonia, $municipio, $localidad, $codigoPostal, $referencia);
            
            // Insertar datos de la cuenta bancaria y obtener el ID generado
            $cuentaId = $this->tablaCuentaBancaria->insertarCuentaBancaria($numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular);
            
            // Insertar datos del usuario, incluyendo los IDs de la dirección y la cuenta bancaria
            $sql = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, password, telefono, correo, fk_direccion, ID_cuenta_bancaria)
                    VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$password', '$telefono', '$correo', '$direccionId', '$cuentaId')";
            $conexion->query($sql);
            
            // Confirmar la transacción
            $conexion->commit();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return true; // Registro insertado correctamente
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return false; // Error al insertar el registro
        }
    }
    
    public function actualizarUsuario($usuarioId, $nombre, $apellidoPaterno, $apellidoMaterno, $password, $telefono, $correo, $colonia, $municipio, $localidad, $codigoPostal, $referencia, $numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular) {
        $conexion = $this->dbConnection->getConnection();
        
        // Iniciar la transacción
        $conexion->begin_transaction();
        
        try {
            // Actualizar datos de la dirección y obtener el ID generado
            $direccionId = $this->tablaDireccion->actualizarDireccion($usuarioId, $colonia, $municipio, $localidad, $codigoPostal, $referencia);
            
            // Actualizar datos de la cuenta bancaria y obtener el ID generado
            $cuentaId = $this->tablaCuentaBancaria->actualizarCuentaBancaria($usuarioId, $numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular);
            
            // Actualizar datos del usuario, incluyendo los IDs de la dirección y la cuenta bancaria
            $sql = "UPDATE usuarios
                    SET nombre = '$nombre', apellido_paterno = '$apellidoPaterno', apellido_materno = '$apellidoMaterno', password = '$password', telefono = '$telefono', correo = '$correo', fk_direccion = '$direccionId', ID_cuenta_bancaria = '$cuentaId'
                    WHERE ID_usuario = '$usuarioId'";
            $conexion->query($sql);
            
            // Confirmar la transacción
            $conexion->commit();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return true; // Registro actualizado correctamente
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return false; // Error al actualizar el registro
        }
    }
    
    public function eliminarUsuario($usuarioId) {
        $conexion = $this->dbConnection->getConnection();
        
        // Iniciar la transacción
        $conexion->begin_transaction();
        
        try {
            // Obtener la dirección y la cuenta bancaria asociadas al usuario
            $direccionId = $this->obtenerDireccionId($usuarioId);
            $cuentaId = $this->obtenerCuentaBancariaId($usuarioId);
            
            // Eliminar la dirección y la cuenta bancaria
            $this->tablaDireccion->eliminarDireccion($direccionId);
            $this->tablaCuentaBancaria->eliminarCuentaBancaria($cuentaId);
            
            // Eliminar el usuario
            $sql = "DELETE FROM usuarios WHERE ID_usuario = '$usuarioId'";
            $conexion->query($sql);
            
            // Confirmar la transacción
            $conexion->commit();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return true; // Registro eliminado correctamente
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            
            // Cerrar la conexión
            $this->dbConnection->closeConnection();
            
            return false; // Error al eliminar el registro
        }
    }
    
    private function obtenerDireccionId($usuarioId) {
        $conexion = $this->dbConnection->getConnection();
        
        // Obtener el ID de la dirección asociada al usuario
        $sql = "SELECT fk_direccion FROM usuarios WHERE ID_usuario = '$usuarioId'";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();
        
        // Cerrar la conexión
        $this->dbConnection->closeConnection();
        
        return $row['fk_direccion'];
    }
    
    private function obtenerCuentaBancariaId($usuarioId) {
        $conexion = $this->dbConnection->getConnection();
        
        // Obtener el ID de la cuenta bancaria asociada al usuario
        $sql = "SELECT ID_cuenta_bancaria FROM usuarios WHERE ID_usuario = '$usuarioId'";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();
        
        // Cerrar la conexión
        $this->dbConnection->closeConnection();
        
        return $row['ID_cuenta_bancaria'];
    }
}

 
?>