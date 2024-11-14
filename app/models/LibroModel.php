<?php
require_once './config.php';

class LibroModel {

    public static function getAllLibros() {
        $db = getConnection();
        try {
            $libro = $db->query("SELECT * FROM `libros`");
            $result = $libro->fetchAll(PDO::FETCH_OBJ);
            if (empty($result)) {
                echo "No se encontraron libros.";
            }
            return $result;
        } catch (PDOException $e) {
            die("Error en la consulta a la base de datos: " . $e->getMessage());
        }
    }

    public static function getLibroById ($id) {
        $db = getConnection();
        $resultado = $db->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $resultado->bindParam(1, $id, PDO::PARAM_INT);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);

    }

    public static function crearLibro($titulo, $autor, $precio, $genero = null,$editorial,$id_compra) {
        $db = getConnection();
        $resultado = $db->prepare("INSERT INTO libros (Titulo, Autor, Precio, Genero,Editorial, id_compra) VALUES (?, ?, ?, ?,?, ?)");
        $resultado->execute([$titulo, $autor, $precio, $genero,$editorial, $id_compra]);
    }
    

    public static function ActualizarLibro($id,$Titulo, $Autor, $Precio, $Genero,$Editorial,$pedido) {
        $db = getConnection();
        $resultado = $db->prepare("UPDATE libros SET Titulo = ?, Autor = ?, Precio = ?, Genero = ? , Editorial = ? , id_compra = ? WHERE ID_Libro = ?");

        $resultado->bindParam(1, $Titulo, PDO::PARAM_STR);
        $resultado->bindParam(2, $Autor, PDO::PARAM_STR);
        $resultado->bindParam(3, $Precio, PDO::PARAM_STR);
        $resultado->bindParam(4, $Genero, PDO::PARAM_STR);
        $resultado->bindParam(5, $Editorial, PDO::PARAM_STR); 
        $resultado->bindParam(6, $pedido, PDO::PARAM_INT); 
        $resultado->bindParam(7, $id, PDO::PARAM_INT); 
        return $resultado->execute();
    }


    public static function getLibroByPedido($id) {
        $db = getConnection();
        $resultado = $db->prepare("SELECT * FROM libros WHERE id_compra = ?");
        $resultado->bindParam(1, $id, PDO::PARAM_INT);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);

    }

    public static function getLibrosByPedido($id) {
        $db = getConnection();
        $resultado = $db->prepare("SELECT * FROM libros WHERE id_compra = ?");
        $resultado->bindParam(1, $id, PDO::PARAM_INT);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);

    }
    
    
    
    

    public static function EliminarLibro($id) {
        $db = getConnection();
        $resultado = $db->prepare("DELETE FROM libros WHERE id_libro = ?");
        // pasamos el parámetr con PDO::PARAM_INT para enteros
        $resultado->bindParam(1, $id, PDO::PARAM_INT);
        return $resultado->execute();
    }
    
    
    
}