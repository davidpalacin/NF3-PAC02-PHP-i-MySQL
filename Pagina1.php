<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS aplicacion';
mysqli_query($db,$query) or die(mysqli_error($db));

//make sure our recently created database is the active one
mysqli_select_db($db,'aplicacion') or die(mysqli_error($db));


//create the cancion table
$query = 'CREATE TABLE cancion (
        cancion_id        INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        cancion_nombre      VARCHAR(255)      NOT NULL,
                   NOT NULL DEFAULT 0,
        cancion_anio      SMALLINT UNSIGNED NOT NULL DEFAULT 0,
        cancion_genero      VARCHAR(255)      NOT NULL, 
        
        PRIMARY KEY (cancion_id),
        KEY cancion_tipo (cancion_tipo, cancion_anio) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die (mysqli_error($db));


//create the usuario table
$query = 'CREATE TABLE usuario (
        usuario_id    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
        usuario_nombre VARCHAR(255)      NOT NULL,
        usuario_password VARCHAR(255)      NOT NULL,
        usuario_email VARCHAR(255)      NOT NULL,
        usuario_tipo VARCHAR(100)     NOT NULL, 
        PRIMARY KEY (usuario_id) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));


//create the instrumento table
$query = 'CREATE TABLE instrumento ( 
        instrumento_id         INTEGER UNSIGNED    NOT NULL AUTO_INCREMENT, 
        instrumento_fullname   VARCHAR(255)        NOT NULL, 

        PRIMARY KEY (instrumento_id)
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Se ha creado!';
?>

<?php
$noRegistros = 4; 
$pagina = 1; 
if($_GET['pagina'])
    $pagina = $_GET['pagina']; 
$buskr=$_GET['searchs']; 
    
$sSQL = "SELECT * FROM cancion WHERE nombre LIKE '%$buskr%' LIMIT ".($pagina-1)*$noRegistros.",$noRegistros";
$result = mysqli_query($db,$sSQL) or die(mysqli_error($db));
	
//Exploracion de registros
echo "<table>";
while($row = mysqli_fetch_array($result)) { 
	echo "<tr><td height=80 align=center>";
	echo $row["cancion_id"]."<br>";
	echo "</td>
	<td align=center><img src='fotos/$row[movie_id]' width=70 height=70></td>
		<td>$row[movie_name].</td>
		<td align=center>$row[cancion_anio].</td>
	</tr>";
}

//Imprimiendo paginacion
$sSQL = "SELECT count(*) FROM cancion WHERE nombre LIKE '$buskr'"; //Cuento el total de registros
$result = mysqli_query($db,$sSQL);
$row = mysqli_fetch_array($result);
$totalRegistros = $row["count(*)"]; //Almaceno el total en una variable

$noPaginas = $totalRegistros/$noRegistros; //Determino la cantidad de paginas

?>
<tr>
    <td colspan="2" align="center"><? echo "<strong>Total registros: </strong>".$totalRegistros; ?></td>
    <td colspan="2" align="center"><? echo "<strong>Pagina: </strong>".$pagina; ?></td>
</tr>
<tr bgcolor="f3f4f1">
    <td colspan="4" align="right"><strong>Pagina:
<?php
for($i=1; $i<$noPaginas+1; $i++) { //Imprimo las paginas
	if($i == $pagina)
		echo "<font color=red>$i </font>"; 
	else
		echo "<a href=\"?pagina=".$i."&searchs=".$buskr."\" style=color:#000;> ".$i."</a>";
}
?>
	</strong></td>
</tr>
</table>

