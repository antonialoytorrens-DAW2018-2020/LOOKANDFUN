// @author Toni

$(document).ready(function () {
    

    $(document).on('click', '.delete-product-button', function () { //en clicar a Edita
        // get product id
        const id = $(this).attr('data-id');
        const core = $('#taula')[0];
        // read item record based on given ID
        $.getJSON("api/readOneEsdeveniment.php?id=" + id, function(data){
            const arrThead = [];
            const arrData = [];
            $.each(data, function (key, value) {
                arrThead.push(key); //This way is simple, but amb s'array de adalt it might just work, test later.
                arrData.push(value);
            });
            bootbox.confirm({
                title: "Borrar esdeveniment?",
                message: "Estàs segur que vols borrar l'esdeveniment <b>" + arrData[0]+ "</b>? Aquesta acció no es pot desfer.",
                className: 'fadeIn animated',
                backdrop: true,
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> No'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Sí'
                    }
                },
                callback: function (result) {
                    // CREA UN FORMULARI AL CALLBACK I L'ENVIA AL SERVIDOR
                    //console.log('This was logged in the callback: ' + result);
                    if(result) {
                        const form = $("<form method='POST' action='api/delEsdeveniment.php' id='formdelEsdeveniment'></form>");
                        const inputId = $("<input type='hidden' name='id_esdeveniment' value=" + id + ">");
                        $(form).append(inputId);
                        $(core).append(form);
                        $(form).submit();
                    }
                }
            });
        });
    });
});