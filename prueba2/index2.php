<?php


session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente

//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.html'); 
  exit();
}
 ?>
  <h1>BIENVENIDO</h1>
  <a href="logout.php">Cerrar Sesión</a>
 <?
?>
