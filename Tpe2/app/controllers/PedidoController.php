<?php
require_once './app/models/PedidoModel.php';
require_once './app/views/PedidoView.php';
require_once './app/controllers/LibroController.php';

class PedidoController {
    private $model;
    private $view;
    private $libros;
    
    public function __construct($res) {
        $this->model = new PedidoModel();
        $this->view = new PedidoView($res->user);
        $this->libros = new LibroModel();
    }

    
    public function getPedidoById($id){
        $pedido = $this->model->getPedidoById($id);
        return $pedido;
    }

    public function getPedidos(){
        $pedidos = $this->model->getAllPedidos();
        return $pedidos;
    }


    public function detallePedido($id){
        $pedido = $this->model->getPedidoById($id);
        $libros = $this->libros->getLibrosByPedido($pedido->ID_Compra);
        $this->view->detallarLibro($libros,$pedido);
    }

    // C: Crear un nuevo pedido
    public function crearPedido() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'local' => $_POST['local'],
                'id_cliente' => $_POST['id_cliente'],
                'precio' => $_POST['precio'],
            ];
            $this->model->crearPedido($data);
            header("Location: " . BASE_URL . "pedidos");
        } else {
            require './templates/pedido/crear.phtml'; 
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
            
            $total = $_POST['Total'];
            $local = $_POST['Local'];


            $this->model->editarPedido($id, $total,$local);
            header("Location: " . BASE_URL . "pedidos");
        } else {
            $pedido = $this->model->getPedidoById($id);
            $this->view->editarPedido($pedido);
        }
    }

    // D: Eliminar pedido
    public function eliminarPedido($id) {
        $this->model->eliminarPedido($id);
        header("Location: " . BASE_URL . "pedidos");
    }
}
