/* La funcion confirmDelete muestra un cuadro de confirmacion los datos que vas a borrar 
y ademas visualiza comedor a Si o No dependiendo si es 1 o 0 para que lo entienda mejor el usuario*/
function confirmDelete(codResidencia, nomResidencia, codUniversidad, precioMensual, comedor) {
    if (comedor == 1) {
        comedor = "Sí";
    } else {
        comedor = "No";
    }
    var msg = confirm("¿Esta usted seguro de borrar este registro?\nCodigo: " + codResidencia + "\nNombre Residencia: " + nomResidencia + "\nCodigo Universidad: " + codUniversidad + "\nPrecio mensual: " + precioMensual + "\nComedor: " + comedor);
    if (msg == true) {
        window.location.href = "php/borrar.php?cod=" + codResidencia;
    }
}