<?php 
	/*Aqui nos conectamos a la BD indicando: host,nombre de la BD,usuario y contraseña */
	$host="localhost";
	$db="bdresidenciasescolares";
	$user="root";
	$pass=null;
	try { 
		$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $pdo;
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	
?>