<?php
function sessionAuthMiddleware($res) {
    session_start(); 
    if (isset($_SESSION['ID_USER'])) {
        // Si el usuario está autenticado, asignar valores a $res->user
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->name = $_SESSION['NAME_USER']; // Cambiar a NAME_USER para mantener consistencia
        $res->user->role = $_SESSION['ROLE_USER']; // Asignar el rol del usuario
    } else {
        $res->user = null; // Asegúrate de que esta línea esté para usuarios no autenticados
    }
}




