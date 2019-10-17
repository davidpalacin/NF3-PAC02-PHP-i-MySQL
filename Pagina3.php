<?php

//Mostrar relaciones entre tablas
$query = Select cancion_nombre, usuario_nombre
     From cancion, usuario
     Where cancion.cancion_id = usuario.usuario_id;

?>

