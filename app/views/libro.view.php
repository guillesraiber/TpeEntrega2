<?php
class LibroView {
    private $user;

    public function __construct($user) {

        $this->user = $user;
    }

    public function listarLibros($libro) {
        require './templates/libro/lista.phtml';
    }

}