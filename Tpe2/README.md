# Libreria
En esta primera entrega decidimos hacer la base de datos de una libreria que tiene ventas tanto online como en el local, hicimos una tabla 'usuario', otra 'libro', y finalmente una que relaciona las anteriores 'pedido'.
Integrantes: Guillermina Sraiber Luit- guilleluit18@gmail.com y Maximiliano Pais - mpais@alumnos.exa.unicen.edu.ar

ESTRUCTURA DE TABLAS:

+-------------+          +------------+           +--------+
|   usuario   |          |   compra   |           | libros |
+-------------+          +------------+           +--------+
| ID_Usuario  |          | ID_Compra  |<--------- |ID_Libro|
| Nombre      |          | Fecha      |           |Titulo  |
| Password    |          | Total      |           |Autor   |
| es_admin    |          | Local      |           |Genero  |
+-------------+          | ID_Cliente |           |Editorial|
                         +------------+           |Precio  |
                                                  |id_compra|
                                                  +--------+


