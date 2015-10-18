<?php
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "proyecto";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo "fallo connection";
}else{
   echo "Connection ok";
}

$coorkml=$_POST["coorkml"];
$tipo=$_POST["tipo"]; 
$ubicacion=$_POST["ubicacion"]; 

$sql = "INSERT INTO YUM_item (coorkml,tipo,ubicacion)
	VALUES ('$coorkml','$tipo','$ubicacion')";

echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else{
    echo "fatal error";
}

?> 
