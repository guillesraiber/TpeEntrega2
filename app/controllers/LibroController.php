<?php
require_once './app/models/LibroModel.php';
require_once './app/views/libro.view.php';
require_once './app/controllers/PedidoController.php';

class LibroController {
    private $model;
    private $view;
    private $pedido;



    public function __construct($res) {
        $this->model = new LibroModel();
        $this->view = new LibroView($res->user);
        $this->pedido = new PedidoController($res);
    }
    public function listarLibros() {
        $libros = LibroModel::getAllLibros();
        $this->view->listarLibros($libros);
    }

    public function detalleLibro($id) {
        $libro = LibroModel::getLibroById($id);
        $pedido = $this->pedido->getPedidoById($libro->ID_Libro);
        $this->view->detallarLibro($libro);
    }




    public function crearLibro() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titulo = trim($_POST['titulo']);
            $autor = trim($_POST['autor']);
            $precio = trim($_POST['precio']);
            $genero = trim($_POST['genero']);
            $editorial = trim($_POST['editorial']);
            $pedido = $_POST['pedido'];
            var_dump($pedido);
            

            // Crear libro si todos los campos están completos
            LibroModel::crearLibro($titulo, $autor, $precio, $genero,$editorial,$pedido);
            header('Location: ' . BASE_URL . 'libros');
            exit(); // Para asegurarse de que no se siga ejecutando el código
            
        } else {
            $pedidos = $this->pedido->getPedidos();
            $this->view->crearLibro($pedidos);
        }
    }
    

    public function editarLibro($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Titulo = $_POST['titulo'];
            $Autor = $_POST['autor'];
            $Precio = $_POST['precio'];
            $Genero = $_POST['genero'];
            $editorial = trim($_POST['editorial']);
            $pedido = $_POST['pedido'];
            // Agrega un manejo de error simple aquí
            if (empty($Titulo) || empty($Autor) || empty($Precio) || empty($Genero)) {
                echo "Todos los campos son obligatorios.";
                exit();
            }
            
            LibroModel::ActualizarLibro($id, $Titulo, $Autor, $Precio, $Genero,$editorial,$pedido);
            header("Location: " . BASE_URL . "libros");
            exit();
        } else {
            $libro = LibroModel::getLibroById($id);
            if ($libro) {
                $pedidos = $this->pedido->getPedidos();
                $this->view->editarLibro($libro,$pedidos);
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