<?php
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "proyecto";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo('No pudo conectarse: ' . mysql_error());
}else{
	echo("va perfec");
}

$id_arduino=$_GET["idArduino"];


$tem=$_GET["temperatura"];
$hum=$_GET["humedad"];

$fecha=date("d/m/yyyy hh:mm");

$consulta="INSERT INTO medidas (idArduino,tipo,medida)
            VALUES ($id_arduino,'temperatura','$tem')";

if ($conn->query($consulta) === TRUE) {
	echo ("New record created successfully");
} else{
    echo ("fatal error");
}

$consulta2="INSERT INTO medidas (idArduino,tipo,medida)
            VALUES ($id_arduino,'humedad','$hum')";



if ($conn->query($consulta2) === TRUE) {
	echo ("New record created successfully");
} else{
    echo ("fatal error");
}

mysql_close();
?>



