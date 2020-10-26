<!--Esta es la vista para visualizar los procedimientos -->
<!DOCTYPE html>
<html>
<head>
	<title>Funciones y procedimientos</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/residenciasEscolares.css">
	<link rel="stylesheet" href="../css/funcionesYProcedimientos.css">
	<script src="../js/confirmDelete.js"></script>
	<!--Carga el fichero que contiene todas las funciones con las consultas necesarias --> 
	<?php include("consultas.php"); ?>
</head>
<body>
	<h1 class="titleColor">Antonio Rodriguez Luis</h1>
    
	<div class="residencias">
        
    <form action="" method="post">
        <input type="text"  name="dniEstudiante" placeholder="DNI Estudiante" required>
		<input type="submit" class="BuscarEstudiante" value="Buscar Estudiante">
	</form>
	<?php 
	/*Comprueba si sea enviado el formulario con los datos correspondientes, en caso de que se haya enviado
	realiza las consultas necesarias para completar los datos de la vista*/
        if(isset($_POST['dniEstudiante'])){
			$dni = $_POST['dniEstudiante']; 
			$totalMeses = getMesesTotales($dni);
			$totalMesesPagados = getMesesTotalesPagados($dni);
	?>
	<label>Número de meses totales: <?php $totalMeses = $totalMeses->fetch(); echo $totalMeses['FN_MesesEstancia']; ?></label>
	<br>
	<label>Número de meses totales pagados: <?php $totalMesesPagados = $totalMesesPagados->fetch(); echo $totalMesesPagados['FN_MesesEstanciaPagados']; ?></label>
    <br>
		<table>
	<thead>
		<tr>
			<td>Nombre Residencia</td>
			<td>Nombre Universidad</td>
            <td>Fecha Inicio </td>
            <td>Fecha Fin </td>
			<td>Precio Mensual</td>
		</tr>
	</thead>
		<?php  
		/*Ejecutamos la funcion getDniAlumno enviandole el dni como parametro 
		para luego poder cargar la tabla con el resultado*/
            $stmt = getDniAlumno($dni);
        
            while($row = $stmt->fetch()){ ?>
				<tr class="tabla">
					<td><?php echo $row['nomResidencia'] ?></td>
					<td><?php echo $row['nomUniversidad'] ?></td>
                    <td><?php echo $row['fechaInicio'] ?></td>
                    <td><?php echo $row['fechaFin'] ?></td>
					<td><?php echo $row['precioMensual'] ?></td>
				</tr>
				<?php  
			}} else {
				echo 'Sin resultados';
			}
			?>
	
	</table>
    <br>
        <input type="button" class="TablaResidencias" name="but4" value="Tabla residencias" onclick="location.href='../index.php'">
</div>
</body>
</html>
