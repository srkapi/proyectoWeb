<?php
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "proyecto";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo('No pudo conectarse: ' . mysql_error());
}else{
	echo "Va perfecto \n" ;
}

$sql="SELECT IP from interface join Yun_item on (idinterface=idYun_item) where active=1;";
$nombre="/var/www/html/traerFichero/ip.txt"; 
$fp = fopen($nombre, "w");

fclose($fp);

 if(file_exists($nombre)){
 	
	if($archivo = fopen($nombre, "w")) {
		echo $sql;
		foreach ($conn->query($sql) as $row) {
			echo "pasososo";
			if(fwrite($archivo,  $row["IP"]. "\n"))
			{
			    echo "Se ha ejecutado correctamente";
			}
                   
		}
		 fclose($archivo);
	}
  }

 
   
mysql_close();

?>
