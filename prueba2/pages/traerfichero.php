<?php

$ch = curl_init("http://158.49.228.208/medidas.json");
$fp = fopen("/var/www/html/medidas/medidas.json", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);

$filePath = "/var/www/html/medidas/medidas.json";
if(file_exists($filePath)) {
    echo "File Found.";
    $handle       = fopen($filePath, "r");
    $fileContents = fread($handle, filesize($filePath));
    fclose($handle);
    if(!empty($fileContents)) {
        echo "<pre>".$fileContents."</pre>";
    }
}
else {
    echo "File Not Found.";
}

?>