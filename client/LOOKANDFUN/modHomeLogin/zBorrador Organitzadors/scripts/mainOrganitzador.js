window.onload = function() {
    generaNavbar("organitzador");

    //variables necessaries
    const btCrea = document.getElementById('crearEvent');
    const formulari05 = document.getElementById('f05');
    const div06 = document.getElementById('f06');
    //Variables per ambas funcions
    //Desplega Formulari5 creador d'events
    btCrea.addEventListener('click', function(e) {
        btCrea.classList.add('amaga'); //amaga el boto de crea
        //Genera els INPUTS
        //Input TEXT Nom
        formulari05.appendChild(creaPar('input','inputTextNom','text','Nom event: ',true));
        const test = document.getElementById('inputTextNom');
        test.setAttribute('class','form-control');
        test.setAttribute('placeholder','this is a test');
        test.setAttribute('required','');
        //SELECT Categories
        formulari05.appendChild(creaPar('select','inputSelectCategoria','','Categoria Event: ',false));
            const inputSelectCategoria = document.getElementById('inputSelectCategoria');
            const arrCategories = JSON.parse(categories());
            poblaSelectFromArr(arrCategories, inputSelectCategoria, 0);
        //LLISTA Tags
        formulari05.appendChild(creaPar('input','inputTextTags','text','Afageix tags: ',true));
            const inputTextTags = document.getElementById('inputTextTags');
            const nodeInputTextTags = inputTextTags.parentNode;
            nodeInputTextTags.appendChild(creaBtn('button','afageixTag','Afageix'));
        formulari05.appendChild(creaPar('UL','llistaTags','','Llista de tags',false));
            const llistaTags = document.getElementById('llistaTags');
            const btAfageixTag = document.getElementById('afageixTag');
                const labelErrLlistaTags = inputTextTags.nextSibling;
                btAfageixTag.after(labelErrLlistaTags); //Mou el label a una posicio mes neta...
            btAfageixTag.addEventListener('click', function() {
                //validar TAGS before insert
                if(!validarNoBuit(inputTextTags.value)) {
                    labelErrLlistaTags.classList.remove('amaga');
                } else {
                    labelErrLlistaTags.classList.add('amaga');
                    llistaTags.appendChild(afageixItemLlista(inputTextTags.value));
                    inputTextTags.value = '';
                }
                //const valorInputTextTags = inputTextTags.value;
            });
        //RADIO tipo event
        formulari05.appendChild(creaPar('input','inputRadioPublic','radio','Públic',false));
        const inputRadioPublic = document.getElementById('inputRadioPublic');
            inputRadioPublic.setAttribute('value','Public');
            inputRadioPublic.setAttribute('name','grupRadioTipusEvent');
        formulari05.appendChild(creaPar('input','inputRadioPrivat','radio','Privat',true));
        const inputRadioPrivat = document.getElementById('inputRadioPrivat');
            inputRadioPrivat.setAttribute('value','Privat');
            inputRadioPrivat.setAttribute('name','grupRadioTipusEvent');
                //mou el radiobutton al primer Par
                const parInputRadioPublic = inputRadioPublic.parentNode;
                const parInputRadioPrivat = inputRadioPrivat.parentNode;
                mergePars(parInputRadioPublic,parInputRadioPrivat);
        //LLISTA Organitzadors
        formulari05.appendChild(creaPar('input','inputTextOrg','text','Afageix organitzadors: ',true));
        const inputTextOrg = document.getElementById('inputTextOrg');
        const nodeInputTextOrg = inputTextOrg.parentNode;
        nodeInputTextOrg.appendChild(creaBtn('button','afageixOrg','Afageix'));
        formulari05.appendChild(creaPar('UL','llistaOrg','','Llista de organitzadors',false));
        const llistaOrg = document.getElementById('llistaOrg');
        const btAfageixOrg = document.getElementById('afageixOrg');
            const labelErrLlistaOrg = inputTextOrg.nextSibling;
            btAfageixOrg.after(labelErrLlistaOrg); //Mou el label a una posicio mes neta...
        btAfageixOrg.addEventListener('click', function() {
            const valorInputTextOrg = inputTextOrg.value;
            //validar Orgtzs before insert
            if(!validarNoBuit(inputTextOrg.value)) {
                labelErrLlistaOrg.classList.remove('amaga');
            } else {
                labelErrLlistaOrg.classList.add('amaga');
                llistaOrg.appendChild(afageixItemLlista(inputTextOrg.value));
                inputTextOrg.value = '';
            }
        });
        //a la llista sortim nosaltres per defecte, tot i que seria un search amb autocomplete

        //Input DATE Dates
        formulari05.appendChild(creaPar('input','inputDateIniciEvent','date','Data inici: ',true));
        formulari05.appendChild(creaPar('input','inputDateIniciEvent','date','Data final: ',true));

        //input CHECKBOX Aforo
        formulari05.appendChild(creaPar('input','inputCheckAforo','checkbox','Designar Aforament',false)); //Camp Opcional
            //const parInputCheckAforo = document.getElementById('inputCheckAforo').parentNode;
        formulari05.appendChild(creaPar('input','inputTextAforo','text','Aforament disponible: ',true)); //Aforo no es crea i destrueix nomes s'amaga... Ja que si no esta checked l'anterior el valor aqui anyway seria null???
            const parinputTextAforo = document.getElementById('inputTextAforo').parentNode;
            parinputTextAforo.setAttribute('class','amaga'); //desplega el Par contenedor del inputTextAforo!
                const inputCheckAforo = document.getElementById('inputCheckAforo');
                inputCheckAforo.addEventListener('change', function() {
                   parinputTextAforo.classList.toggle('amaga');
                });

        //localitzacio, son 3 SELECTS les passam per array.
        formulari05.appendChild(creaPar('select','inputSelectCCAA','','Localització: ',false));
        const inputSelectCCAA = document.getElementById('inputSelectCCAA');
        const arrCCAA = JSON.parse(CCAA());
        poblaSelectFromArr(arrCCAA, inputSelectCCAA, 0);

        formulari05.appendChild(creaPar('select','inputSelectProvincies','','',false));
        const inputSelectProvincies = document.getElementById('inputSelectProvincies');
        const arrProvincies = JSON.parse(provincies());
        poblaSelectFromArr(arrProvincies, inputSelectProvincies, 0);

        formulari05.appendChild(creaPar('select','inputSelectMunicipis','','',false));
        const inputSelectMunicipis = document.getElementById('inputSelectMunicipis');
        const arrMunicipis = JSON.parse(municipis());
        poblaSelectFromArr(arrMunicipis, inputSelectMunicipis, 0);

        const parInputSelectMunicipis = inputSelectMunicipis.parentNode;
        const parInputSelectProvincies = inputSelectProvincies.parentNode;
        const parInputSelectCCAA = inputSelectCCAA.parentNode;
        mergePars(parInputSelectProvincies,parInputSelectMunicipis);
        mergePars(parInputSelectCCAA, parInputSelectProvincies);
        //Input FILE Poster
        formulari05.appendChild(creaPar('input','inputFilePoster','file','Cartell',false));//De moment no validam POSTER

        //RADIO Entrades
        formulari05.appendChild(creaPar('input','inputRadioEntradesFalse','radio','Sense entrades',false));
        const inputRadioEntradesFalse = document.getElementById('inputRadioEntradesFalse');
        inputRadioEntradesFalse.setAttribute('name','grupInputRadioEntradesBool');
            inputRadioEntradesFalse.setAttribute('checked','true');//By default
        formulari05.appendChild(creaPar('input','inputRadioEntradesTrue','radio','Amb Entrades',true));
        const inputRadioEntradesTrue = document.getElementById('inputRadioEntradesTrue');
        inputRadioEntradesTrue.setAttribute('name','grupInputRadioEntradesBool');
        //mou el radiobutton al primer Par
        const parInputRadioEntradesFalse = inputRadioEntradesFalse.parentNode;
        const parInputRadioEntradesTrue = inputRadioEntradesTrue.parentNode;
        mergePars(parInputRadioEntradesFalse,parInputRadioEntradesTrue);

        //DIV Entrades Pagament
        const divEntrades = document.createElement('DIV');
        divEntrades.setAttribute('id','contEntrades');
        formulari05.appendChild(divEntrades);
            const contEntrades = document.getElementById('contEntrades');

        //Afageix Events als RADIO Entrades
        inputRadioEntradesTrue.addEventListener('change', function() {
           if(inputRadioEntradesTrue.checked) {
               inputRadioEntradesFalse.checked = false;//Doble verificacio just in case?
               //Desplega Inputs ENTRADES
               //input TEXT Nº Entrades a la Venta, pot diferir de Aforament
               divEntrades.appendChild(creaPar('input','inputTextNumEntrades','text','Nº Entrades a la venta: ',true));

               //FALTA FICAR ES MODE BUTACA AQUI?

               //RADIO Preu Entrades
               divEntrades.appendChild(creaPar('input','inputRadioEntradesGratis','radio','Gratuit'));
               const inputRadioEntradesGratis = document.getElementById('inputRadioEntradesGratis');
               inputRadioEntradesGratis.setAttribute('name','grupInputRadioEntrades');
                    inputRadioEntradesGratis.setAttribute('checked','true');//By default
               divEntrades.appendChild(creaPar('input','inputRadioEntradesPreu','radio','Defineix Preu',true));
               const inputRadioEntradesPreu = document.getElementById('inputRadioEntradesPreu');
                    inputRadioEntradesPreu.setAttribute('name','grupInputRadioEntrades');

               const parInputRadioEntradesGratis = inputRadioEntradesGratis.parentNode;
               const parInputRadioEntradesPreu = inputRadioEntradesPreu.parentNode;
               mergePars(parInputRadioEntradesGratis, parInputRadioEntradesPreu);
                    //Events RADIO Tipus Preu
                    inputRadioEntradesPreu.addEventListener('change', function() {
                       if(inputRadioEntradesPreu.checked) {
                           inputRadioEntradesGratis.checked = false;
                           inputTextPreuEntrades.removeAttribute('disabled');

                           divTPV.appendChild(creaPar('input','inputTextNIFBanc','text','Introdueix el teu NIF/CIF: ',true));
                           divTPV.appendChild(creaPar('input','inputTextIBANBanc','text','Introdueix el teu IBAN: '));
                       }
                    });
                   inputRadioEntradesGratis.addEventListener('change', function() {
                       if(inputRadioEntradesGratis.checked) {
                           inputRadioEntradesPreu.checked = false;
                           inputTextPreuEntrades.setAttribute('value','');
                           inputTextPreuEntrades.setAttribute('disabled','true');

                           resetNode(divTPV);
                       }
                   });
                //input TEXT Preu Entrades
               divEntrades.appendChild(creaPar('input','inputTextPreuEntrades','text','Preu Entrada: ',true));
                    const inputTextPreuEntrades = document.getElementById('inputTextPreuEntrades');
                    inputTextPreuEntrades.setAttribute('disabled','true');

               //DIV Entrades Dades Bancaries
               const divTPV = document.createElement('DIV');
               divTPV.setAttribute('id','contTPV');
               divEntrades.appendChild(divTPV);
               const contTPV = document.getElementById('contTPV');

           }
        });
        inputRadioEntradesFalse.addEventListener('change', function() {
            if(inputRadioEntradesFalse.checked) {
                inputRadioEntradesTrue.checked = false;//Doble verificacio just in case?
                //resset Inputs ENTRADES
                resetNode(contEntrades);
            }
        });
        //BUTTONS reset i Submit
        formulari05.appendChild(creaBtn('reset','clearFormulari05','Cancel·la'));
        formulari05.appendChild(creaBtn('submit','enviaFormulari05','Publica Event'));
        const enviaFormulari05 = document.getElementById('enviaFormulari05');
        enviaFormulari05.setAttribute('class','btn btn-primary');

        //Genera events RESET i SUBMIT del Formulari5
        formulari05.addEventListener('reset', function() {
            resetNode(formulari05);
            btCrea.classList.remove('amaga'); //Ensenya el boto de crea
        });

        formulari05.addEventListener('submit', function(e) {
            e.preventDefault(); //Evita enviar el formulari
            //Valida el Nom
            const inputTextNom = document.getElementById('inputTextNom');
            let labelErr = inputTextNom.nextSibling;
            if(!validarNoBuit(inputTextNom.value)) {
                labelErr.classList.remove('amaga');
            } else {
                labelErr.classList.add('amaga');
            }
            //Valida la llista de tags (en principi s'ha validat a cada item)
            //Valida 1 Radio is checked (public i privat)
            labelErr = inputRadioPrivat.nextSibling;
            if(!validarRadio(inputRadioPublic, inputRadioPrivat)) {
                labelErr.classList.remove('amaga');
            } else  {
                labelErr.classList.add('amaga');
            }
            //Valida la llista de Org (en principi s'ha validat a cada item)
            //Valida les Dates (agafam de compartides)
            //aforament (es opcional)
                //if checked   //valida un numero
                labelErr = parinputTextAforo.firstChild.nextSibling.nextSibling; //P->label->input->labelErr
                const inputTextAforo = parinputTextAforo.firstChild.nextSibling;
                if(inputCheckAforo.checked) {
                    if(!validarSencer(inputTextAforo.value)) {
                        labelErr.classList.remove('amaga');
                    } else  {
                        labelErr.classList.add('amaga');
                    }
                }
            //Localitzacio, es un select i de moment no escau validar
            //Cartell, no valida de moment

            //Radio entrades (per defecte marca Sense entrades, pero checkeam contra Listillos)
            labelErr = inputRadioEntradesTrue.nextSibling;
            if(!validarRadio(inputRadioEntradesFalse, inputRadioEntradesTrue)) {
                labelErr.classList.remove('amaga');
            } else  {
                labelErr.classList.add('amaga');
            }
                    //AMB ENTRADES
                    if(inputRadioEntradesTrue.checked) {
                        //VALIDA ENTRADES
                        //Num Entrades
                        const inputTextEntrades = contEntrades.firstChild.firstChild.nextSibling; //Div->p->label->input
                        let labelErr = inputTextEntrades.nextSibling;
                        if(!validarSencer(inputTextEntrades.value)) {
                            labelErr.classList.remove('amaga');
                        } else labelErr.classList.add('amaga');
                        //Mode Butaca
                        //Radio button

                        const inputRadioEntradesGratis = document.getElementById('inputRadioEntradesGratis');
                        const inputRadioEntradesPreu = document.getElementById('inputRadioEntradesPreu');
                        labelErr = inputRadioEntradesPreu.nextSibling;
                        if(!validarRadio(inputRadioEntradesGratis, inputRadioEntradesPreu)) {
                            labelErr.classList.remove('amaga');
                        } else  {
                            labelErr.classList.add('amaga');
                        }
                            //AMB PREU
                            //Valida com cobrar les entrades per TPVirtual
                            if(inputRadioEntradesPreu.checked) {
                                const contEntrades = document.getElementById('contEntrades');
                                const contTPV = document.getElementById('contTPV');
                                //Preu Entrada
                                const preuEntrades = contEntrades.firstChild.nextSibling.nextSibling.firstChild.nextSibling; //div->p-p-p->label-input
                                labelErr = preuEntrades.nextSibling;
                                if(!validarNoBuit(preuEntrades.value)) {
                                    labelErr.classList.remove('amaga');
                                } else {
                                    labelErr.classList.add('amaga');
                                }
                                //CIF/NIF
                                const CIF = contTPV.firstChild.firstChild.nextSibling;  //div->p->label-input
                                labelErr = CIF.nextSibling;
                                if(!validarNoBuit(CIF.value)) {
                                    labelErr.classList.remove('amaga');
                                } else {
                                    labelErr.classList.add('amaga');
                                }
                                //IBAN

                            }

                    }
        });
    });

};