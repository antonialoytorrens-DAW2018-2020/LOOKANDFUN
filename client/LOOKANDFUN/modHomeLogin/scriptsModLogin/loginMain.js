window.onload = function(){
    const formLogin = document.getElementById('temporal');
    formLogin.addEventListener('submit', function(e) {
        e.preventDefault();
        const valorUsuari = document.getElementById('inputTextUsuari').value;
        const valorPassword = document.getElementById('inputPasswordPassword').value;
        if(valorUsuari==='usuari') {
            window.location.href = 'modLoginUsuaris/index.html';
        }
        else if (valorUsuari==='organitzador') {
            window.location.href = 'organitzadorsBackend/index.html';
        }
        else if (valorUsuari==='administrador') {
            window.location.href = 'modLoginAdministradors/index.html';
        }
        else {
            alert('usuari Incorrecte, torna-ho a provar!');
        }
    });

};