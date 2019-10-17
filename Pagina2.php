<?php
// connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//make sure you're using the correct database
mysqli_select_db($db,'aplicacion') or die(mysqli_error($db));


// insert data into the cancion table
$query = 'INSERT INTO cancion
        (cancion_id, cancion_nombre, cancion_tipo, cancion_anio, cancion_genero)
    VALUES
        (1, "Valerian and the City of a Thousand Planets", 1, 2017,"pop"),
        (2, "El Pacto", 2, 2016,"metal"),
        (3, "Sweet Child O Mine", 3, 1987, "rock")';
mysqli_query($db,$query) or die(mysqli_error($db));



// insert data into the usuario table
$query = 'INSERT INTO usuario
        (usuario_id, usuario_nombre, usuario_password, usuario_email, usuario_tipo)
    VALUES
        (1, "David", "passwordDavid", "david@gmail.com","casual"),
        (2, "Adrian", "passwordAdrian", "adrian@gmail.com","casual"),
        (3, "Pepe", "passwordPepe", "pepe@gmail.com", "casual")';
mysqli_query($db,$query) or die(mysqli_error($db));


// insert data into the instrumento table
$query = 'INSERT INTO instrumento
        (instrumento_id, instrumento_fullname)
    VALUES
        (1, "Guitarra"),
        (2, "Piano"),
        (3, "Violin")';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Data inserted successfully!';

?>

