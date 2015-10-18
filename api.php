<?php
// Activamos las sesiones para el funcionamiento de flash['']
@session_start();
 echo "holamundo";
require 'Slim-2.6.0/Slim/Slim.php';
// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();
 
// Creamos la aplicación.
$app = new \Slim-2.6.0\Slim\Slim();
 
// Configuramos la aplicación. http://docs.slimframework.com/#Configuration-Overview
// Se puede hacer en la línea anterior con:
// $app = new \Slim\Slim(array('templates.path' => 'vistas'));
// O bien con $app->config();
	$app->config(array(
  	  'templates.path' => 'vistas',
	));
 
// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
	$app->contentType('text/html; charset=utf-8');
 
// Definimos conexion de la base de datos.
// Lo haremos utilizando PDO con el driver mysql.
	define('BD_SERVIDOR', 'localhost');
	define('BD_NOMBRE', 'proyecto');
	define('BD_USUARIO', 'root');
	define('BD_PASSWORD', 'alberto');
 
// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
	$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
 
////////////////////////////////////////////
// Definición de rutas en la aplicación:
// Ruta por defecto de la aplicación /
////////////////////////////////////////////
 
	$app->get('/', function() {
         	   echo "Pagina de gestión API REST de mi aplicación.";
       	 });
 
// Cuando accedamos por get a la ruta /usuarios ejecutará lo siguiente:
	$app->get('/usuarios', function() use($db) {
            // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            $consulta = $db->prepare("select * from usuarios");
            $consulta->execute();
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
        });
 
 
// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
	$app->get('/usuarios/:idusuario', function($usuarioID) use($db) {
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            // En PDO los parámetros para las consultas se pasan con :nombreparametro (casualmente 
			// coincide con el método usado por Slim).
			// No confundir con el parámetro :idusuario que si queremos usarlo tendríamos 
			// que hacerlo con la variable $usuarioID
            $consulta = $db->prepare("select * from usuarios where idusuario=:param1");
 
            // En el execute es dónde asociamos el :param1 con el valor que le toque.
            $consulta->execute(array(':param1' => $usuarioID));
 
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
        });
 
// Alta de usuarios en la API REST
	$app->post('/usuario',function() use($db,$app) {
    // Para acceder a los datos recibidos del formulario
  	  $datosform=$app->request;
 
    // Los datos serán accesibles de esta forma:
    // $datosform->post('apellidos')
 
    // Preparamos la consulta de insert.
   	 $consulta=$db->prepare("insert into usuarios(nombre,apellidos,email,pass) 
					values (:nombre,:apellidos,:email,MD5(:pass))");
 
   	 $estado=$consulta->execute(
            	array(
             	   ':nombre'=> $datosform->post('nombre'),
              	  ':apellidos'=> $datosform->post('apellidos'),
              	  ':email'=> $datosform->post('email'),
			':pass'=> $datosform->post('pass')
              	  )
           	 );
    	if ($estado)
       	 echo json_encode(array('estado'=>true,'mensaje'=>'Datos insertados correctamente.'));
   	 else
       	 echo json_encode(array('estado'=>false,'mensaje'=>'Error al insertar datos en la tabla.'));
	});
 
// Programamos la ruta de borrado en la API REST (DELETE)
	$app->delete('/usuarios/:idusuario',function($idusuario) use($db)
	{
 	  $consulta=$db->prepare("delete from usuarios where idusuario=:id");
 
 	  $consulta->execute(array(':id'=>$idusuario));
 
	if ($consulta->rowCount() == 1)
  	 echo json_encode(array('estado'=>true,'mensaje'=>'El usuario '.$idusuario.' ha sido borrado correctamente.'));
 	else
   	echo json_encode(array('estado'=>false,'mensaje'=>'ERROR: ese registro no se ha encontrado en la tabla.'));
 
	});
 
 
// Actualización de datos de usuario (PUT)
	$app->put('/usuarios/:idusuario',function($idusuario) use($db,$app) {
    // Para acceder a los datos recibidos del formulario
  	  $datosform=$app->request;
 
    // Los datos serán accesibles de esta forma:
    // $datosform->post('apellidos')
 
    // Preparamos la consulta de update.
   	 $consulta=$db->prepare("update soporte_usuarios set nombre=:nombre, apellidos=:apellidos, email=:email 
							where idusuario=:idusuario");
 
   	 $estado=$consulta->execute(
        	    array(
          	      ':idusuario'=>$idusuario,
         	       ':nombre'=> $datosform->post('nombre'),
         	       ':apellidos'=> $datosform->post('apellidos'),
         	       ':email'=> $datosform->post('email')
          	      )
        	    );
 
    // Si se han modificado datos...
   	 if ($consulta->rowCount()==1)
     		 echo json_encode(array('estado'=>true,'mensaje'=>'Datos actualizados correctamente.'));
   	 else
     		 echo json_encode(array('estado'=>false,'mensaje'=>'Error al actualizar datos, datos 
						no modificados o registro no encontrado.'));
	});
 
 
 
$app->run();
?>
