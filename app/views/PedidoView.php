<?php

class PedidoView{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function ListarPedidos($pedidos) {
        require './templates/pedido/lista.phtml';  
    }



    public function detallarLibro($libros,$pedido){
        require './templates/pedido/detallePedido.phtml'; 
    }


    public function editarPedido($pedido){
        require './templates/pedido/editarPedido.phtml'; 
    }

}
