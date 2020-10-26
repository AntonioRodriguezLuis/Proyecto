<!--Esta es la vista para visualizar el formulario de insertar residencias -->
<!DOCTYPE html>
<html>

<head>
    <title class="title">Alta de Residencias Escolares</title>
    <!-- ../ esto sirve para volver a la carpeta anterior -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/altasResidenciasEscolares.css">
    <script src="../js/controlPrecioMensual.js"></script>
    <!--Carga el fichero que contiene todas las funciones con las consultas necesarias --> 
    <?php include("consultas.php"); ?> 
</head>
<body>
    <h1 class="titleColor">Antonio Rodriguez Luis</h1>
    <form action="insertarResidencias.php" method="POST">
        <fieldset>
            <legend class="titleFieldset">Alta Residencias Escolares</legend>
            <p>
                <label>Nombre residencia: </label>
                <input type="text" name="nombreResidencia" class="nombreResidencia" placeholder="Introduzca el nombre" required>
            </p>

            <p>
                <label>Universidad: </label>
                <select class="comboUniversidades" name="comboUniversidades">
                    <?php 
                        //Llamamos a la funcion getUniversidades para cargar el comboBox
                        $stmt = getUniversidades();
                        while($row = $stmt->fetch()){ ?>
                            <option value=<?php echo $row['codUniversidad'] ?>><?php echo $row['nomUniversidad'] ?></option>
                        <?php  } ?>
                </select>
            </p>
            <p>
                <label>Tiene comedor: </label>
                <input type="checkbox" name="cboxComedor">
            </p>
            <p>
                <label>Precio mensual: </label>
                <!--Cuando el input pierde el foco llama a la funcion checkPrecioMensual para comprobar que el campo sea valido -->
                <input type="number" id="precioMensual" class="precioMensual"  name="precio" placeholder="Introduzca el precio" onblur="checkPrecioMensual()" required>
            </p>
        </fieldset>
        <br>
        <input type="submit" id="enviarBtn" class="insertarResidencia" name="insertarResidencia" value="Insertar Residencia">
        <input type="button" name="TablaResidencias" class="TablaResidencias" value="Tabla residencias" onclick="location.href='../index.php'">
    </form>
</body>

</html>