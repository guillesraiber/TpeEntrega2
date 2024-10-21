
<?php
require_once __DIR__ . '/../../config.php';

class CategoriaModel {
    
    public static function getAll() {
        $db = getConnection();
        $resultado = $db->query("SELECT DISTINCT genero FROM libros;");
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function actualizarCategoriaPorGenero($generoActual, $nuevoGenero) {
        $db = getConnection();
        $stmt = $db->prepare("UPDATE libros SET genero = :nuevoGenero WHERE genero = :generoActual");
        $stmt->bindParam(":nuevoGenero", $nuevoGenero, PDO::PARAM_STR);
        $stmt->bindParam(":generoActual", $generoActual, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public static function getById($id) {
        $db = getConnection();
        $stmt = $db->prepare("SELECT genero FROM libros WHERE id_libro = :id_libro");
        $stmt->bindParam(":id_libro", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); // Devuelve el género actual
    }

    public static function crearCategoria($genero) {
        $db = getConnection();
        $stmt = $db->prepare("INSERT INTO libros (genero) VALUES (:genero)");
        $stmt->bindParam(":genero", $genero, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function eliminarCategoria($genero) {
        $db = getConnection();
        $stmt = $db->prepare("DELETE FROM libros WHERE genero = :genero");
        $stmt->bindParam(":genero", $genero, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function getLibrosPorCategoria($genero) {
        $db = getConnection();
        $stmt = $db->prepare("SELECT * FROM libros WHERE genero = :genero");
        $stmt->bindParam(":genero", $genero, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

