# Libreria
En esta primera entrega decidimos hacer la base de datos de una libreria que tiene ventas tanto online como en el local, hicimos una tabla 'usuario', otra 'libro', y finalmente una que relaciona las anteriores 'pedido'.
Integrantes: Guillermina Sraiber Luit- guilleluit18@gmail.com y Maximiliano Pais - mpais@alumnos.exa.unicen.edu.ar

ESTRUCTURA DE TABLAS:


 USUARIOS 

| COLUMNA | TIPO | DESCRIPCIÓN  |
| :---- | :---- | :---- |
| id\_usuarios | int | ID único, es la clave primaria. |
| nombre\_usuario | varchar | Nombre del usuario. |
| dni\_usuario | int | DNI del usuario. |
| contacto\_usuario | int | Contacto del usuario. |
| clave\_usuario | int  | Clave del usuario. |

LIBROS

| COLUMNA | TIPO | DESCRIPCION  |
| :---- | :---- | :---- |
| id\_libros | int  | ID único, es la clave primaria. |
| titulo | varchar | Titulo del libro |
| autor | varchar | Autor del libro. |
| editorial | varchar | Editorial del libro. |
| precio | double | Precio del libro. |

PEDIDO

| COLUMNA | TIPO | DESCRIPCIÓN |
| :---- | :---- | :---- |
| id\_pedido | int | ID único del pedido, clave primaria. |
| id\_cliente | int | ID único del usuario, clave foránea. |
| id\_libro | int | ID único del libro, clave foránea. |
| fecha | date | Fecha del pedido |
| local | varchar | Local donde se realizó el pedido |
| total | varchar | Precio total del pedido |

