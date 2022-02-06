function generaNavbar() {
    //Genera la Barra de Navegació
    const arrNavegador = [['index','Look and Fun'],['modHomeCodi/modCodi','Tenc un Codi'],['modHomeLogin/modLogin','Login']]; //Pot variar, pero no ho guardarem dins un SQL
    const barraMenuNav = document.getElementById('menu');
    let menuNav = document.createElement('NAV');
    menuNav.setAttribute('class','navbar-nav');
    for(let i = 0; i<arrNavegador.length; i++) {
        let linkMenuNav = document.createElement('a');
        linkMenuNav.id = arrNavegador[i][0];
        if(arrNavegador[i][0]==='#') {
            linkMenuNav.setAttribute('class','nav-link enConstruccio');
            linkMenuNav.setAttribute('data-toggle','tooltip');
            linkMenuNav.setAttribute('title','En Construcció!');
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