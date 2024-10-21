<?php
class CategoriaView {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function ListaCategorias($categorias) {
        require './templates/categorias/lista.phtml';
    }

}
