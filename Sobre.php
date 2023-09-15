<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        include("Componentes/headBasic.html");
    ?>

    <!--CSS Local-->
    <link rel="stylesheet" href="../css/styleSobre.css">
    <link rel="stylesheet" href="../css/setup.css">
    <link rel="shortcut icon" href="../img/EspiritoSanto Azul.svg" type="image/x-icon">
    <title>ISFN - Sobre</title>
</head>

<body>
    <!--MENU -->
    <header>
        <div class="container-fluid" id="menu">
            <div class="row align-items-center" id="row-menu">
                <div class="col-4" id="logo"><!--Logo -->
                    <img class="img-logo-normal" src="../img/img-logo/LOGO-BRANCO-PNG.png" />
                    <img class="img-logo-mini" src="../img/img-logo/EspiritoSanto branco.png" />
                </div>

                <!--Navbar -->
                <div class="col-4" id="navbar">
                    <nav>
                        <ul>
                            <li><a href="../index.html">Home</a></li>
                            <li><a href="#article-sobre">Sobre nós </a></li>
                            <li><a href="#">Equipe</a></li>
                            <li><a href="#">Projetos</a></li>
                        </ul>
                    </nav>
                </div>

                <nav class="col-4" id="social">

                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-whatsapp"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>

                </nav>
                <div class="col-8 hamburguer" id="hamburguer">
                    <i onclick="animarMenu()" class="bi bi-list" id="icone"></i>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="menu-mobile">
            <div class="row">
                <div class="col-12" id="navbar-mobile">
                    <nav>
                        <ul>

                            <li><i onclick="animarMenu()" class="bi bi-x-circle-fill" id="icone2"></i></li>
                            <li><a href="../index.html">HOME</a></li>
                            <li><a href="Sobre.html">SOBRE NÓS</a></li>
                            <li><a href="#">EQUIPE</a></li>
                            <li><a href="#">PROJETOS</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </header>

    <main class="container-fluid">
        <article class="container" id="SaoFelipe">
            <aside class="row">
                <div class="col-12 col-md-6">
                    <img class="img-fluid rounded" src="../img/FILIPE4.png" alt="Imagem de Sao Felipe Neri">
                </div>
                <div class="col-12 col-md-6 col-txt">
                    <h1 class="center">São Felipe Nerí</h1>
                    <h3>“Pippo bono”</h3>
                    <p>
                        Pertencente a uma família rica, filho de tabelião, o santo, nascido em 1515 em Florença, Itália,
                        ficou órfão de mãe muito cedo, e ainda pequeno já mereceu o nome de “Filipe bom”, por conta de
                        seu
                        proceder bondoso, alegre e leal.
                    </p>
                    <h3>Negócios e estudos</h3>
                    <p>
                        Aos 18 anos, recebeu um convite de seu tio para que se dedicasse aos negócios em São Germano.
                        Filipe, no entanto, não se adaptou. Atraído por Deus, foi se dedicar aos estudos em Roma.
                        Estudou
                        Filosofia e Teologia, deixando-se conduzir e formar pelo Espírito Santo.
                    </p>
                    <button class="btn btn-primary" id="LerMais" href="">Ler Mais</button>
                </div>
            </aside>
            <aside class="row" id="Mais">
                <div class="col-12">
                    <h3>O apóstolo de Roma</h3>
                    <p>
                        Néri, mesmo antes de ser padre, visitava os lugares mais pobres de Roma, os hospitais mais
                        abandonados e as mais terríveis prisões, levando uma pregação alegre, espontânea e viva,
                        juntamente com uma amável caridade cristã que o fez ser conhecido e simpático a toda cidade,
                        sendo então chamado: o apóstolo de Roma.
                    </p>
                    <h3>Dedicação aos jovens</h3>
                    <p>
                        “Contanto que não façam pecados, de boa vontade suportarei que rachem lenha em cima das minhas
                        costas”, dizia Filipe aos jovens, os quais ele instruía e educava. Dedicava-se a eles com tal
                        amor, que não se perturbava com as reclamações e injúrias recebidas por causa deles.
                    </p>
                    <h3>“Oratório do divino amor”</h3>
                    <p>
                        Dizendo sim para a glória de Deus e apaixonado por poesia e música desde a adolescência, iniciou
                        a bela obra do Oratório do Divino Amor, onde reunia jovens e os fazia cantar e rezar. Ali
                        começava o sentido musical da palavra: foi criado o drama lírico com coros e orquestra. A partir
                        daí, Filipe fundou a Congregação do Oratório.
                    </p>
                    <h3>Coração dilatado</h3>
                    <p>
                        Depois de sua páscoa, médicos verificaram que seu coração era dilatado, de tal forma que duas
                        costelas se quebraram para acomodá-lo. A este fato atribui-se o seu grande amor para com Deus e
                        para com os homens
                    </p>
                    <h3>O santo alegre</h3>
                    <p>
                        Homem de oração, penitência e adoração, São Filipe Néri, conhecido pelo seu testemunho alegre,
                        cujo sorriso, disse Papa Francisco, o transformou em um apaixonado anunciador da Palavra de
                        Deus, morreu no dia 26 de maio de 1595, partindo para o céu com 80 anos. Foi beatificado, em
                        maio de 1614, por Papa Paulo V; e canonizado, em março de 1622, por Papa Gregório XV.
                    </p>
                    <button class="btn btn-primary" id="LerMenos" href="">Ler Menos</button>
                </div>
            </aside>
        </article>


        <article class="col-12 col-md-8" id="carrosel-div">
            <h2 class="center">Sobre o projeto</h2>

            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img-carrouseu/carrousel-1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-block  ">
                            <h3><i class="bi bi-mortarboard-fill"></i> Reforço educacional</h3>
                            <p>No projeto será ofertado aulas como de inglês, matemática, eletrônica, programação.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../img-carrouseu/carrousel-reuniao.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-block">
                            <h3><i class="bi bi-bar-chart-fill"></i> Desenvolvimento de valores</h3>
                            <p>Ensino baseado em princípios cristãos para formar líderes éticos e responsáveis</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../img-carrouseu/carrousel-1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-block">
                            <h3><i class="bi bi-person-check"></i> Formação de Profissionais</h3>
                            <p>Intuito em capacitar novos profissionais de róbotica</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </article>

        <article class="container" id="artigo-txt">
            <aside id="EraUmaVez-aside">
                <h3 class="center">Estamos à beira do precipício, mas não precisamos cair</h3>
                <br>
                <p>
                    Era uma vez um país chamado Brasil. Este país estava à beira de um precipício, enfrentando uma série
                    de desafios que pareciam insuperáveis. A pobreza era generalizada, a corrupção era endêmica e a
                    violência estava em alta. Parecia que a sociedade estava em uma espiral descendente, com poucas
                    esperanças de melhoria.
                    <br>
                    No entanto, um grupo de cristãos decidiu que não podia ficar parado e assistir enquanto o país
                    afundava cada vez mais. Eles começaram um projeto simples, mas ambicioso. O projeto era baseado em
                    duas ideias fundamentais: atitudes concretas e formação cristã.
                    <br>
                    A formação cristã era um elemento chave do projeto. Os líderes do projeto acreditavam que a fé
                    cristã oferecia uma base sólida para valores e práticas que eram fundamentais para a transformação
                    da sociedade. Eles ensinaram princípios como amor ao próximo, justiça, perdão, honestidade e
                    compaixão, que eram fundamentais para o sucesso do projeto.
                    <br>
                    Ao longo do tempo, o projeto começou a produzir resultados impressionantes e o projeto foi replicado
                    em outras regiões, com resultados positivos em cada local.
                    <br>
                    O projeto simples iniciado por um grupo de cristãos se tornou um exemplo de como atitudes concretas
                    e a formação cristã podem transformar a sociedade.
                </p>
            </aside>
        </article>


    </main>



    <?php
    include("Componentes/footer.html");
    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="../js/javascript.js"></script>
</body>

</html>