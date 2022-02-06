function generaNavbar() {
    //Genera la Barra de Navegació
    const arrNavegador = [['index', 'Administració'], ['esdeveniments', 'Administració Esdeveniments'], ['entrades', 'Administració Entrades']]; //Pot variar, pero no ho guardarem dins un SQL
    const barraMenuNav = document.getElementById('menu');
    let menuNav = document.createElement('NAV');
    menuNav.setAttribute('class', 'navbar-nav');
    for (let i = 0; i < arrNavegador.length; i++) {
        let linkMenuNav = document.createElement('a');
        linkMenuNav.id = arrNavegador[i][0];
        if (arrNavegador[i][0] === '#') {
            linkMenuNav.setAttribute('class', 'nav-link enConstruccio');
            linkMenuNav.setAttribute('data-toggle', 'tooltip');
            linkMenuNav.setAttribute('title', 'En Construcció!');
            linkMenuNav.setAttribute('disabled', '');
        }
        else {
            linkMenuNav.setAttribute('class', 'nav-link');
            linkMenuNav.setAttribute('href', arrNavegador[i][0] + '.php');
        }
        let txtLinkMenuNav = document.createTextNode(arrNavegador[i][1]);
        linkMenuNav.append(txtLinkMenuNav);
        menuNav.appendChild(linkMenuNav);
    } barraMenuNav.appendChild(menuNav);
    //Prepara el Link Actiu
    const pathModul = window.location.pathname;
    let nomModul = pathModul.substring(pathModul.lastIndexOf('/') + 1);
    nomModul = nomModul.substring(0, nomModul.indexOf('.'));
    const linkActiu = document.getElementById(nomModul);
    // EL LINKACTIU POT SER NULL JA QUE POT ESTAR AL FOOTER
    if (linkActiu != null) {
        linkActiu.classList.add('active');
    }
};

// JQUERY
/*function generaNavbar() {
    //Genera la Barra de Navegació
    const arrNavegador = [['index', 'Administració'], ['esdeveniments', 'Administració Esdeveniments'], ['entrades', 'Administració Entrades']]; //Pot variar, pero no ho guardarem dins un SQL
    let menuNav = $('<nav class="navbar-nav"></nav>');
    for (let i = 0; i < arrNavegador.length; i++) {
        let linkMenuNav = $('<a></a>');
        linkMenuNav.id = arrNavegador[i][0];
        if (arrNavegador[i][0] === '#') {
            $(linkMenuNav).attr({
                "class": "nav-link enConstruccio",
                "data-toggle": "tooltip",
                "title": "En Construcció!",
                "disabled": ""
            });
        }
        else {
            $(linkMenuNav).attr({
                "class": "nav-link",
                "href": arrNavegador[i][0] + '.php'
            });
        }
        let txtLinkMenuNav = $('selector').append(document.createTextNode(arrNavegador[i][1]))
        $(linkMenuNav).append(txtLinkMenuNav);
        $(menuNav).append(linkMenuNav);
    } $('#menu').append(menuNav);
    var altres = $('<div class="dropdown-menu" aria-labelledby="navbarDropdown"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><div class="dropdown-divider"></div><a class="dropdown-item" href="#">Something else here</a></div>');
    $('#menu').append(altres);
    $(document.body).append(menuNav);
    //Prepara el Link Actiu
    const pathModul = window.location.pathname;
    let nomModul = pathModul.substring(pathModul.lastIndexOf('/') + 1);
    nomModul = nomModul.substring(0, nomModul.indexOf('.'));
    const linkActiu = document.getElementById(nomModul);
    // EL LINKACTIU POT SER NULL JA QUE POT ESTAR AL FOOTER
    if (linkActiu != null) {
        linkActiu.classList.add('active');
    }
};*/