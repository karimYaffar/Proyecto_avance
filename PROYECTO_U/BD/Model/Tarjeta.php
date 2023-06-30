<?php
require_once './config/DBConnection.php';
class TablaCuentaBancaria {
    private $dbConnection;
    
    public function __construct() {
        $this->dbConnection = new DBConnection();
    }
    
    public function insertarCuentaBancaria($numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular) {
        $conexion = $this->dbConnection->getConnection();
        
        // Insertar datos en la tabla "cuenta_bancaria"
        $sql = "INSERT INTO cuenta_bancaria (numero_cuenta, fecha_vencimiento_mes, fecha_vencimiento_ano, nip, titular)
                VALUES ('$numeroCuenta', '$fechaVencimientoMes', '$fechaVencimientoAno', '$nip', '$titular')";
        $conexion->query($sql);
        
        // Obtener el ID generado de la tabla "cuenta_bancaria"
        $insertId = $conexion->insert_id;
        
        // Cerrar la conexión
        $this->dbConnection->closeConnection();
        
        return $insertId;
    }
    
    public function eliminarCuentaBancaria($cuentaBancariaId) {
        $conexion = $this->dbConnection->getConnection();
        
        // Eliminar cuenta bancaria de la tabla "cuenta_bancaria"
        $sql = "DELETE FROM cuenta_bancaria WHERE ID_cuenta = '$cuentaBancariaId'";
        $conexion->query($sql);
        
        // Verificar si se eliminó la cuenta bancaria correctamente
        $affectedRows = $conexion->affected_rows;
        
        // Cerrar la conexión
        $this->dbConnection->closeConnection();
        
        return ($affectedRows > 0);
    }
    
    public function actualizarCuentaBancaria($cuentaBancariaId, $numeroCuenta, $fechaVencimientoMes, $fechaVencimientoAno, $nip, $titular) {
        $conexion = $this->dbConnection->getConnection();
        
        // Actualizar datos de la cuenta bancaria en la tabla "cuenta_bancaria"
        $sql = "UPDATE cuenta_bancaria SET numero_cuenta = '$numeroCuenta', fecha_vencimiento_mes = '$fechaVencimientoMes', fecha_vencimiento_ano = '$fechaVencimientoAno', nip = '$nip', titular = '$titular'
                WHERE ID_cuenta = '$cuentaBancariaId'";
        $conexion->query($sql);
        
        // Verificar si se actualizó la cuenta bancaria correctamente
        $affectedRows = $conexion->affected_rows;
        
        // Cerrar la conexión
        $this->dbConnection->closeConnection();
        
        return ($affectedRows > 0);
    }
}


?>
