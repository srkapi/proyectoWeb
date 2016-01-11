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

$ch = curl_init("http://192.168.0.189/medidas.json");
$fp = fopen("/var/www/html/medidas/medidas.json", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

$filePath = "/var/www/html/medidas/medidas.json";

if(file_exists($filePath)) {
    echo "File Found.";
    $handle = fopen($filePath, "r");

    $fileContents = fread($handle, filesize($filePath));

    fclose($handle);
    if(!empty($fileContents)) {

    	//echo $fileContents;

    	$data =json_decode($fileContents,true);

    	//print_r($data);

       	$object = (object)$data["medidas:"];

       	
    	foreach ( $object as $variable) {
    		$tem= $variable['temperatura'];
            echo $tem;
    		$id= $variable['id'];
    		$fecha= $variable['fecha'];
    		echo $fecha;
            $humedad= $variable['humedad'];
    		$consulta="INSERT INTO medidas (idArduino,temperatura,humedad,fecha)
            VALUES (6,'$tem','$humedad','$fecha')";
			if ($conn->query($consulta) === TRUE) {
					echo ("New record created successfully");
			} else{
			    echo ("fatal error");
			}


		}

    	mysql_close();
    }
 
}
else {
    echo "File Not Found.";
}

?>
