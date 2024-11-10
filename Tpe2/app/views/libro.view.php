<?php
class LibroView {
    private $user;

    public function __construct($user) {

        $this->user = $user;
    }

    public function listarLibros($libro) {
        require './templates/libro/lista.phtml';
    }


    public function detallarLibro($libro){
        require './templates/libro/detalle.phtml';
    }

    public function editarLibro($libro,$pedidos){
        require './templates/libro/editar.phtml';
    }

    public function crearLibro($pedidos){
        require './templates/libro/crear.phtml';
    }

}