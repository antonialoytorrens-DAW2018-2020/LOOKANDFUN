//PROVES
    function valida() {
        return true;
    }
//NODES
    //Elimina un Node / Alternativa a node.innerHTML = '';
    function resetNode(node) {
        //Si el node te fills
        if(node.hasChildNodes()) {
            //rebenta el primer fill mentres tengui un fill
            while (node.firstChild) {
                node.removeChild(node.firstChild);
            }
        }
    }
    //Uneix dos Nodes(paragrafs)
    function mergePars(parStay,parDelete) {
        //mou els fills al primer Par
        while (parDelete.childNodes.length > 0) {
            parStay.appendChild(parDelete.childNodes[0]);
        }
        //elimina el segon par
        parDelete.remove();
    }

//INPUTS
    //funcio generica, crea un P, i a dedins in input(variable) type='variable' amb txtNode(variable). //En desuso bcs of Bootstrap BTW
    function creaPar(tipusNode, idInput, tipusInput, txtNode, error) {
        const par = document.createElement('P');
            const creaInput = document.createElement(tipusNode);
            if (tipusInput!=='') {
                creaInput.setAttribute('type', tipusInput);
            }
            creaInput.id = idInput;
                    const creaLabel = document.createElement('LABEL');
                    const txtLabel = document.createTextNode(txtNode);
                    creaLabel.appendChild(txtLabel);
                par.appendChild(creaLabel);
                par.appendChild(creaInput);
                if(error) {
                    const creaLabelErr = document.createElement('LABEL');
                    //creaLabelErr.setAttribute('id',idInput+'Err'); //funca per si ho necessit in the future
                        creaLabelErr.setAttribute('class','labelError amaga'); //css Class + HIDE before submit
                    const txtLabelErr = document.createTextNode('error');
                    creaLabelErr.appendChild(txtLabelErr);
                    par.appendChild(creaLabelErr);
                }
        return par;
    }

    //Crea Inputs dins una taula en base a dos arrays.
        //Exemple
            //const arrInserts = ['Nom de l\'event: ','Desc de l\'event','Data de l\'event','Poster','Aforament'];
        //         const arrInputs = ['text','textarea','date','file','text'];
        //
        //         for(let i = 0; i<arrInserts.length;i++) {
        //             taula.appendChild(creaCamp(arrInserts[i],arrInputs,i));
        //         };
        //         formInsert.appendChild(taula);
    function creaCamp(txtNode, arrInputs,i) {
        const tr = document.createElement('TR');
        const th = document.createElement('TH');
        const txtTh = document.createTextNode(txtNode);
        th.appendChild(txtTh);
        tr.appendChild(th);
        const td = document.createElement('TD');
        let str = 'input'+arrInputs[i]+txtNode.substring(0,3);
        td.appendChild(creaFormField(arrInputs[i],str));
        tr.appendChild(td);
        const tdErr = document.createElement('TD');
        tdErr.setAttribute('class','spanError');
        tdErr.style.border = "none";
        tdErr.style.display = "none";
        str = 'Error: introdueix un valor vàlid.';
        const txtTdErr = document.createTextNode(str);
        tdErr.appendChild(txtTdErr);
        tr.appendChild(tdErr);
        return tr;
    }
    //Crea un input eg:('text', 'inputtextDoi')
    function creaFormField(inType,inId) {
        const input = document.createElement('INPUT');
        input.setAttribute('type',inType);
        input.setAttribute('class','form-control');
        input.setAttribute('id',inId);
        input.setAttribute('name',inId);
        return input;
    }

function creaCampBasic(txtNode, input) {
    const tr = document.createElement('TR');
    const th = document.createElement('TH');
    const txtTh = document.createTextNode(txtNode);
    th.appendChild(txtTh);
    tr.appendChild(th);
    const td = document.createElement('TD');
    let str = 'input'+input+txtNode.substring(0,3);
    td.appendChild(creaFormField(input,str));
    tr.appendChild(td);
    return tr;
}

//SELECTS
    //funcio generica crea un Select en base a un Array simple donat
    function poblaSelectFromArr(arr, select, counter) {
        while (counter<arr.length) {
            const n = arr.length;
                const opt = document.createElement('OPTION');
                const txtOpt = document.createTextNode(arr[counter]);
                opt.appendChild(txtOpt);
                return select.appendChild(opt) + poblaSelectFromArr(arr,select, counter+1)
        }
    }

//LLISTES
    //funcio generica afageix items a una llista i permet borrar-los
    function afageixItemLlista(item) {
        const li = document.createElement('LI');
        const txtLi = document.createTextNode(item);
        li.appendChild(txtLi);
        const clearBt = creaBtn('button', '','');
        const icona = document.createElement('I');
        icona.setAttribute('class','fas fa-trash-alt');
        clearBt.appendChild(icona);
        li.appendChild(clearBt);
        clearBt.addEventListener('click', function() {
            clearBt.parentNode.parentNode.removeChild(li);
        });
        return li;
    }
    //Funcio generica crea llistes estil TODOS, les aferra a un formulari
    function generaLlistaTodos(form, inputItems, descItem) {
        const nodeInputItems = inputItems.parentNode;
        nodeInputItems.appendChild(creaBtn('button','afageix'+descItem,'Afageix'));
        form.appendChild(creaPar('UL','llista'+descItem,'','Llista de '+descItem,false));
        const llistaItems = document.getElementById('llista'+descItem);
        const btAfageixItem = document.getElementById('afageix'+descItem);
        const labelErrLlistaItems = inputItems.nextSibling;
        btAfageixItem.after(labelErrLlistaItems); //Mou el label a una posicio mes neta...
        btAfageixItem.addEventListener('click', function() {
            //validar TAGS before insert
            if(!validarNoBuit(inputItems.value)) {
                labelErrLlistaItems.classList.remove('amaga');
            } else {
                labelErrLlistaItems.classList.add('amaga');
                llistaItems.appendChild(afageixItemLlista(inputItems.value));
                inputItems.value = '';
            }
            //const valorInputTextTags = inputTextTags.value;
        });
    }

    //Funcio generica crea una Label d'Error Custom
    function generaErrLabel(str) {
        const tdErr = document.createElement('TD');
        tdErr.setAttribute('class','spanError');
        tdErr.style.border = "none";
        tdErr.style.display = "none";
        const txtTdErr = document.createTextNode(str);
        tdErr.appendChild(txtTdErr);
        return tdErr;
    }

//BOTONS
    //Crea un Boto (reset, submit, etc.)
    function creaBtn(tipusBoto, idBoto, txtBoto) {
        const bt = document.createElement('BUTTON');
        bt.setAttribute('type',tipusBoto);
        bt.id = idBoto;
        const txtBt = document.createTextNode(txtBoto);
        bt.appendChild(txtBt);
        return bt;
    }
    //Crea un Boto CRUD amb coses GUAYS
        //eg: creaBtnCRUD(value.id_event,'btn btn-danger delete-product-button','far fa-trash-alt',' Delete');
            //Notese: li passam com a id l'id de l'item (row)
            //eg: boto de delete -> delete from taula where id=valueDelBoto que enviarem (que sera un Id de un item)
    function creaBtnCRUD(idItem, classBt, classSpan, nomBt) {
        const bt = document.createElement('BUTTON');
        bt.setAttribute('class',classBt);
        bt.setAttribute('data-id',idItem);
        const span = document.createElement('SPAN');
        span.setAttribute('class',classSpan);
        //span.style.color = "white";
        const txtSpan = document.createTextNode(nomBt);

        bt.appendChild(span);
        bt.appendChild(txtSpan);
        return bt;
    }