<?php

require('connectionBD.php');
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente

//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.html'); 
  exit();
}

$conn=connection();

if($conn!=null){
    //header('Location: login.html'); 
    //exit();
}

$alta=$_POST["alta"];

if($alta != null && $alta=="true"){
    altaArduino($conn);
}


$borrar=$_POST["borrar"];
if($borrar != null && $borrar!="false"){
    echo "llamando a borrar";
    $id=$_POST["id"];
    borrarArduino($conn,$id);
}
$actualizar=$_POST["actualizar"];
if($actualizar != null && $actualizar!="false"){
    $id=$_POST["id"];
    updateArduino($conn,$id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arduino project</title>

    <!-- Bootstrap Core CSS -->
      <link rel="stylesheet" type="text/css" href="css/usuarios.css" >
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
       <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" src="angular.js"></script>
  

 

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

        <?php 
         $grafica="function drawChart() { var data = google.visualization.arrayToDataTable([['time', 'temperatura','humedad'],";
            $medidas="SELECT * from medidas";
            $i=0;
           


            foreach ($conn->query($medidas) as $row) {
                    //echo $row["medida"];
                    $grafica=$grafica . "['".$row["fecha"]."'".",".$row["temperatura"].",".$row["humedad"]."],";
                    //$i++;
                  //  echo "$grafica \n";
            }

            $grafica=$grafica . "]);";

            echo $grafica;
       ?>

       

        var options = {
          title: 'MEDIDAS',
          curveType: 'function',
          legend: { position: 'bottom' },
           series: {
          // Gives each series an axis name that matches the Y-axis below.
              0: {axis: 'Temps'},
              1: {axis: 'humedad'}
            },
            axes: {
          // Adds labels to each axis; they don't have to match the axis names.
              y: {
                Temps: {label: 'Temperatura (Celsius)'},
                humedad: {label: 'humedad'}
              }

        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

</head>

<body ng-app>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Arduino project</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>kapi</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Dani</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
               
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['usuario']?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                      
                        
                        <li>
                            <a href="arduino.php"><i class=" glyphicon glyphicon-wrench fa-fw "></i>Arduinos</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-list fa-fw"></i> Interface</a>
                        </li>
                         <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-tint fa-fw"></i>Measures</a>
                        </li>
                         <li>
                            <a href="user.php"><i class="glyphicon glyphicon-user fa-fw"></i> User</a>
                        </li>
                        <li>
                            <a href="grafica.php"><i class="glyphicon glyphicon-user fa-fw"></i> Gráfica</a>
                        </li>
                         
   
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

             <div id="curve_chart" style="width: 900px; height: 500px"></div>




        </div>
            
                

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


</body>

</html>

<?php


  mysql_close();
?>