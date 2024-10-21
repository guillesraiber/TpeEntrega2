<?php
require_once './app/models/PedidoModel.php';
require_once './app/views/PedidoView.php';

class PedidoController {
    private $model;
    private $view;
    
    public function __construct($res) {
        $this->model = new PedidoModel();
        $this->view = new PedidoView($res->user);
    }

    // C: Crear un nuevo pedido
    public function crearPedido() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'local' => $_POST['local'],
                'id_libro' => $_POST['id_libro'],
                'id_cliente' => $_POST['id_cliente'],
                'precio' => $_POST['precio'],
            ];
            $this->model->crearPedido($data);
            header("Location: " . BASE_URL . "pedidos");
        } else {
            require './templates/pedido/crear.phtml'; // Asegúrate de tener un formulario de creación de pedidos aquí
        }
    }

    // R: Listar pedidos
    public function ListarPedidos() {
        $pedidos = $this->model->getAllPedidos(); 
        $this->view->ListarPedidos($pedidos);  
    }

    // U: Editar pedido
    public function editarPedido($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'local' => $_POST['local'],
                'id_libro' => $_POST['id_libro'],
                'id_cliente' => $_POST['id_cliente'],
                'precio' => $_POST['precio'],
            ];
            $this->model->editarPedido($id, $data);
            header("Location: " . BASE_URL . "pedidos");
        } else {
            $pedido = $this->model->getPedidoById($id);
            require './templates/pedido/editar.phtml';
        }
    }

    // D: Eliminar pedido
    public function eliminarPedido($id) {
        $this->model->eliminarPedido($id);
        header("Location: " . BASE_URL . "pedidos");
    }
}
