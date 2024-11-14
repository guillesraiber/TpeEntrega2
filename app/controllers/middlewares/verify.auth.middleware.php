<?php 
    // Definición de una función que actúa como middleware para verificar si el usuario está autenticado.
    function verifyAuthMiddleware($res) {
        // Verifica si la propiedad 'user' existe en el objeto $res (es decir, si hay un usuario autenticado).
        if($res->user) {
            // Si existe un usuario autenticado, la función termina sin hacer nada más.
            return;
        } else {
            // Si no hay un usuario autenticado, se redirige al usuario a la página de login.
            // BASE_URL es probablemente una constante que define la URL base del sitio.
            header('Location: ' . BASE_URL . 'showLogin');
            
            // die() detiene la ejecución del script para asegurarse de que no se ejecuta ningún código después de la redirección.
            die();
        }
    }
?>
