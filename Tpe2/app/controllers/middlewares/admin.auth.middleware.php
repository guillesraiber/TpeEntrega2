<?php
function adminAuthMiddleware($res) {
    if (!isset($res->user) || $res->user->role !== 'admin') {
        header('Location: ' . BASE_URL . 'showLogin');
        die();
    }
}


