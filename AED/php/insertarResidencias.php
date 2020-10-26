<?php 
//Carga la canexion con la BD 
include("conectDB.php");
//Recojo los datos introducidos en la vista con el metodo POST
$nombreResidencia = $_POST['nombreResidencia'];
$comboUniversidades = $_POST['comboUniversidades'];
if(isset($_POST['cboxComedor'])){
    $cboxComedor = 1;
}
else{
    $cboxComedor=0;
}
$precio = $_POST['precio'];
//Aqui utilicimas otro de los procedimientos para insertar registros en la tabla residencias
$stmt = $pdo->prepare('Call SP_insertResidenciaEscolar(:paramNomResidencia,:paramCodUniversidad,:paramPrecioMensual,:paramComedor, @codErrorUniver,@codErrorReside)');
$stmt->bindParam(':paramNomResidencia', $nombreResidencia); 
$stmt->bindParam(':paramCodUniversidad', $comboUniversidades); 
$stmt->bindParam(':paramComedor', $cboxComedor); 
$stmt->bindParam(':paramPrecioMensual', $precio); 
$stmt->execute(); 
$stmt=$pdo->prepare('select @codErrorUniver as codErrorUniver, @codErrorReside as codErrorReside');
$stmt->execute(); 
$row = $stmt->fetch();
/*Comprobamos que no hubieran errores durante la consulta, si todo es correcto redireccionamos a la vista de 
Residencias*/
if($row['codErrorUniver'] != 0 && $row['codErrorReside'] != 0){
    $pdo = null;
    header("Location: ../index.php");
}

?>