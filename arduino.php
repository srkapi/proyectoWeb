
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
  <link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" src="angular.js"></script>
  

 

    <script type="text/javascript">

    

        function deleteArduino(id){
            var respuesta = confirm("¿Estás seguro de eliminar el arduino?");
            alert(id);

            if(respuesta){
                document.forms[0].id.value=id;
                document.forms[0].borrar.value="true"; //borrar 
                document.forms[0].alta.value="false";//alta
                document.forms[0].actualizar.value="false";//actualiza
                document.forms[0].submit();
            }
        }

        function updateArduino(id,coor,desc){
             document.forms[1].elements[0].placeholder=coor;
            document.forms[1].elements[1].placeholder=desc;
            document.forms[1].id.value=id;
             document.forms[1].borrar.value="false"; //borrar 
                document.forms[1].alta.value="false";//alta
                document.forms[1].actualizar.value="true";//actualiza
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
                            <a href="interface.php"><i class="glyphicon glyphicon-list fa-fw"></i> Interface</a>
                        </li>
                         <li>
                            <a href="grafica.php"><i class="glyphicon glyphicon-tint fa-fw"></i>Measures</a>
                        </li>
                         <li>
                            <a href="user.php"><i class="glyphicon glyphicon-user fa-fw"></i> User</a>
                        </li>
                        <li>
                            <a href="sketch.php"><i class="glyphicon glyphicon-user  glyphicon-file"></i>Sketch</a>
                        </li>
                         
                         
   
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
                
                <div class="col-lg-10">
                    <div class="margenUser">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Arduino
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                   
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>coordenadas</th>
                                            <th>Description</th>
                                            <th>IP</th>
                                            <th>Active</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         <?php
                                                
                                            $result = "SELECT idYun_item,coorKML,descripcion,IP,active  from Yun_item join interface on (idYun_item=idinterface)  ";

                                           // $x=$conn->query($result);
                                            
                                         foreach ($conn->query($result) as $row) {
                                                echo '<tr>';
                                                 echo '<td>'. $row['idYun_item'] . '</td>';
                                                echo '<td>'. $row['coorKML'] . '</td>';
                                                echo '<td>'. $row['descripcion'] . '</td>';
                                                echo '<td>'. $row['IP'] . '</td>';
                                                //echo '<td>'. $row['active'] . '</td>';
                                               
                                               if($row['active']){
                                                    echo '<td><button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>
                                                            </button></td>';
                                                }else{
                                                    echo '<td><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                                                            </button></td>';
                                                }
                                                echo '<td><button class="glyphicon glyphicon-trash" onclick="deleteArduino('.$row['idYun_item'].')"/></td>';
                                                echo '<td><button class="glyphicon glyphicon-pencil"
                                                  onclick="updateArduino('.$row['idYun_item'].','.'\''.$row['coorKML'].'\''.','.'\''.$row['descripcion'].'\''.')" ng-click="edit=!edit"/></td>';
                                                echo '</tr>';
                                            }

                                     

                                         ?>
                                       
                                    </tbody>
                                </table>
                                <button type="button" ng-click="checked=!checked"  class="btn btn-success btn-circle btn-lg"><i class="glyphicon glyphicon-plus"></i></button>
                                <div ng-show="checked">
                                     <div class="col-lg-6">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                New Arduino
                                            </div>
                                            <div class="panel-body">
                                                <form id="arduino" name="arduino" action="arduino.php" method="post">
                                                    <p>
                                                    Coordenadas: <input type="text" ng-model="coor" name="coor" autofocus required />
                                                    <br />
                                                    <p>
                                                    Ubicacion: <input type="text" ng-model="ubi" name="ubi" autofocus required />
                                                    <br />
                                                    <p>
                                                    Descripcion: <input type="text" ng-model="desc" name="desc" autofocus required />
                                                    <br />
                                                    <div class="col-lg-14">
                                                    <div class="panel panel-warning">
                                                        <div class="panel-heading">
                                                            Inteface
                                                        </div>
                                                        <div class="panel-body">
                                                             <p>
                                                                Tipo: <input type="text"  name="tipo" autofocus required />
                                                                <br />
                                                                <p>
                                                                MAC: <input type="text"  name="mac" autofocus required />
                                                                <br />
                                                                <p>
                                                                IP: <input type="text"  name="ip" autofocus required />
                                                                <br />
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                    

                                                    <input type="hidden" name="id">
                                                    <input type="hidden" name="borrar" value="false">
                                                    <input type="hidden" name="alta" value="true">
                                                    <input type="hidden" name="actualizar" value="false">
                                                    <button type="submit" >Añadir</button>
                                             </form> 


                                             </div>
                                        <div class="panel-footer">
                                            New Arduino
                                        </div>
                                        </div>
                                    <!-- /.col-lg-4 -->
                                </div>
                                <div ng-hide="checked"></div>
                                

                </div>

                        </div>
                       

                            <!-- /.table-responsive -->
                     </div>


                  
                    </div>

                        <!-- /.panel-body -->
               </div>
         </div>
         <div ng-hide="edit">
             <div class="col-lg-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Edit Arduino
                        </div>
                        <div class="panel-body">

                              <form id="edit" name="edit" action="arduino.php" method="post">
                                   <p>
                                   Coordenadas: <input type="text" ng-model="coor" name="coor" autofocus required />
                                    <br />
                                    <p>
                                    Ubicacion: <input type="text" ng-model="ubi" name="ubi" autofocus required />
                                    <br />
                                    <p>
                                    Descripcion: <input type="text" ng-model="desc" name="desc" autofocus required />
                                    <br />
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="borrar" value="false">
                                    <input type="hidden" name="alta" value="false">
                                    <input type="hidden" name="actualizar" value="true">
                                    <button type="submit" >Añadir</button>
                               </form>
                           
                        </div>
                        <div class="panel-footer">
                            Update Arduino
                        </div>
                    </div>
             </div>
         <div ng-show="edit"></div>

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


function altaArduino($conn)
{

        $coor=$_POST["coor"];
        $ubi=$_POST["ubi"];
        $desc=$_POST["desc"];
        $tipo=$_POST["tipo"];
        $mac=$_POST["mac"];
        $ip=$_POST["ip"];
        $sql = "INSERT INTO Yun_item (coorKML,descripcion,ubicacion)
            VALUES ('$coor','$desc','$ubi')";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else{
            echo "fatal error";
        }



        $sql = "INSERT INTO interface (tipo,MAC,IP)
            VALUES ('$tipo','$mac','$ip')";
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else{
            echo "fatal error";
        }


  
}

function borrarArduino($conn, $id){
    $sql="DELETE FROM Yun_item
            WHERE idYun_item='$id'";
            echo $id;
      if ($conn->query($sql) === TRUE) {
            echo "delete successfully";
        } else{
            echo "fatal error";
        }

}

function updateArduino($conn, $id){
       $coor=$_POST["coor"];
        $ubi=$_POST["ubi"];
        $desc=$_POST["desc"];
        echo $id;
    $sql="UPDATE Yun_item SET coorKML='$coor', ubicacion='$ubi', descripcion='$desc' WHERE idYun_item='$id'";
      if ($conn->query($sql) === TRUE) {
            echo "update successfully";
        } else{
            echo "fatal error";
        }

}

  mysql_close();
?>