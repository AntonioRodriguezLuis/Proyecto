<?php 
/*Carga la canexion con la BD y mediante ella ejecuta el borrado de la residencia en funcion del codigo recibido
mediante GET. Finalmente nos redirige a la vista de Residencias*/
    include("conectDB.php");  
    $codResidencia = $_GET['cod'];
    $stmt = $pdo->prepare("DELETE FROM residencias WHERE codResidencia = :paramCodResidencia");
    $stmt->bindParam(':paramCodResidencia', $codResidencia,  PDO::PARAM_INT);
    $stmt->execute();
    header("Location: ../index.php");
?>