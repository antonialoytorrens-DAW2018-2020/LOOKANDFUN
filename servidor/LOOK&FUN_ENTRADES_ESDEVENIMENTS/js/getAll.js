$(document).ready(function () {
    getAll();
})
function getAll() {
    $.getJSON("api/getAll.php", function (data) {
        $("#taula").innerHTML = '';
        var table = $("<table class='table table-bordered table-hover'></table>");
        $("#taula").append(table);

        // CREATE TITLES
        var tr = $("<tr class='bg-primary'></tr>");
        table.append(tr);
        tr.append(creaFilaBlanca("ID_ESDEVENIMENT"));
        tr.append(creaFilaBlanca("NOM"));
        tr.append(creaFilaBlanca("DURACIO"));
        tr.append(creaFilaBlanca("PREU"));
        tr.append(creaFilaBlanca("ID_ENTRADA"));
        tr.append(creaFilaBlanca("DESCOMPTE"));
        tr.append(creaFilaBlanca("DATA"));
        //tr.append(creaFilaBlanca("ID_PERSONA"));
        tr.append(creaFilaBlanca("CODI_RECINTE"));

        $.each(data, function (key, value) {
            tr = $("<tr></tr>");
            table.append(tr);
            tr.append(creaFila(value.id_esdeveniment));
            tr.append(creaFila(value.nom_esdeveniment));
            console.log(value.data_inici_esdeveniment);
            tr.append(creaFila("Comença a " + value.data_inici_esdeveniment + " i acaba a " + value.data_final_esdeveniment));
            tr.append(creaFila(value.preu_esdeveniment));
            tr.append(creaFila(value.id_entrada));
            tr.append(creaFila(value.descompte_entrada));
            tr.append(creaFila(value.data_entrada));
            //tr.append(creaFila(value.id_persona));
            tr.append(creaFila(value.codi_recinte_esdeveniment));
        });
        // JQUERY EFFECTS
        $(table).hide();
        $(table).fadeIn("slow");
    });
}

function creaFila(par) {
    var th = $("<th></th>");
    var textNode = document.createTextNode(par);
    th.append(textNode);
    return th;
}

function creaFilaBlanca(par) {
    var th = $("<th class='text-white'></th>");
    var textNode = document.createTextNode(par);
    th.append(textNode);
    return th;
}