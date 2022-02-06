window.onload = function() {
    generaNavbar("administrador");

    //variables necessaries
    const formulari09 = document.getElementById('f09');
    const formulari10 = document.getElementById('f10');

        //
        //TAGS
        //Llista de Tags
        formulari09.appendChild(creaPar('select','inputSelectTag','','Categoria Event: ',false));
        const inputSelectTag = document.getElementById('inputSelectTag');
        const arrTags = JSON.parse(tags());
        poblaSelectFromArr(arrTags, inputSelectTag, 0);
        //Afageix Categories
        formulari09.appendChild(creaPar('input','inputTextTags','text','Afageix tags: ',true));
        const inputTextTag = document.getElementById('inputTextTags');
        generaLlistaTodos(formulari09, inputTextTag, 'tags');
        //BUTTONS reset i Submit Form Categories
        formulari09.appendChild(creaBtn('reset','clearFormulari09','Cancel·la Canvis'));
        formulari09.appendChild(creaBtn('submit','enviaFormulari09','Guarda Canvis'));
        const enviaFormulari09 = document.getElementById('enviaFormulari09');
        enviaFormulari09.setAttribute('class','btn btn-primary');
        //Genera events RESET i SUBMIT del Formulari5
        formulari09.addEventListener('reset', function() {
        });
        formulari09.addEventListener('submit', function(e) {
            e.preventDefault(); //Evita enviar el formulari
        });

        //CATEGORIES
        //Llista de Categories
        formulari10.appendChild(creaPar('select','inputSelectCategoria','','Categoria Event: ',false));
        const inputSelectCategoria = document.getElementById('inputSelectCategoria');
        const arrCategories = JSON.parse(categories());
        poblaSelectFromArr(arrCategories, inputSelectCategoria, 0);
        //Afageix Categories
        formulari10.appendChild(creaPar('input','inputTextCategories','text','Afageix categories: ',true));
        const inputTextCategories = document.getElementById('inputTextCategories');
        generaLlistaTodos(formulari10, inputTextCategories, 'categories');

        //BUTTONS reset i Submit Form Categories
        formulari10.appendChild(creaBtn('reset','clearFormulari10','Cancel·la Canvis'));
        formulari10.appendChild(creaBtn('submit','enviaFormulari10','Guarda Canvis'));
        const enviaFormulari10 = document.getElementById('enviaFormulari10');
        enviaFormulari10.setAttribute('class','btn btn-primary');
        //Genera events RESET i SUBMIT del Formulari5
        formulari10.addEventListener('reset', function() {
        });
        formulari10.addEventListener('submit', function(e) {
            e.preventDefault(); //Evita enviar el formulari
        });

};