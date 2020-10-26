<?php
    //Carga la canexion con la BD 
    include("conectDB.php");
    //Recibimos los datos del formulario y lo guardamos en variables. 
    $codResidencia = $_POST['codResidencia'];
    $nombreResidencia = $_POST['nombreResidencia'];
    $comboUniversidades = $_POST['comboUniversidades'];
    $precio = $_POST['precio'];
   
    if(isset($_POST['cboxComedor'])){
        $comedor = 1;
    }
    else{
        $comedor=0;
    }
    /*Hacemos una consulta de actualizacion del registro con los datos pasados 
    por parametros y redireccionamos a Residencias*/
    $stmt = $pdo->prepare('UPDATE residencias SET nomResidencia = :paramNomResidencia,codUniversidad = :paramCodUniversidad,precioMensual = :paramPrecioMensual,comedor = :paramComedor WHERE codResidencia = :paramCodResidencia');

    $stmt->bindParam(':paramCodResidencia', $codResidencia); 
    $stmt->bindParam(':paramNomResidencia', $nombreResidencia); 
    $stmt->bindParam(':paramCodUniversidad', $comboUniversidades); 
    $stmt->bindParam(':paramComedor', $comedor); 
    $stmt->bindParam(':paramPrecioMensual', $precio); 
    $stmt->execute(); 

    header("Location: ../index.php");
?>