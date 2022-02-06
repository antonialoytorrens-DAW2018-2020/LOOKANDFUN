$(document).ready(function () {
    getEntrades();

    $(document).on('click', '.read-products-button', function () {
        // NETEJA
        $("#taula").html('');
        var idCrea = $('<div id="crea" class="float-right mb-2"></div>');
        $("#taula").append(idCrea);
        getEntrades(); //Crida onclick
    });
})
function getEntrades() {
    $.getJSON("api/getEntrades.php", function (data) {
        const crea = $('<button type="button" class="btn btn-primary mb-2 mt-2" id="crea-entrada"><span class="fa fa-plus"></span> Crea</button>');
        $("#crea").append(crea);
        var table = $("<table class='table table-bordered table-hover'></table>");
        $("#taula").append(table);

        // CREATE TITLES
        var tr = $("<tr class='bg-primary'></tr>");
        $(table).append(tr);
        $(tr).append(creaFilaBlanca("ID ESDEVENIMENT"));
        $(tr).append(creaFilaBlanca("ID ENTRADA"));
        $(tr).append(creaFilaBlanca("DESCOMPTE"));
        $(tr).append(creaFilaBlanca("DATA"));

        $.each(data, function (key, value) {
            tr = $("<tr></tr>");
            $(table).append(tr);
            $(tr).append(creaFila(value.id_esdeveniment));
            $(tr).append(creaFila(value.id_entrada));
            $(tr).append(creaFila(value.descompte_entrada + "%"));
            $(tr).append(creaFila(value.data_entrada));
        });
        // JQUERY EFFECTS
        $(crea).hide();
        $(crea).fadeIn("slow");
        $(table).hide();
        $(table).fadeIn("slow");
    });
    $(document).on('click', '#crea-entrada', function () {
        // NETEJA
        $("#taula").html('');
        $("#crea").html('');

        //Crea boto per tornar enrera;
        const btBack = $("<button class='btn btn-primary pull-right read-products-button'><span class='fa fa-arrow-left'> Torna Enrere</span></button>");
        $("#taula").append(btBack);

        const form = $("<form class='p-3 mt-2 border border-primary rounded-lg' method='POST' action='api/addEntrada.php' enctype='multipart/form-data' id='formaddEsdeveniment'></form>");
        $("#taula").append(form);
        const id_esdeveniment = creaCamp("id_esdeveniment", "ID de l'esdeveniment", "number", "Introdueix l'ID que t'han proporcionat de l'esdeveniment.");
        var descompte = creaCamp("descompte_entrada", "Descompte", "number", "");

        // IMPLEMENTAR DATEPICKER I PREU (NOMÉS NOMBRES, UN PUNT PER REPRESENTAR DECIMALS I DOS DECIMALS MÀXIM)
        $(function () {
            $('#descompte_entrada').on('keypress', function (event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                var input = $(this).val();
                if ((input.indexOf('.') != -1) && (input.substring(input.indexOf('.')).length > 2)) {
                    event.preventDefault();
                }
            });
        });
        $(form).append(id_esdeveniment);
        $(form).append(descompte);

        var submit = $('<button type="submit" class="btn btn-primary">Envia</button>');
        form.append(submit);

        // JQUERY EFFECTS
        $('#taula').hide();
        $('#taula').fadeIn("slow");
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

function creaCamp(label, labelMessage, inputClass, placeholder) {
    var camp = $('<div class="form-group"><label for="' + label + '">' + labelMessage + '</label><input type="' + inputClass + '" class="form-control" name="' + label + '" id="' + label + '" aria-describedby="' + label + '_help" placeholder="' + placeholder + '"></input></div>');
    return camp;
}

function creaBotoEsborra(id) {
    var id = id;
    var button = $('<button class="btn btn-danger delete-product-button" data-id=' + id + '><span class="far fa-trash-alt"></span>Esborra</button>');
    return button;
}