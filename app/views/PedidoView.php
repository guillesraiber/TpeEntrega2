<?php

class PedidoView{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function ListarPedidos($pedidos) {
        require './templates/pedido/lista.phtml';  // Asegúrate de que esta ruta es correcta
    }
}