<!DOCTYPE>
<html>
<head>
	<title>Registro de Balance</title>
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid ">
		<div class="container">
			<h2>Registro de Balance</h2>
			<form action="procesa.php"  method="POST" id="registro">
				<div class="row">
					<div class="col col-sm-4">
						<div class="form-group input-group">
						 <span class="input-group-addon">Codigo</span>
							<input type="number" readonly value="<?php echo (isset($_GET['codigo'])) ? base64_decode($_GET['codigo']) : "";?>" class="form-control" name="codigo"/>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon ">Nombre</span>
							<input type="text" required="required" class="form-control" value="<?php echo (isset($_GET['nombre'])) ? base64_decode($_GET['nombre']) : "";?>"  name="nombre"/>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Placa</span>
							<input type="text" required="required" class="form-control" value="<?php echo (isset($_GET['placa'])) ? base64_decode($_GET['placa']) : "";?>"  name="placa"/>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Balance</span>
							<input type="number" required="required" class="form-control" value="<?php echo (isset($_GET['balance'])) ? base64_decode($_GET['balance']) : "";?>" name="balance"/>
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Comentario</span>
							<input type="text" required="required" class="form-control" value="<?php echo (isset($_GET['comentario'])) ? base64_decode($_GET['comentario']) : "";?>" name="comentario"/>
						</div>
					</div>
					<div class="col-sm-4">
							<a class="btn btn-success" href="index.php">Nuevo</a>
							<button class="btn btn-primary" type="submit" >Guardar</button>
					</div>
				</div>
			</form>
			
			<div class="row">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Placa</th>
							<th>Balance</th>
							<th>Comentario</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
					<?php
					//variable $files contiene arreglo de archivos en carpeta registro
						$files = scandir("registro");
						//se realiza un recorrido de de los archivos 
						foreach($files as $registro) {
							$path = "registro/{$registro}";
							if(is_file($path)) { /*si el archivo existe se obtiene la informacion y se decodifica el json*/
								$datos = json_decode(file_get_contents($path),true);
								echo "<tr>";
								foreach ($datos as $campo){/*se recorre cada posicion del arreglo y se asigna a su celda*/
									echo "<td>{$campo}</td>";
								}
								echo "
									<td>
										<a href='procesa.php?modificar={$registro}' class='btn btn-warning'>Modificar</a>	
										<a href='procesa.php?eliminar={$registro}' onclick='return confirm(\"Desea elminar el registro de {$datos['nombre']} (codigo: {$datos['codigo']})?\")' class='btn btn-danger'>Eliminar</a>
									</td>
								</tr>";//enlace eliminar utiliza el arreglo $datos para mostrar informacion sobre el registro que se va a eliminar
							}
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>