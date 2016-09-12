<?php
$info = array();
$ruta = "index.php";
	if($_POST) {
		//crea archivo de configuracion para contador de ultimo archivo que se crea
		$file = "conf.dat";
		$cod = $_POST['codigo'];
		if($cod < 1){
			if(is_file($file)) {
				//en caso de existir el archivo lo deserializa y aumenta el codigo
				$conf = unserialize(file_get_contents($file));
				$conf->cod++;
			} else {
				//de lo contrario se va a crear un objeto de la clase stdClass y el atributo cod sera = 1
				$conf = new stdClass();
				$conf->cod = 1;
				
			}
		//casos que siempre sucedera para que al iniciar el programa se traigan todos los datos creados
			file_put_contents($file,serialize($conf));
			$cod = $conf->cod;
		}
		$_POST['codigo'] = $cod;
		$registro = json_encode($_POST);
		file_put_contents("registro/reg{$cod}.json",$registro);
		//Caso para la modificacion de registro
	} else if(isset($_GET['modificar'])) {
		$registro = "registro/{$_GET['modificar']}";
		$info = json_decode(file_get_contents($registro),true);
		$ruta="index.php?codigo=".base64_encode($info['codigo'])."&nombre=".base64_encode($info['nombre'])."&placa=".base64_encode($info['placa'])."&balance=".base64_encode($info['balance'])."&comentario=".base64_encode($info['comentario']);
		//en caso de eliminacion
	} else if(isset($_GET['eliminar'])) {
		$registro = "registro/{$_GET['eliminar']}";
		if(is_file($registro)) {//para no mostrar error pregunta si el archivo existe
			unlink($registro);
		}
	}
	header("location:{$ruta}");

?>