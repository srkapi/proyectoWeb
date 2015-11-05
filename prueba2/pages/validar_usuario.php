<?php
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "proyecto";

// Create connection
$usuario = $_POST['admin'];
$pass = $_POST['password_usuario'];
 
if(empty($usuario) || empty($pass)){
  header("Location: index.html");
  echo  "no contiene los dos datos";
  exit();
}
 
mysql_connect('localhost','root','alberto') or die("Error al conectar " . mysql_error());
mysql_select_db('proyecto') or die ("Error al seleccionar la Base de datos: " . mysql_error());
 
$result = mysql_query("SELECT * from user where user='" . $usuario . "'");
 
if($row = mysql_fetch_array($result)){
  if($row['pass'] == $pass){
  session_start();
  $_SESSION['usuario'] = $usuario;
  header("Location: index.php");
  }else{
    echo "no eres usuario cabron";
  }
}


mysql_close();
?>