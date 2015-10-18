<?php


//Get JSON from Automatic Api Rest
$json = file_get_contents("http://localhost/api/api/get/usuarios/id_administrador-nombre_administrador-password/");
//Decode JSON

$json = json_decode($json);
 
for($i=0;$i<count($json);$i++){
    echo $json[$i]->campo;
}

?>
