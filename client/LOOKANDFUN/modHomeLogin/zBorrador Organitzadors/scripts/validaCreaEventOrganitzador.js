function validarNoBuit(valor) {
    if (valor !== null && typeof valor !== 'undefined') {
        valor = valor.toString().trim(); //Converteix el valor a cadena i elimina els espais en blanc del principi i final.
        if (valor.length > 0) {
            return true;
        }
    }
    return false;
}

function validarRadio(rad1, rad2) {
    if(rad1.checked) {
        return rad1.value;
    } else if(rad2.checked) {
        return rad2.value;
    } else return false;
}

function validarSencerXesc(numero) {numero = parseInt(numero); return validarObligatori(numero) && !isNaN(numero) && (numero % 1 === 0);}