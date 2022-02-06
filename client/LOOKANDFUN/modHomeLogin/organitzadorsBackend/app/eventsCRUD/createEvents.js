window.onbeforeunload = function(){
    return '';
};

window.onload = function(){
    // show html form when 'create product' button was clicked
    $(document).on('click', '.create-product-button', function(){
        const core = document.getElementById('page-content'); //Autorec: Fer net rapid cada pic per favor!!!
        core.innerHTML = ''; //reset Node FASTER than resetNode function (while 1stchild remove 1stchild typof...)
        //Set Formulari
        const formInsert = document.createElement('FORM');
        formInsert.setAttribute('id', 'create-product-form');
        formInsert.setAttribute('action','#');
        formInsert.setAttribute('method','post');
        formInsert.setAttribute('border','0');
        formInsert.setAttribute('enctype', 'multipart/form-data');//IMPORTANTE
        const taula = document.createElement('TABLE');
        taula.setAttribute('class','table table-hover table-responsive table-bordered');


        //Set inputs obligatoris
        const arrInserts = ['Nom de l\'event: ','Data de l\'event','Poster'];
        const arrInputs = ['text','date','file'];

        for(let i = 0; i<arrInserts.length;i++) {
            taula.appendChild(creaCamp(arrInserts[i],arrInputs,i));
        }
        formInsert.appendChild(taula);


        //Set TEXTAREA especifica
        const tr = document.createElement('TR');
            const th = document.createElement('TH');
            const txtTh = document.createTextNode('Desc de l\'event');
            th.appendChild(txtTh);
        tr.appendChild(th);
            const td = document.createElement('TD');
            tr.appendChild(td);
            const textarea = document.createElement('TEXTAREA');
            textarea.setAttribute('cols','50');
            textarea.setAttribute('name','inputtextareaDes');
            textarea.setAttribute('id','inputtextareaDes');
            td.appendChild(textarea);
            tr.appendChild(generaErrLabel('Introdueix una Descripció vàlida.'))

        taula.appendChild(tr);

        const firstRow = taula.firstChild;
        taula.insertBefore(tr,firstRow.nextSibling);

        //Set Selects
        $.getJSON("../organitzadorsBackend/api/readAllCategories.php", function(data){
            const select = document.createElement('SELECT');
            select.setAttribute('class','form-control');
            select.setAttribute('id','selectCatId');
            select.setAttribute('name','selectCatId');
            $.each(data, function(key, value){
                const opt = document.createElement('OPTION');
                opt.setAttribute('value',value.id_cat);
                const txtOpt = document.createTextNode(value.nom_cat);
                opt.appendChild(txtOpt);
                select.appendChild(opt);
            });
            const tr = document.createElement('TR');
            const th = document.createElement('TH');
            const txtTh = document.createTextNode('Categoria');
            th.appendChild(txtTh);
            tr.appendChild(th);
            const td = document.createElement('TD');
            td.appendChild(select);
            tr.appendChild(td);
            taula.appendChild(tr);
        });//Perque CATEGORY (JSON) s'esta executant es darrer????????????????????


        //Set Radios
        const arrRadio = ['Public','Privat'];
        function creaRadios(arrRadio) {
            const tr = document.createElement('TR');
            const th = document.createElement('TH');
            const txtTh = document.createTextNode('Tipus Event:');
            th.appendChild(txtTh);
            tr.appendChild(th);
            const td = document.createElement('TD');
            for (let i = 0; i < arrRadio.length; i++) {
                const input = document.createElement('INPUT');
                input.setAttribute('type','radio');
                const label = document.createElement('LABEL');
                const txtLabel = document.createTextNode(arrRadio[i]);
                label.appendChild(txtLabel);
                td.appendChild(label);
                input.setAttribute('name','radioTipusEvent');
                input.setAttribute('id','inputRadio'+arrRadio[i]);
                input.setAttribute('value',arrRadio[i]);
                td.appendChild(input);
            }
            tr.appendChild(td);
                tr.appendChild(generaErrLabel('Error: marqui una opció.'));
            taula.appendChild(tr);
        }
        creaRadios(arrRadio);


        //Set inputs no obligatoris CHECKBOXES
            //Aforament
        const trCheckboxAfo = creaCampBasic('Aforo','checkbox');    //Insert Fila Checkbox
        taula.appendChild(trCheckboxAfo);

        const inputcheckboxAfo = trCheckboxAfo.firstChild.nextSibling.firstChild;   //Get Checkbox
        inputcheckboxAfo.addEventListener('change', function() {        //on change add input text Field
           if (inputcheckboxAfo.checked) {
               taula.insertBefore(creaCampBasic('Aforament','text'),trCheckboxAfo.nextSibling); //insertAfter
           } else {
                taula.removeChild(trCheckboxAfo.nextSibling);
           }
        });
            //Entrades
        const trCheckboxEnt = creaCampBasic('Entrades','checkbox');
        taula.appendChild(trCheckboxEnt);

        const inputcheckboxEnt = trCheckboxEnt.firstChild.nextSibling.firstChild;   //Get Checkbox
        inputcheckboxEnt.addEventListener('change', function() {        //on change add input text Field
            if (inputcheckboxEnt.checked) {
                taula.insertBefore(creaCampBasic('Num Entrades','text'),trCheckboxEnt.nextSibling); //insertAfter
                taula.insertBefore(creaCampBasic('Preu Entrades', 'text'),trCheckboxEnt.nextSibling.nextSibling);
            } else {
                taula.removeChild(trCheckboxEnt.nextSibling); //Remove 1st text
                taula.removeChild(trCheckboxEnt.nextSibling);   //Remove 2nd txt (which now is 1st)
            }
        });


        //Set BUTTONS
            function creaSubmit(btType, btClass, btGlyph, btTxt) {
                const btSubmit = document.createElement('BUTTON');
                btSubmit.setAttribute('type',btType);
                btSubmit.setAttribute('class',btClass);
                const span = document.createElement('SPAN');
                span.setAttribute('class',btGlyph);
                const txtSpan = document.createTextNode(btTxt);

                btSubmit.appendChild(span);
                btSubmit.appendChild(txtSpan);
                formInsert.appendChild(btSubmit);
            }
            creaSubmit('reset','btn btn-danger','fas fa-close',' Cancel·la');
            creaSubmit('submit','btn btn-primary', 'far fa-save',' Guarda i Publica');


        core.appendChild(formInsert);
    });
    //EVENTS RESET
    $(document).on('reset','#create-product-form', function(e) {
        e.preventDefault();
       if(confirm('es possible que els canvis es perdin? Desitja continuar?')) {

           readAllEvents();
       } else {

       }
    });


    //EVENTS SUBMIT
    $(document).on('submit', '#create-product-form', function(e){
        e.preventDefault();
        //VALIDACIONS
        const inputtextNom = document.getElementById('inputtextNom');
            const inputtextareaDes = document.getElementById('inputtextareaDes');
        const inputdateDat = document.getElementById('inputdateDat');
        const inputfilePos = document.getElementById('inputfilePos');
        const inputRadioPublic = document.getElementById('inputRadioPublic');
        const inputRadioPrivat = document.getElementById('inputRadioPrivat'); //Utilitzar una Validacio aposta...

        //checkboxes
        const inputcheckboxAfo = document.getElementById('inputcheckboxAfo');
        const inputcheckboxEnt = document.getElementById('inputcheckboxEnt');

        const arrControl = [];
        arrControl.push(validarCampsFormulari(validarNom(inputtextNom.value),inputtextNom));
            arrControl.push(validarCampsFormulari(validarTextarea(inputtextareaDes.value),inputtextareaDes));
        arrControl.push(validarCampsFormulari(validarData(inputdateDat.value),inputdateDat));
        arrControl.push(validarCampsFormulari(validarImatge(inputfilePos),inputfilePos));
        arrControl.push(validarCampsFormulari(validarRadio(inputRadioPublic,inputRadioPrivat),inputRadioPrivat));

        if(inputcheckboxAfo.checked) {
            const inputtextAfo = document.getElementById('inputtextAfo');
            inputtextAfo.parentNode.parentNode.appendChild(generaErrLabel('Valor incorrecte')); //input^td^tr.td>
            arrControl.push(validarCampsFormulari(validarSencer(inputtextAfo.value),inputtextAfo));
        }
        if(inputcheckboxEnt.checked) {
            const inputtextNumEnt = document.getElementById('inputtextNum');
            inputtextNumEnt.parentNode.parentNode.appendChild(generaErrLabel('Valor incorrecte')); //input^td^tr.td>
            arrControl.push(validarCampsFormulari(validarSencer(inputtextNumEnt.value),inputtextNumEnt));
            const inputtextPreuEnt = document.getElementById('inputtextPre');
            inputtextPreuEnt.parentNode.parentNode.appendChild(generaErrLabel('Valor incorrecte')); //input^td^tr.td>
            arrControl.push(validarCampsFormulari(validarFloat(inputtextPreuEnt.value),inputtextPreuEnt));
        }

        if(
            !arrControl.includes(false)
        ) {
            $.ajax({
                url: "../organitzadorsBackend/api/createEvents.php",
                type : "POST",
                data: new FormData(this), //This way is actually faster ...
                dataType: 'json',
                processData: false,
                cache: false,
                contentType : false,        //tema cookies? pero aquesta merda no se menja "application/json"????
                //data : data, //form_data, //old way
                success : function(result) {
                    // item created, go back to ReadAll (to display the last insert! :O)
                    readAllEvents();
                },
                error: function(xhr, resp, text) {
                    // show error to console
                    console.log(xhr, resp, text);
                }
            });
        } else {
            //var form_data=JSON.stringify($(this).serializeObject());// get form data -> aixo creava un Obj JSON amb key value del form (name, value)
            //Segons en Tomeu, mos basta passar key value per POST ja que:
                //-Passar la img per JSON implica encode64 (33% mes de pes en la img per enviar-la al server que per POST plano)
                //-A mes es preferible guardar la img com un recurs que com un BLOB($_FILE -> ens permet accedir/guardar la img a partir de la seva ruta) perque es mes accessible
                //-A la db hi tendrem rutes, que pesen manco que les img també!
        }
        return false;
    });
};