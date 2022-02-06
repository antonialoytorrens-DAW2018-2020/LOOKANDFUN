$(document).ready(function () {
    getEsdeveniments();

    $(document).on('click', '.read-products-button', function () {
        // NETEJA
        $("#taula").html('');
        var idCrea = $('<div id="crea" class="float-right mb-2"></div>');
        $("#taula").append(idCrea);
        getEsdeveniments(); //Crida onclick
    });
})

function getEsdeveniments() {
    $.getJSON("api/getEsdeveniments.php", function (data) {
        var crea = $('<button type="button" class="btn btn-primary" id="crea-event"><span class="fa fa-plus"></span> Crea</button>');
        $("#crea").append(crea);
        var table = $("<table class='table table-bordered table-hover'></table>");
        $("#taula").append(table);

        // CREATE TITLES
        var tr = $("<tr class='bg-primary'></tr>");
        table.append(tr);
        $(tr).append(creaFilaBlanca("ID"));
        $(tr).append(creaFilaBlanca("NOM"));
        $(tr).append(creaFilaBlanca("DESCRIPCIÓ"));
        $(tr).append(creaFilaBlanca("DURACIO"));
        $(tr).append(creaFilaBlanca("PREU"));
        $(tr).append(creaFilaBlanca("CODI RECINTE"));
        $(tr).append(creaFilaBlanca("AFORAMENT"));
        $(tr).append(creaFilaBlanca("OCUPACIO"));
        //tr.append(creaFilaBlanca("POSTER"));
        $(tr).append(creaOpcions("OPCIONS"));

        $.each(data, function (key, value) {
            tr = $("<tr></tr>");
            table.append(tr);
            $(tr).append(creaFila(value.id_esdeveniment));
            $(tr).append(creaFila(value.nom_esdeveniment));
            $(tr).append(creaFila(value.descripcio_esdeveniment));
            $(tr).append(creaData("Comença a " + value.data_inici_esdeveniment, " i acaba a " + value.data_final_esdeveniment));
            $(tr).append(creaFila(value.preu_esdeveniment));
            $(tr).append(creaFila(value.codi_recinte_esdeveniment));
            $(tr).append(creaFila(value.aforament_esdeveniment));
            $(tr).append(creaFila(value.ocupacio_esdeveniment));
            //tr.append(creaFila(value.poster_esdeveniment));
            $(tr).append(creaBotoDetall(value.id_esdeveniment));
            $(tr).append(creaBotoEdita(value.id_esdeveniment));
            $(tr).append(creaBotoEsborra(value.id_esdeveniment));
        });
        // JQUERY EFFECTS
        $(crea).hide();
        $(crea).fadeIn("slow");
        $(table).hide();
        $(table).fadeIn("slow");
    });
    $(document).on('click', '#crea-event', function () {
        // NETEJA
        $("#taula").html('');
        $("#crea").html('');

        //Crea boto per tornar enrera;
        const btBack = $("<button class='btn btn-primary pull-right read-products-button'><span class='fa fa-arrow-left'> Torna Enrere</span></button>");
        $("#taula").append(btBack);

        const form = $("<form class='p-3 mt-2 border border-primary rounded-lg' method='POST' action='api/addEsdeveniment.php' enctype='multipart/form-data' id='formaddEsdeveniment'></form>");
        $("#taula").append(form);
        const nom_esdeveniment = creaCamp("nom_esdeveniment", "Nom de l'esdeveniment", "text", "Introdueix un nom pel teu esdeveniment.");
        const descripcio_esdeveniment = creaCamp("descripcio_esdeveniment", "Descripció", "text", "Descriu com és l'esdeveniment.");
        var data_inici_esdeveniment = creaCamp("data_inici_esdeveniment", "Data d'inici", "text", "");
        var data_final_esdeveniment = creaCamp("data_final_esdeveniment", "Data d'acabament", "text", "");
        const preu_esdeveniment = creaCamp("preu_esdeveniment", "Preu", "text", "Introdueix un preu. Posa un zero si ha de ser gratuït o un nombre i un punt per representar decimals.");
        const nom_recinte_esdeveniment = creaCamp("nom_recinte_esdeveniment", "Recinte", "text", "Introdueix un recinte o lloc.");
        const aforament_esdeveniment = creaCamp("aforament_esdeveniment", "Aforament", "number", "");
        const poster_esdeveniment = creaCamp("poster_esdeveniment", "Póster (opcional)", "file", "");

        // IMPLEMENTAR DATEPICKER I PREU (NOMÉS NOMBRES, UN PUNT PER REPRESENTAR DECIMALS I DOS DECIMALS MÀXIM)
        $(function () {
            $('#data_inici_esdeveniment').datetimepicker();
            $('#data_final_esdeveniment').datetimepicker();
            $('#preu_esdeveniment').on('keypress', function (event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                var input = $(this).val();
                if ((input.indexOf('.') != -1) && (input.substring(input.indexOf('.')).length > 2)) {
                    event.preventDefault();
                }
            });
        });
        $(form).append(nom_esdeveniment);
        $(form).append(descripcio_esdeveniment);
        $(form).append(data_inici_esdeveniment);
        $(form).append(data_final_esdeveniment);
        $(form).append(preu_esdeveniment);
        $(form).append(nom_recinte_esdeveniment);
        $(form).append(aforament_esdeveniment);
        $(form).append(poster_esdeveniment);

        var submit = $('<button type="submit" class="btn btn-primary">Envia</button>');
        form.append(submit);
        // JQUERY EFFECTS
        $('#taula').hide();
        $('#taula').fadeIn("slow");
    });
}

function creaCamp(label, labelMessage, inputClass, placeholder) {
    var camp = $('<div class="form-group"><label for="' + label + '">' + labelMessage + '</label><input type="' + inputClass + '" class="form-control" name="' + label + '" id="' + label + '" aria-describedby="' + label + '_help" placeholder="' + placeholder + '"></input></div>');
    return camp;
}

function creaFila(par) {
    var th = $("<th></th>");
    var textNode = document.createTextNode(par);
    th.append(textNode);
    return th;
}

function creaData(par1, par2) {
    var th = $("<th></th>");
    var p1 = $("<p></p>");
    var p2 = $("<p></p>");
    var textNode = document.createTextNode(par1);
    var textNode2 = document.createTextNode(par2);
    p1.append(textNode);
    p2.append(textNode2);
    th.append(p1);
    th.append(p2);
    return th;
}

function creaBotoDetall(id) {
    var id = id;
    var button = $('<button class="btn btn-primary read-one-product-button" data-id=' + id + '><span class="far fa-eye"></span>Detalls</button>');
    return button;
}
function creaBotoEdita(id) {
    var id = id;
    var button = $('<button class="btn btn-info update-product-button" data-id=' + id + '><span class="far fa-edit"></span>Edita</button>');
    return button;
}
function creaBotoEsborra(id) {
    var id = id;
    var button = $('<button class="btn btn-danger delete-product-button" data-id=' + id + '><span class="far fa-trash-alt"></span>Esborra</button>');
    return button;
}

function creaFilaBlanca(par) {
    var th = $("<th class='text-white'></th>");
    var textNode = document.createTextNode(par);
    th.append(textNode);
    return th;
}

function creaOpcions(par) {
    var th = $("<th class='text-white' colspan='3'></th>");
    var textNode = document.createTextNode(par);
    th.append(textNode);
    return th;
}