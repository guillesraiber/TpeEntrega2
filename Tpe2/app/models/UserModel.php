<?php
require_once './config.php';

class UserModel {
    public function getUserByName($name) {    
        $db = getConnection();
        $query = $db->prepare("SELECT * FROM usuario WHERE Nombre = ?");
        $query->execute([$name]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}


    
    
