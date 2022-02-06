function validarObligatori(valor) {
    valor.toString().trim();
    return typeof valor !== 'undefined' && valor !== ' ' && valor.length > 0;
}

function validarSencer(numero) { return validarObligatori(numero) && !isNaN(numero) && (numero % 1 === 0); }

function validarFloat(numero) {
    if(validarObligatori(numero) && !isNaN(numero)) {
        const decimal=  /^[0-9]+\.[0-9]{1,2}$/;
        if(numero.match(decimal)) {
            return true;
        }else return false
    }else return false;
}

function validarNom(valor) {
    // Count spaces. Has to be < 6.
    var spaceCount = (valor.split(" ").length - 1);

    // Check for special characters

    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

    return validarObligatori(valor) && valor.length >= 4 && valor.length <= 50 && /\S/.test(valor) && spaceCount < 6 && !format.test(valor);
    // not empty                // TEST LENGTH                    // Has not only spaces // has less than 6 spaces
}



//validaNom falta validar caracteres especiales y no mas de 6 espacios

function validarEmail(valor) { return /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor); }

function validarTelefon(telefon, tipus) {                       // tipus = 0 -> movil && tipus = 1 -> fixe
    if (validarObligatori(telefon) && !isNaN(telefon)) {
        telefon = telefon + "";
        if (validarSencer(telefon) && (telefon.length === 9)) {
            if (((telefon.charAt(0) === "6") || (telefon.charAt(0) === "7"))
                && ((typeof tipus === 'undefined') || (tipus === 0))) {
                return true;
            }
            if (((telefon.charAt(0) === "8") || (telefon.charAt(0) === "9"))
                && ((typeof tipus === 'undefined') || (tipus === 1))) {
                return true;
            }
        }
    }
    return false;
}

function validarPassword(valor) {
    var espacios = false;
    var cont = 0;

    while (!espacios && (cont < valor.length)) {
        if (valor.charAt(cont) === " ")
            espacios = true;
        cont++;
    }

    return /^(?=.*[A-Za-z])(?=.*\d)(?=.*[<>_$@.!%*#?&/+])[A-Za-z\d<>_$@!%*#?&/+]{8,}$/.test(valor) && espacios === false;

}

function checkPassword(valor1, valor2) {
    return validarPassword(valor1) === true && validarPassword(valor2) === true && valor1 === valor2;
}

// https://stackoverflow.com/questions/18758772/how-do-i-validate-a-date-in-this-format-yyyy-mm-dd-using-jquery/18759013

function validarData(fecha) {

    // La data es rep en format yyyy-mm-dd encara que estigui en dd/mm/yyyy a l'input
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if (!fecha.match(regEx)) return false;  // Invalid format
    var d = new Date(fecha);
    var dNum = d.getTime();
    if (!dNum && dNum !== 0) return false; // NaN value, Invalid date
    return d.toISOString().slice(0, 10) === fecha;
}

function validarNoBuit(valor) {
    if (valor !== null && typeof valor !== 'undefined') {
        valor = valor.toString().trim(); //Converteix el valor a cadena i elimina els espais en blanc del principi i final.
        if (valor.length > 0) {
            return true;
        }
    }
    return false;
}

//XESC From here
function validarTextarea(valor) {
    const format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    return validarObligatori(valor) && valor.length >= 4 && valor.length <= 250 && /\S/.test(valor) && !format.test(valor);
}

function validarImatge(file) {
    const arrValidFileExtensions = [".jpg", ".jpeg", ".png"]; //Extensions permeses
        if (file.type === "file") { //check que es un fitxer
            const fileName = file.value;
            if (fileName.length > 0) {  //check que el fitxer tengui nom
                const extension = fileName.substring(fileName.indexOf('.'), fileName.length); //get ext
                //console.log(extension); //El nom no ens importa perq el modificarem per guardar-lo
                return arrValidFileExtensions.includes(extension); //Check ext esta permesa
            }
            else return false;
        }
        else return false;
}

function validarRadio(rad1, rad2) {
    if(rad1.checked) {
        return true;
    } else if(rad2.checked) {
        return true;
    } else return false;
}


function validarCheckbox() {
    return document.getElementById('terms').checked;
}

function validarCampsFormulari(checker, input) {
    if(!checker){
        console.log(input);
        const errInput = input.parentNode.nextSibling;
        errInput.style.display = "block";
        input.style.background = "#ffcccc";
        input.addEventListener('focus', function() {
            this.style.background = "none";
            errInput.style.display = "none";
        });
        return false;
    }
    else return true;
}