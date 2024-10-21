<?php
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once './app/views/categoria.view.php';
class CategoriaController {

    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView($res->user);
    }
    public function listar() {
        $generos = CategoriaModel::getAll();
        require './templates/categorias/lista.phtml';
    } 

    public function listarPorCategoria($genero) {
        $libros = CategoriaModel::getLibrosPorCategoria($genero);
        require './templates/categorias/porCategoria.phtml';
    }

    public function editarCategoria($genero) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevoGenero = $_POST['genero'];
            CategoriaModel::actualizarCategoriaPorGenero($genero, $nuevoGenero);
            header("Location: " . BASE_URL . "listarCategorias");
        } else {
            require './templates/categorias/editar.phtml';
        }
    }
    

    public function crearCategoria() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $genero = $_POST['genero'];
            CategoriaModel::crearCategoria($genero);
            header('Location: /listarCategorias');
        } else {
            require './templates/categorias/crear.phtml';
        }
    }

    public function eliminarCategoria($genero) {
        CategoriaModel::eliminarCategoria($genero);
        header("Location: " . BASE_URL . "listarCategorias");
    }
}
