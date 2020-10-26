<?php 
    /* Carga la canexion con la BD */
    include("conectDB.php"); 
    
    /*La funcion getUniversidades realiza una consulta y nos devuelve un listado de las universidades
     existentes en la BD.*/
    function getUniversidades(){
        global $pdo;
        $stmt = $pdo->prepare("select * from universidades");
        $stmt->execute();
        return $stmt;
    }
    /*La funcion getResidencias realiza una consulta y nos devuelve un listado de las residencias
     existentes en la BD.*/
    function getResidencias(){
        global $pdo;
        $stmt = $pdo->prepare("select * from residencias");
        $stmt->execute();
        return $stmt;
    }
    /*La funcion  updateResidencia se utiliza para actualizar campos de la residencia que 
    recibimos mediante parametro*/
    function updateResidencia($codResidencia){
        global $pdo;
        $stmt = $pdo->prepare("select * from residencias where codResidencia = :paramCodResidencia");
        $stmt->bindParam(':paramCodResidencia', $codResidencia,  PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    /*La funcion getDniAlumno llama a un procedimiento el cual le pasamos por parametros el DNI del alumno 
    y nos retorna estancias en que ha estado ese alumno*/
    function getDniAlumno($dni){
        global $pdo;
        $stmt = $pdo->prepare('Call SP_procedimiento1(:paramDni)');
        $stmt->bindParam(':paramDni', $dni); 
        $stmt->execute();
        return $stmt;
    }
    /*La funcion getMesesTotales llama  a la funcion FN_MesesEstancia la cual le pasamos 
    el DNI por parametros y nos retorna numero de meses totales que ha estado ese alumno */
    function getMesesTotales($dni){
        global $pdo;
        $stmt = $pdo->prepare('Select FN_MesesEstancia(:paramDni) AS FN_MesesEstancia');
        $stmt->bindParam(':paramDni', $dni, PDO::PARAM_STR, 9); 
        $stmt->execute();
        return $stmt;
    }
     /*La funcion getMesesTotalesPagados llama  a la funcion FN_MesesEstanciaPagados la cual le pasamos 
    el DNI por parametros y nos retorna numero de meses totales pagados de ese alumno */
    function getMesesTotalesPagados($dni){
        global $pdo;
        $stmt = $pdo->prepare('Select FN_MesesEstanciaPagados(:paramDni) AS FN_MesesEstanciaPagados');
        $stmt->bindParam(':paramDni', $dni); 
        $stmt->execute();
        return $stmt;
    }
    /*La funcion getnombreUniversidadPrec llama al procedimiento SP_nombreUniversidadPrec al cual le pasamos 
    por parametros el nombre de la universidad y el precio a partir del cual visualizara los precios mayores
    a dicho precio . En este caso al final para poder enviar los dos parametros de salida utilizamos json */
    function getnombreUniversidadPrec($nombreUniversidad, $precio){
        global $pdo;
        $stmt = $pdo->prepare('Call SP_nombreUniversidadPrec(:paramNombreUniversidad, :paramPrecio, @cantidadResidencias, @cantidadResidenciasPrecio)');
        $stmt->bindParam(':paramNombreUniversidad', $nombreUniversidad); 
        $stmt->bindParam(':paramPrecio', $precio); 
        $stmt->execute();
        
        $stmt=$pdo->prepare('select @cantidadResidencias as cantidadResidencias, @cantidadResidenciasPrecio as cantidadResidenciasPrecio');
        $stmt->execute(); 
        $resultado = $stmt->fetch();
        $arr = array('cantidadResidencias' => $resultado['cantidadResidencias'], 'cantidadResidenciasPrecio' => $resultado['cantidadResidenciasPrecio']);
        return json_encode($arr);
    }
?>