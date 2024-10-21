<?php
require_once './app/models/LibroModel.php';
require_once './app/models/CategoriaModel.php';
require_once './app/views/libro.view.php';

class LibroController {
    private $model;
    private $view;
    public function __construct($res) {
        $this->model = new LibroModel();
        $this->view = new LibroView($res->user);
    }
    public function listarLibros() {
        $libro = LibroModel::getAllLibros();
        require './templates/libro/lista.phtml';
    }

    public function detalleLibro($id) {
        $libro = LibroModel::getLibroById($id);
        require './templates/libro/detalle.phtml';
    }

    public function crearLibro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $autor = trim($_POST['autor']);
            $precio = trim($_POST['precio']);
            $genero = trim($_POST['genero']);
    
            // Validación: Asegurarse de que todos los campos estén completos
            if (empty($titulo) || empty($autor) || empty($precio) || empty($genero)) {
                $error = "Todos los campos son obligatorios, intente nuevamente.";
                $categorias = CategoriaModel::getAll(); // Para seguir mostrando las categorías en el formulario
                require './templates/libro/crear.phtml'; // Volver a cargar la vista con el error
            } else {
                // Crear libro si todos los campos están completos
                LibroModel::crearLibro($titulo, $autor, $precio, $genero);
                header('Location: ' . BASE_URL . 'libros');
                exit(); // Para asegurarse de que no se siga ejecutando el código
            }
        } else {
            $categorias = CategoriaModel::getAll();
            require './templates/libro/crear.phtml';
        }
    }
    

    public function editarLibro($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Titulo = $_POST['titulo'];
            $Autor = $_POST['autor'];
            $Precio = $_POST['precio'];
            $Genero = $_POST['genero'];
            
            // Agrega un manejo de error simple aquí
            if (empty($Titulo) || empty($Autor) || empty($Precio) || empty($Genero)) {
                echo "Todos los campos son obligatorios.";
                exit();
            }
            
            LibroModel::ActualizarLibro($id, $Titulo, $Autor, $Precio, $Genero);
            header("Location: " . BASE_URL . "libros");
            exit();
        } else {
            $libro = LibroModel::getLibroById($id);
            if ($libro) {
                $categorias = CategoriaModel::getAll();
                require './templates/libro/editar.phtml';
            } else {
                echo "El libro no existe.";
                exit(); 
            }
        }
    }
    

    public function eliminarLibro($id) {
        
        if (LibroModel::EliminarLibro($id)) {
            // Redirige a la lista de libros 
            header("Location: " . BASE_URL . "libros");
            exit();
        } else {
            echo "Error al eliminar el libro.";
        }
    }
    
}