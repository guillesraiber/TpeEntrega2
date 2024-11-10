<?php
require_once './config.php';

class PedidoModel {
    
    public function getAllPedidos() {
        $db = getConnection();
        try {
            $pedido = $db->query("SELECT * FROM `compra`");
            return $pedido->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error en la consulta a la base de datos: " . $e->getMessage());
        }
    }

    // C: Crear un nuevo pedido
    public static function crearPedido($data) {
        $db = getConnection();
        try {
            $query = $db->prepare("INSERT INTO compra (Fecha_compra, Total, Local, ID_Cliente) VALUES (CURRENT_DATE, ?, ?, ?)");
            $query->execute([$data['precio'], $data['local'], $data['id_cliente']]);
        } catch (PDOException $e) {
            die("Error al crear el pedido: " . $e->getMessage());
        }
    }

    public static function editarPedido($id, $total,$local) {
        $db = getConnection();
        $resultado =  $db->prepare("UPDATE compra SET Local = ?, Total = ? WHERE ID_Compra = ?");
        $resultado->bindParam(1, $local, PDO::PARAM_STR);
        $resultado->bindParam(2, $total, PDO::PARAM_STR);
        $resultado->bindParam(3, $id,PDO::PARAM_INT);
        return $resultado->execute();
        
    }

    public static function eliminarPedido($id) {
        $db = getConnection();
        try {
            $query = $db->prepare("DELETE FROM compra WHERE ID_Compra = ?");
            $query->execute([$id]);
        } catch (PDOException $e) {
            die("Error al eliminar el pedido: " . $e->getMessage());
        }
    }

    public function getPedidoById($id) {
        $db = getConnection();
        try {
            $query = $db->prepare("SELECT * FROM compra WHERE ID_Compra = ?");
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error al obtener el pedido: " . $e->getMessage());
        }
    }

}
