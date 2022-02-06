function generaNavbar(usuari) {
    //Genera la Barra de Navegació
    //Tendriem 3 arrays i s'activaria un segons la $session?! o mes aviat vendrien de JSON per a Seguretat dels admins!!!!!!!!!
    //tria l'usuari
    let arrNavegador = new Array();
    if(usuari == 'administrador') {
        arrNavegador = [['#','Look and Fun'],['index','Taules Mestres'],['#','Perfil'],['../../index','Logout']];
    }
    else if (usuari=='organitzador') {
        arrNavegador = [['#','Look and Fun'],['index','Gestor Events'],['../modPerfilOrganitzadors/modPerfilOrganitzadors','Perfil'],['../../index','Logout']];
    }
    else {
        arrNavegador = [['#','Look and Fun'],['index','Gestor Events'],['#','Perfil'],['../../index','Logout']];
    }

    const barraMenuNav = document.getElementById('menu');
    let menuNav = document.createElement('NAV');
    menuNav.setAttribute('class','navbar-nav');
    for(let i = 0; i<arrNavegador.length; i++) {
        let linkMenuNav = document.createElement('a');
        linkMenuNav.id = arrNavegador[i][0];
        if(arrNavegador[i][0]==='#') {
            linkMenuNav.setAttribute('class','nav-link enConstruccio');
            linkMenuNav.setAttribute('data-toggle','tooltip');
            linkMenuNav.setAttribute('title','No tenc $session si tornes a inici o te moc de puesto perdries el login!');
            linkMenuNav.setAttribute('disabled','');
        }
        else {
            linkMenuNav.setAttribute('class','nav-link');
            linkMenuNav.setAttribute('href',arrNavegador[i][0]+'.html');
        }
        let txtLinkMenuNav = document.createTextNode(arrNavegador[i][1]);
        linkMenuNav.append(txtLinkMenuNav);
        menuNav.appendChild(linkMenuNav);
    }barraMenuNav.appendChild(menuNav);
    //Prepara el Link Actiu
    const pathModul = window.location.pathname;
    let nomModul = pathModul.substring(pathModul.lastIndexOf('/') + 1);
    nomModul = nomModul.substring(0, nomModul.indexOf('.'));
    const linkActiu = document.getElementById(nomModul);
    linkActiu.classList.add('active');
};