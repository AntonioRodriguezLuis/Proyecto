/*La funcion checkPrecioMensual controla que el precio mensual no sea inferior a 900 
si el precio mensual es inferior muestra un mensaje de error y el boton se deshabilita,
 hasta que introduzca un precio igual a 900 o superior */
function checkPrecioMensual() {
    var btnInsertar = document.getElementById('enviarBtn');
    var valorPrecioMensual = document.getElementById('precioMensual').value;

    if(valorPrecioMensual >= 900){
        btnInsertar.disabled = false;
    }
    else {
        alert('El precio mensual no puede ser inferior a 900 €');
        btnInsertar.disabled = true;
    }
}
