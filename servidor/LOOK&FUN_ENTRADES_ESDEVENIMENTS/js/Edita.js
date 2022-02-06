// @author Toni

$(document).ready(function () {
    

    $(document).on('click', '.update-product-button', function () { //en clicar a Edita
        // get product id
        const id = $(this).attr('data-id');
        // read item record based on given ID
        $.getJSON("api/readOneEsdeveniment.php?id=" + id, function (data) {
            const core = $('#taula')[0];
            const crea = $('#crea')[0];

            //reset Node rapid
            $(core).html('');
            $(crea).html('');

            //Crea taula amb el resultat
            const taula = document.createElement('TABLE');

            const form = $("<form method='POST' action='api/updEsdeveniment.php' enctype='multipart/form-data' id='formupdEsdeveniment'></form>");

            //$each innecessari perq nomes hi haura 1 item
            //const arrThead = ['Nom','Organitza','Categoria','Descripció','Data','Cartell']; //To do maybe
            const arrThead = [];
            const arrData = [];
            $.each(data, function (key, value) {
                arrThead.push(key); //This way is simple, but amb s'array de adalt it might just work, test later.
                arrData.push(value);
            });
            //tryhardeam molt pero acursa codi
            var taula2 = $("<table></table>");

            // JQUERY

            for (let i = 0; i < arrThead.length - 1; i++) {
                if (arrThead[i] === 'poster') i++;
                const txtTh = arrThead[i];
                //const txtValue = arrData[i];
                const txtValue = arrData[i];
                console.log(txtValue);
                const fila = $("<tr><th>"+txtTh+"<td><input type='text' id="+txtTh+" name="+txtTh+" value="+txtValue+"></input></td></th></tr>");
                taula.append(fila[0]);
            }
            core.append(taula[0]);
            
            /*for (let i = 0; i < arrThead.length - 1; i++) {
                if (arrThead[i] === 'poster') i++;
                const tr = document.createElement('TR');
                const th = document.createElement('TH');
                const txtTh = document.createTextNode(arrThead[i]);
                th.appendChild(txtTh);
                const td = document.createElement('TD');
                const input = document.createElement('INPUT');
                input.setAttribute('type', 'text');
                // INPUT ID
                input.setAttribute('id', arrThead[i]);
                // INPUT NAME
                input.setAttribute('name', arrThead[i]);
                input.value = arrData[i];
                td.appendChild(input);
                tr.appendChild(th);
                tr.appendChild(td);
                taula.appendChild(tr);
            }*/
            //Poster requereix mes merda
            const tr = document.createElement('TR');
            const th = document.createElement('TH');
            const txtTh = document.createTextNode('Canvia la imatge del cartell');
            th.appendChild(txtTh);
            const td = document.createElement('TD');
            const img = document.createElement('IMG');
            //img.setAttribute('src','data:image/jpg;base64, '+data.poster); //old way
            //set full route for img
            const imgPath = 'api/resources/url_img/' + data.poster_esdeveniment; //no me queda mes remei perq dins api me es fotut guardar ../ com a GLOBAL me fa por...
            img.setAttribute('src', imgPath);
            img.style.maxWidth = "300px";
            td.appendChild(img);
            tr.appendChild(th);
            tr.appendChild(td);
            taula.appendChild(tr);
            form.append(taula);

            // Afegir input file per canviar el póster
            const inputFile = document.createElement("input");
            inputFile.setAttribute("type", "file");
            inputFile.setAttribute("name", "poster_esdeveniment");

            td.appendChild(inputFile);
            tr.appendChild(th);
            tr.appendChild(td);
            taula.appendChild(tr);
            form.append(taula);

            // Afegir product id al formulari
            const inputId = document.createElement("input");
            inputId.setAttribute("type", "hidden");
            inputId.setAttribute("name", "id_esdeveniment");
            inputId.setAttribute("value", id);

            // Afegir default path image al formulari
            const defaultPathImage = document.createElement("input");
            defaultPathImage.setAttribute("type", "hidden");
            defaultPathImage.setAttribute("name", "default_path_image");
            defaultPathImage.setAttribute("value", data.poster_esdeveniment);

            form.append(defaultPathImage);
            form.append(inputId);

            core.append(form[0]);

            // Crea botó per cancel·lar
            const btCancel = document.createElement('BUTTON');
            btCancel.setAttribute('class', 'btn btn-danger pull-right read-products-button'); //Onclick is on getEsdeveniments
            const btCancelGlyph = document.createElement('SPAN');
            btCancelGlyph.setAttribute('class', 'fa fa-window-close');
            const txtBtCancel = document.createTextNode(' Cancel·la');
            btCancel.appendChild(btCancelGlyph);
            btCancel.appendChild(txtBtCancel);
            core.appendChild(btCancel);

            // Crea botó per confirmar
            const btConfirm = document.createElement('BUTTON');
            btConfirm.setAttribute('type', 'submit');
            btConfirm.setAttribute('name', 'updEsdeveniment');
            btConfirm.setAttribute('class', 'btn btn-primary pull-right confirm-products-button');
            const btConfirmGlyph = document.createElement('SPAN');
            btConfirmGlyph.setAttribute('class', 'fa fa-check');
            const txtBtConfirm = document.createTextNode(' Confirma');
            btConfirm.appendChild(btConfirmGlyph);
            btConfirm.appendChild(txtBtConfirm);
            core.appendChild(btConfirm);
        });
    });
    $(document).on('click', '.confirm-products-button', function () { //en clicar a Confirma
        $('#formupdEsdeveniment').submit();
    });
});