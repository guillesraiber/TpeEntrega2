# Libreria
En esta primera entrega decidimos hacer la base de datos de una libreria que tiene ventas tanto online como en el local, hicimos una tabla 'usuario', otra 'libro', y finalmente una que relaciona las anteriores 'pedido'.
Integrantes: Guillermina Sraiber Luit- guilleluit18@gmail.com y Maximiliano Pais - mpais@alumnos.exa.unicen.edu.ar

ESTRUCTURA DE TABLAS:


 USUARIOS 

| COLUMNA | TIPO | DESCRIPCIÓN  |
| :---- | :---- | :---- |
| ID\_Usuarios | int | ID único, es la clave primaria. |
| Nombre | varchar | Nombre del usuario, index unico |
| Password | int  | Clave del usuario. |
| es\_admin | varchar | Define si es administrador |

LIBROS

| COLUMNA | TIPO | DESCRIPCION  |
| :---- | :---- | :---- |
| ID\_Libros | int  | ID único, es la clave primaria. |
| Titulo | varchar | Titulo del libro |
| Autor | varchar | Autor del libro. |
| Editorial | varchar | Editorial del libro. |
| Precio | double | Precio del libro. |
| id_compra | int | ID unico de la compra, clave foranea |

COMPRA

| COLUMNA | TIPO | DESCRIPCIÓN |
| :---- | :---- | :---- |
| ID\_Compra | int | ID único de la compra, clave primaria. |
| Fecha\_compra | date | Fecha del pedido |
| Local | varchar | Local donde se realizó el pedido |
| Total | double | Precio total del pedido |

![Diagrama](https://github.com/user-attachments/assets/1bcfb415-4ac6-4d4f-899f-4adfa4ebf60f)

