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

    public static function getLibrosByCategory ($genero) {
        $db = getConnection();
        $resultado = $db->prepare("SELECT * FROM  libros WHERE genero = :genero");
        $resultado->bindParam(':genero', $genero);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }
    public static function crearLibro($titulo, $autor, $precio, $genero) {
        $db = getConnection();
        $resultado = $db->prepare("INSERT INTO libros (Titulo, Autor, Precio, Genero) VALUES (?, ?, ?, ?)");
        
        // Enlazar cada parámetro individualmente con su tipo
        $resultado->bindParam(1, $titulo, PDO::PARAM_STR); // Título como string
        $resultado->bindParam(2, $autor, PDO::PARAM_STR);  // Autor como string
        $resultado->bindParam(3, $precio, PDO::PARAM_INT); // Precio como entero o decimal
        $resultado->bindParam(4, $genero, PDO::PARAM_STR); // Género como string
        
        return $resultado->execute(); // Ejecutar la consulta
    }
    

    public static function ActualizarLibro($id, $Titulo, $Autor, $Precio, $Genero) {
        $db = getConnection();
        $resultado = $db->prepare("UPDATE libros SET Titulo = ?, Autor = ?, Precio = ?, Genero = ? WHERE ID_Libro = ?");
      
        $resultado->bindParam(1, $Titulo, PDO::PARAM_STR);
        $resultado->bindParam(2, $Autor, PDO::PARAM_STR);
        $resultado->bindParam(3, $Precio, PDO::PARAM_STR);
        $resultado->bindParam(4, $Genero, PDO::PARAM_STR);
        $resultado->bindParam(5, $id, PDO::PARAM_INT); // Asegúrate de vincular el ID del libro
    
        return $resultado->execute();
    }
    
    
    
    

    public static function EliminarLibro($id) {
        $db = getConnection();
        $resultado = $db->prepare("DELETE FROM libros WHERE id_libro = ?");
        // pasamos el parámetr con PDO::PARAM_INT para enteros
        $resultado->bindParam(1, $id, PDO::PARAM_INT);
        return $resultado->execute();
    }
    
    
    
}