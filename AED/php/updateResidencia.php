<!--Esta es la vista para visualizar el formulario de Actualizar residencias cargamos los datos del 
registro que vamos a actualizar mediante su codigo -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/controlPrecioMensual.js"></script>
    <link rel="stylesheet" href="../css/altasResidenciasEscolares.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Modificar Residencia</title>
</head>

<?php 
/*Carga el fichero que contiene todas las funciones con las consultas necesarias */
    include("consultas.php");
    /*Comprueba si sea enviado el formulario con los datos correspondientes, en caso de que se haya enviado
	realiza las consultas necesarias para completar los datos de la vista*/
    if( isset($_GET['codResidencia']) ){
        $stmt = updateResidencia($_GET['codResidencia']);
    }
?>

<body>
    <h1 class="titleColor">Antonio Rodriguez Luis</h1>
    <form action="modificar.php" method="POST">
        <fieldset>
            <legend class="titleFieldset">Actualizar Residencias Escolares</legend>
            <?php 
        while($row = $stmt->fetch()){ ?>
            <?php echo "<input type='hidden' name='codResidencia' value='".$row['codResidencia']."'>" ?>
            <p>
                <label>Nombre residencia: </label>
                <?php echo "<input type='text' class='nombreResidencia' name='nombreResidencia' value='".$row['nomResidencia']."' required>"; ?>
            </p>
            <p>
                <label>Universidad: </label>
                <select class="comboUniversidades" name="comboUniversidades">
                    <?php 
                    //Llamamos a la funcion getUniversidades para cargar el comboBox
                            $universidades = getUniversidades();
                            while($universidad = $universidades->fetch()){ ?>
                    <option value=<?php echo $universidad['codUniversidad'] ?> <?php if($universidad['codUniversidad']==$row['codUniversidad']) echo 'selected="selected"'; ?> ><?php echo $universidad['nomUniversidad'] ?></option>
                    <?php  } ?>
                </select>
            </p>
            <p>
                <label>Tiene comedor: </label>
                <!--Si comedor es igual a 1 lo seleccionamos y en caso contrario no hacemos nada-->
                <?php echo "<input type='checkbox' name='cboxComedor'".($row['comedor']==1 ? 'checked' : '')." value='".$row['comedor']."' >"; ?>
            </p>
            <label>Precio mensual: </label>
            <!--Aqui en el onblur llamamos a la funcion checkPrecioMensual para comprobar que el precio no es inferior a 900-->
            <?php echo "<input type='number' class='precioMensual' id='precioMensual' name='precio' value='".$row['precioMensual']."' onblur='checkPrecioMensual()' required>"; ?>
            <?php }
    ?>
        </fieldset>
        <br>
        <input type="submit"  id="enviarBtn" class="insertarResidencia" name="Modificar Residencia" value="Modificar Residencia">
        <input type="button" name="but4" class="TablaResidencias" value="Tabla residencias" onclick="location.href='../index.php'">
    </form>
   
</body>
</body>

</html>