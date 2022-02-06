$(document).ready(function(){
    generaNavbar("organitzador");
    readAllEvents(); //Crida onload

    $(document).on('click', '.read-products-button', function(){
        readAllEvents(); //Crida onclick
    });
});

    //Mostra Events GLOBAL SCOPE
function readAllEvents() {
    // pilla el JSON de la API
        $.getJSON("../organitzadorsBackend/api/readAllEvents.php", function(data){
            //Fer net rapid cada pic per favor!!
            const core = document.getElementById('page-content');
            //reset Node rapid
            core.innerHTML = '';
            const btCrea = document.createElement('BUTTON');
            btCrea.setAttribute('class','btn btn-primary pull-right create-product-button');
            const span = document.createElement('SPAN');
            span.setAttribute('class','fas fa-plus-circle');
            const txtSpan = document.createTextNode(' Crea Event');

            btCrea.appendChild(span);
            btCrea.appendChild(txtSpan); //BCS OF CSS WE APPEND IT ON BTN NOT SPAN
            core.appendChild(btCrea);

            const taula = document.createElement('TABLE');
            taula.setAttribute('class','table table-bordered table-hover');

            const tr = document.createElement('TR');
            taula.appendChild(tr);
            const thead =  ['Nom','Organitzador','Categoria','Data','Opcions'];

            for(let i = 0; i < thead.length; i++) {
                const th = document.createElement('TH');
                const txtTh = document.createTextNode(thead[i]);
                th.appendChild(txtTh);
                tr.appendChild(th);
            }
            $.each(data, function(key, value) { //aprofitam cada fila, i li treim els valors. es com un foreach pero amb jquery
                const tr = document.createElement('TR');
                tr.appendChild(creaFilaDades(value.nom_event));
                tr.appendChild(creaFilaDades(value.nom_org));
                tr.appendChild(creaFilaDades(value.nom_cat));
                tr.appendChild(creaFilaDades(value.data_event));
                //
                tr.appendChild(creaBtnCRUD(value.id_event,'btn btn-primary read-one-product-button', 'far fa-eye',' Detalls'));
                tr.appendChild(creaBtnCRUD(value.id_event,'btn btn-info update-product-button','far fa-edit',' Edit'));
                    tr.lastChild.style.cursor = "not-allowed"; //temporary
                tr.appendChild(creaBtnCRUD(value.id_event,'btn btn-danger delete-product-button','far fa-trash-alt',' Del'));
                    tr.lastChild.style.cursor = "not-allowed"; //temporary
                taula.appendChild(tr);
            });
            function creaFilaDades(dadesItem) {
                const td = document.createElement('TD');
                const txtTd = document.createTextNode(dadesItem);
                td.appendChild(txtTd);
                return td;
            }
            core.appendChild(taula);
        });
}