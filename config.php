<?php

const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'libreria';
const DB_HOST = 'localhost';

function getConnection() {
    try {
        $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;

    } catch (PDOException $e) {
        if($e->getCode() == 1049){
            try {
                $connection = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PASS);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Crear la base de datos
                $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME." CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
                $connection->exec($sql);

                // Seleccionar la base de datos
                $connection->exec("USE ".DB_NAME);

                // Crear tabla usuario
                $sql = "CREATE TABLE IF NOT EXISTS usuario (
                        ID_Usuario int(11) NOT NULL AUTO_INCREMENT,
                        Nombre varchar(50) NOT NULL,
                        Password varchar(60) NOT NULL,
                        es_admin varchar(60) DEFAULT '0',
                        PRIMARY KEY (ID_Usuario)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
                $connection->exec($sql);

                // Crear tabla libros
                $sql = "CREATE TABLE IF NOT EXISTS libros (
                        ID_Libro int(11) NOT NULL AUTO_INCREMENT,
                        Titulo varchar(50) NOT NULL,
                        Autor varchar(50) NOT NULL,
                        Genero varchar(250) NOT NULL,
                        Editorial varchar(50) NOT NULL,
                        Precio double NOT NULL,
                        PRIMARY KEY (ID_Libro)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
                $connection->exec($sql);

                // Crear tabla compra
                $sql = "CREATE TABLE IF NOT EXISTS compra (
                        ID_Compra int(11) NOT NULL AUTO_INCREMENT,
                        Fecha_compra date NOT NULL,
                        Total double NOT NULL,
                        Local varchar(50) NOT NULL,
                        ID_Libro int(11) NOT NULL,
                        ID_Cliente int(11) NOT NULL,
                        PRIMARY KEY (ID_Compra),
                        FOREIGN KEY (ID_Libro) REFERENCES libros(ID_Libro)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
                $connection->exec($sql);

                return $connection;
            } catch (PDOException $e) {
                die("Error al crear la base de datos: " . $e->getMessage());
            }
        } else {
            die("Error en la conexión: " . $e->getMessage());
}
}
}