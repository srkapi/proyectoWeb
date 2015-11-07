
<?php


session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente

//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.html'); 
  exit();
}
$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "proyecto";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$alta=$_POST["alta"];

if($alta != null && $alta=="true"){
    altaUser($conn);
}


$borrar=$_POST["borrar"];
if($borrar != null && $borrar!="false"){

    $id=$_POST["id"];
    borrar($conn,$id);
}
$actualizar=$_POST["actualizar"];
if($actualizar != null && $actualizar!="false"){
    $id=$_POST["id"];
    update($conn,$id);
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

      $(function() {
        $( "#dialog" ).dialog({
          autoOpen: false,
          show: {
            effect: "blind",
            duration: 1000
          },
          hide: {
            effect: "explode",
            duration: 1000
          }
        });
     
        $( "#opener" ).click(function() {
          $( "#dialog" ).dialog( "open" );
        });
    });

        function deleteUser(id,nombre){
            var respuesta = confirm("¿Estás seguro de eliminar a "+nombre+"?");
          //  document.forms[4].value=id;
            //document.forms[5].value="true";
            
            document.forms[0].elements[5].value=id;
            document.forms[0].elements[6].value="true"; //borrar 
            document.forms[0].elements[7].value="false";//alta
            document.forms[0].elements[8].value="false";//actualiza
            document.user.submit();
        }

        function updateUser(id,nombre,apellido,user){
             document.forms[1].elements[0].placeholder=nombre;
            document.forms[1].elements[1].placeholder=apellido;
            document.forms[1].elements[2].placeholder=user;
            document.forms[1].elements[5].value=id;
            document.forms[1].elements[6].value="false";
            document.forms[1].elements[7].value="false";
            document.forms[1].elements[8].value="true";
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
                            <a href="tables.html"><i class=" glyphicon glyphicon-wrench fa-fw "></i>Arduinos</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-list fa-fw"></i> Interface</a>
                        </li>
                         <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-tint fa-fw"></i>Measures</a>
                        </li>
                         <li>
                            <a href="forms.html"><i class="glyphicon glyphicon-user fa-fw"></i> User</a>
                        </li>
                         
   
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            
                
                <div class="col-lg-7">
                    <div class="margenUser">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                   
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                         <?php
                                                
                                            $result = "SELECT * from user";

                                           // $x=$conn->query($result);
                                            
                                         foreach ($conn->query($result) as $row) {
                                                echo '<tr>';
                                                 echo '<td>'. $row['iduser'] . '</td>';
                                                echo '<td>'. $row['name'] . '</td>';
                                                echo '<td>'. $row['apellido'] . '</td>';
                                                echo '<td>'. $row['user'] . '</td>';
                                                echo '<td><button class="glyphicon glyphicon-trash" onclick="deleteUser('.$row['iduser'].','.'\''.$row['name'].'\''.')"/></td>';
                                                echo '<td><button class="glyphicon glyphicon-pencil" onclick="updateUser('.$row['iduser'].','.'\''.$row['name'].'\''.','.'\''.$row['apellido'].'\''.','.'\''.$row['user'].'\''.')"ng-click="edit=!edit"></td>';
                                                echo '</tr>';
                                            }

                                     

                                         ?>
                                       
                                    </tbody>
                                </table>
                                <button type="button" ng-click="checked=!checked"  class="btn btn-success btn-circle btn-lg"><i class="glyphicon glyphicon-plus"></i></button>
                                <div ng-show="checked">
                                    <form id="user" name="user" action="user.php" method="post">
                                        <p>
                                        Nombre: <input type="text" ng-model="name" name="nombre" autofocus required />
                                        <br />
                                        <p>
                                        Apellido: <input type="text" ng-model="apellido" name="apellido" autofocus required />
                                        <br />
                                        <p>
                                        user <input type="text" ng-model="usuario" name="user" autofocus required />
                                        <br />
                                        
                                        <p>
                                        Password: <input type="pass" ng-model="pass" name="pass" autofocus required />
                                        <br />
                                        <p>
                                        Re-password: <input type="pass"  autofocus required />
                                        <br />
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="borrar" value="false">
                                        <input type="hidden" name="alta" value="true">
                                        <input type="hidden" name="actualizar" value="false">
                                        <button type="submit" >Añadir</button>
                                 </form> 



                                </div>
                                <div ng-hide="checked"></div>
                                


                        </div>
                       

                            <!-- /.table-responsive -->
                     </div>


                  
                    </div>

                        <!-- /.panel-body -->
               </div>
         </div>
         <div ng-show="edit">
            <form id="update" name="update" action="user.php" method="post">
              <p>
                Nombre: <input type="text"  name="nombre" autofocus required />
                <br />
                <p>
                  Apellido: <input type="text"   name="apellido" autofocus required />
                       <br />
                       <p>
                       user <input type="text"   name="user" autofocus required />
                       <br />
                       
                       <p>
                       Password: <input type="pass"   name="pass" autofocus required />
                       <br />
                       <p>
                       Re-password: <input type="pass"  autofocus required />
                       <br />
                       <input type="hidden" name="id">
                       <input type="hidden" name="borrar" value="false">
                       <input type="hidden" name="alta" value="false">
                       <input type="hidden" name="actualizar" value="true">
                       <button type="submit" >Añadir</button>
                </form> 
           
                </div>
                <div ng-hide="edit"></div>

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


function altaUser($conn)
{
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"]; 
        $pass=$_POST["pass"]; 
        $user=$_POST["user"]; 
        $sql = "INSERT INTO user (name,apellido,pass,user)
            VALUES ('$nombre','$apellido','$pass','$user')";


        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else{
            echo "fatal error";
        }


    mysql_close();
}

function borrar($conn, $id){
    $sql="DELETE FROM user
            WHERE iduser='$id'";
      if ($conn->query($sql) === TRUE) {
            echo "delete successfully";
        } else{
            echo "fatal error";
        }

}

function update($conn, $id){
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"]; 
        $pass=$_POST["pass"]; 
        $user=$_POST["user"]; 
    $sql="UPDATE user SET name='$nombre', apellido='$apellido',pass='$pass',user='$user' WHERE iduser='$id' ";
    echo $sql;
      if ($conn->query($sql) === TRUE) {
            echo "update successfully";
        } else{
            echo "fatal error";
        }

}


?>