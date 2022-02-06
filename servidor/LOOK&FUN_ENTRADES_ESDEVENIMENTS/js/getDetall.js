// @author Xesc

$(document).ready(function(){

    $(document).on('click', '.read-one-product-button', function(){ //en clicar a Detalls
        // get product id
        const id = $(this).attr('data-id');
        // read item record based on given ID
        $.getJSON("api/readOneEsdeveniment.php?id=" + id, function(data){
            const core = $('#taula')[0];
            const crea = $('#crea')[0];

            //reset Node rapid
            $(core).html('');
            $(crea).html('');

            //Crea boto per tornar enrera;
            const btBack = document.createElement('BUTTON');
            btBack.setAttribute('class','btn btn-primary pull-right read-products-button'); //Onclick is on readAllEvents
            const btBackGlyph = document.createElement('SPAN');
            btBackGlyph.setAttribute('class','far fa-list-alt');
            const txtBtBack = document.createTextNode(' Visualitza Tots');
            btBack.appendChild(btBackGlyph);
            btBack.appendChild(txtBtBack);
            core.appendChild(btBack);

            //Crea taula amb el resultat
            const taula = document.createElement('TABLE');
            //$each innecessari perq nomes hi haura 1 item
            //const arrThead = ['Nom','Organitza','Categoria','Descripció','Data','Cartell']; //To do maybe
            const arrThead = [];
            const arrData = [];
            $.each(data, function(key, value) {
                arrThead.push(key); //This way is simple, but amb s'array de adalt it might just work, test later.
                arrData.push(value);
            });
            //tryhardeam molt pero acursa codi
            for (let i = 0; i<arrThead.length-1; i++) {
                if(arrThead[i]==='poster')i++;
                const tr = document.createElement('TR');
                const th = document.createElement('TH');
                const txtTh = document.createTextNode(arrThead[i]);
                th.appendChild(txtTh);
                const td = document.createElement('TD');
                const txtTd = document.createTextNode(arrData[i]);
                td.appendChild(txtTd);
                tr.appendChild(th);
                tr.appendChild(td);
                taula.appendChild(tr);
            }
            //Poster requereix mes merda
            const tr = document.createElement('TR');
            const th = document.createElement('TH');
            const txtTh = document.createTextNode('Cartell');
            th.appendChild(txtTh);
            const td = document.createElement('TD');
            const img = document.createElement('IMG');
            //img.setAttribute('src','data:image/jpg;base64, '+data.poster); //old way
            //set full route for img
            const imgPath = 'api/resources/url_img/'+data.poster_esdeveniment; //no me queda mes remei perq dins api me es fotut guardar ../ com a GLOBAL me fa por...
            img.setAttribute('src',imgPath);
            img.style.maxWidth = "300px";
            td.appendChild(img);
            tr.appendChild(th);
            tr.appendChild(td);
            taula.appendChild(tr);
            core.appendChild(taula);
        });
    });
});