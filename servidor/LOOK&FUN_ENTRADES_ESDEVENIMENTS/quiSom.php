<html>
<meta charset="utf-8">

<head>
    <?php include("include/header.php") ?>
    <link rel="stylesheet" href="css/quiSom.css">
</head>

<body>
    <?php include("include/menu.php") ?>
    <?php include("include/body.php") ?>
    <div class="jumbotron text-center">
        <h1><img class="ml-2" src="api/resources/url_img/private/logo.png" /></h1>
        <p>Especialistes en l'organització d'esdeveniments</p>
        <form>
            <div class="input-group">
                <input type="email" class="form-control" size="50" placeholder="Correu electrònic">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger">Suscripció a la newsletter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Container (About Section) -->
    <div id="about" class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h2>SOBRE LA NOSTRA COMPANYIA</h2><br>
                <h4>Look&Fun és una companyia dedicada a l'organització d'esdeveniments. La plantilla en aquests moments està formada per quatre estudiants de Grau Superior de Web del CIFP Pau Casesnoves.</h4><br>
                <h5>Creixement previst del lloc web.</h5><br>
                <p>Actualment la nostra pàgina web està en desenvolupament, així que una mica de contribució o ajuda seria benvinguda.</p>
                <p> Si haguéssim de suposar que tinguéssim èxit amb la nostra empresa hauríem de afegir els següents punts.</p>
                <p>• Afegir un filtre per poder cercar a través de organitzadors de esdeveniments. Per exemple una organització com la de Trui Teatre o la de Es Gremi.</p>
                <p>• Poder guardar els nostres organitzadors de esdeveniments preferits dins el nostre perfil de usuari, per després poder rebre informació a través de la plataforma o a través del correu electrònic, sobre els nous esdeveniments o notícies de aquests.</p>
                <p>• Poder crear esdeveniments privats, on només certs usuaris, convidats pel creador, tinguin accés a ell.</p>
                <p>• Oferir enllaços cap a altres aplicacions, com per exemple, pagar una quota per tenir l’API de GMaps i enllaçar la localització del esdeveniment a través de les seves coordenades, o generar un missatge a través de alguna xarxa social, que un esdeveniment s’ha creat, o que s’ha cancel·lat, etc.
                </p>
                <br><button class="btn btn-secondary btn-lg">Contribueix</button>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-signal logo"></span>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary">
        <div class="row">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-globe logo slideanim"><img width="400" height="400" class="ml-2" src="api/resources/url_img/private/world.png" /></span>
            </div>
            <div class="col-sm-8">
                <h2 class="text-white">ELS NOSTRES VALORS (RSC)</h2><br>
                <h4 class="text-white"><strong>•</strong> Preocupació pel canvi climàtic, sobretot a la generació de residus. Look&Fun es preocupa que al finalitzar els esdeveniments no hi hagi residus, així com també col·locar papereres als esdeveniments creats més multitudinaris.</h4><br>
                <h4 class="text-white"><strong>•</strong> Look&Fun es preocupa que a la celebració dels esdeveniments no hi hagi cap tipus de conflicte ètic, referit a l’ètnia, sexisme, religió, etc.</h4><br>
                <h4 class="text-white"><strong>•</strong> Les aportacions voluntàries que es destinin a la companyia i la meitat de la tresoreria opcional que tenim a partir dels beneficis, es destinaran a la fundació <i>Càritas</i>.</h4><br>
            </div>
        </div>
    </div>

    <!-- Container (Services Section) -->
    <div id="services" class="container-fluid text-center">
        <h2>SERVEIS</h2>
        <h4>Què oferim?</h4>
        <br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-off logo-small"></span>
                <h4>ESDEVENIMENTS</h4>
                <p>Crea esdeveniments de forma fàcil, ràpida i intuïtiva.</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-heart logo-small"></span>
                <h4>ENTRADES</h4>
                <p>Compra entrades per a esdeveniments a partir de la nostra web.</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-lock logo-small"></span>
                <h4>FACILITATS</h4>
                <p>Contacta amb el personal de l'empresa per a descomptes per a residents, discapacitats, famílies nombroses, etc.</p>
            </div>
        </div>
        <br><br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-leaf logo-small"></span>
                <h4>CONTACTE I EFECTIVITAT</h4>
                <p>El personal de l'empresa sempre contesta abans de les 48 hores per a qualsevol tipus de dubte.</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-certificate logo-small"></span>
                <h4>RESPECTE</h4>
                <p>Look&Fun es preocupa per temes ètics com el medi ambient.</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-wrench logo-small"></span>
                <h4 style="color:#303030;">HARD WORK</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
        </div>
    </div>

    <!-- Container (Pricing Section) -->
    <div id="pricing" class="container-fluid bg-primary">
        <div class="text-center">
            <h2 class="text-white">Preus</h2>
            <h4 class="text-white">Tria el servei VIP per gaudir de més avantatges</h4>
        </div>
        <div class="row slideanim">
            <div class="panel panel-default text-left bg-grey" style="margin: auto;">
                <div class="panel-heading text-center">
                    <h1>VIP</h1>
                </div>
                <div class="panel-body ml-4 mt-4 mb-4">
                    <p>• Creació de més de cinc esdeveniments mensuals.</p>
                    <p>• Creació de esdeveniments privats.</p>
                    <p>• Esmentar els esdeveniments a través de les xarxes socials.</p>
                    <p>• Distintiu privilegiat als esdeveniments creats.</p>
                    <p>• Mostrar l’esdeveniment dins la secció dels recomanats.</p>
                    <p>• Possibilitat d’accedir a la API de Google Maps.</p>
                    <p>• Crear l’esdeveniment, juntament amb vídeos i una presentació inicial d’aquest.</p>
                </div>
                <div class="panel-footer text-center mb-4">
                    <h3 class="text-center">5€ al mes</h3>
                    <button class="btn btn-info btn-lg">Inscriu-te</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Container (Contact Section) -->
    <div id="contact" class="container-fluid bg-grey">
        <h2 class="text-center">CONTACTE</h2>
        <div class="row">
            <div class="col-sm-5 pb-3">
                <p>Contestam sempre abans de les 48 hores per a qualsevol tipus de dubte.</p>
                <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
            </div>
        </div>
    </div>
</body>
<?php include("include/footer.php"); ?>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            $(".slideanim").each(function() {
                var pos = $(this).offset().top;
                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    });
</script>
</body>

</html>