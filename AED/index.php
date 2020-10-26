<!--Esta es la vista para visualizar la tabla residencias y ademas visualizamos un procedimiento -->
<!DOCTYPE html>
<html>
<head>
	<title>Residencias Escolares</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/residenciasEscolares.css">
	<script src="js/confirmDelete.js"></script>
	<!--Carga el fichero que contiene todas las funciones con las consultas necesarias --> 
	<?php include("php/consultas.php"); ?>
</head>
<body>
	<h1 class="titleColor">Antonio Rodriguez Luis</h1>
	
	<div class="residencias">
		<table>
	<thead>
		<tr>
			<td>Codigo Residencia</td>
			<td>Nombre Residencias</td>
			<td>Codigo Universidades</td>
			<td>Precio Mensual</td>
			<td>Comedor</td>
			<td>Baja o modificación</td>
		</tr>
	</thead>
		<?php  
		/*Llamamos a la funcion  getResidencias para visualizar la tabla con todos sus datos*/
			$stmt = getResidencias();
			while($row = $stmt->fetch()){ ?>
				<tr class="tabla">
					<td><?php echo $row['codResidencia'] ?></td>
					<td><?php echo $row['nomResidencia'] ?></td>
					<td><?php echo $row['codUniversidad'] ?></td>
					<td><?php echo $row['precioMensual'] ?></td>
					<td><?php if($row['comedor'] == 1){echo "Sí";}else{echo "No";} ?></td>
					<td>
					<!--Aqui llamamos a la funcion de java script confirmDelete para pasarle todos los datos del registro -->
						<?php echo "<input type='button' name='but' value='Baja' onclick=\"confirmDelete('".$row['codResidencia']."','".$row['nomResidencia']."','".$row['codUniversidad']."','".$row['precioMensual']."','".$row['comedor']."')\">" ?>
						<?php echo "<input type='button' name='but2' value='Modificacion' onclick=\"location.href='php/updateResidencia.php?codResidencia=".$row['codResidencia']."'\">" ?>
					</td>
				</tr>
				<?php  
			}
			?>
	
	</table>
	<br>
	<input type="button" name="InsertarResidenciasEscolares"  class="InsertarResidenciasEscolares" value="Insertar Residencias Escolares" onclick="location.href='php/AltaDeResidenciasEscolares.php'">
	<input type="button" name="ProcedimientoDNIAlumno"  class="ProcedimientoDNIAlumno" value="Procedimiento DNI Alumno" onclick="location.href='php/FuncionesYProcedimientos.php'">
	<div class="borderProc residencias">
		<form action="" method="post">
			<label>Universidad: </label>
			<select name="comboUniversidades">
				<?php 
				/*Cargamos en un comboBox la  lista de universidades para asegurarnos de que no introducen datos erroneos para hacer la consulta  */
					$universidades = getUniversidades();
					while($universidad = $universidades->fetch()){ ?>
						<option value='<?php echo $universidad['nomUniversidad'] ?>'><?php echo $universidad['nomUniversidad'] ?></option>
				<?php  } ?>
			</select>
			<label>Precio Mensual: </label>
			<input type="number" id="precioMensualMayor" name="precioMensualMayor" placeholder="Introduzca un precio">
			<input type="submit" class="BuscarUniversidad" value="Buscar Universidad">
		</form>
		<br>
		<?php
		/*Comprueba si sea enviado el formulario con los datos correspondientes, en caso de que se haya enviado
		realiza las consultas necesarias para completar los datos de la vista. Por ultimo decodificamos el json 
		recibido en la funcion getnombreUniversidadPrec para mostrar los datos que contiene	 */
			if(isset($_POST['comboUniversidades']) && isset($_POST['precioMensualMayor'])){ 
				$comboUniversidades = $_POST['comboUniversidades']; 
				$precioMensualMayor = $_POST['precioMensualMayor']; 
				$resultados = getnombreUniversidadPrec($comboUniversidades, $precioMensualMayor);
				$resultados = json_decode($resultados);
		?>
		<label>Cantidad de residencias: <?php echo $resultados->cantidadResidencias; ?></label>
		<br>
		<label>Cantidad de residencias con precio mayor al introducido: <?php echo $resultados->cantidadResidenciasPrecio; ?></label>
		<?php } ?>
	</div>
</div>
</body>
</html>
