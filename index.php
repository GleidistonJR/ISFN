<!DOCTYPE html>
<html lang="pt-br">

<head>
    
    <?php
    include("Componentes/headBasic.html");
    ?>

    <title>Instituto São Filipe Neris</title>
</head>

<body>
    <?php
    include("Componentes/menu.html");
    include("css/includesCss.html");
    ?>


    <!--Banner-->
    <article class="container-fluid sec-banner">
        <aside class="row align-middle">
            <div class="col-4 headiline">
                <h1 class="titulo">
                    A fé <span style="color: var(--azulPrincipal)">cristã</span>
                    e a tecologia em uma experiência <span style="color: var(--azulPrincipal);">transformadora</span>
                </h1>
                <h2 class="descricao">
                    Capacitando Crianças e Adolescentes de Baixa Renda em
                    Eletrônica, Programação, Robótica e IoT
                </h2>
            </div>
        </aside>
    </article>


    <!--Artigo Sobre o Projeto-->
    <article class="container-fluid" id="article-sobre">
        <h2>Sobre o Projeto</h2>
        <h3>O projeto será de cunho educativo, voltado a crianças e adolescentes de baixa renda, o projeto tem como
            objetivo:</h3>
        <aside class="row align-items-center">
            <div class="coluna">
                <i class="bi bi-mortarboard-fill"></i>
                <h4>Reforço educacional</h4>
                <p>No projeto será ofertado aulas como de inglês, matemática, eletrônica, programação</p>
            </div>
            <div class="coluna">
                <i class="bi bi-bar-chart-fill"></i>
                <h4>Desenvolvimento de valores</h4>
                <p>Ensino baseado em princípios cristãos para formar líderes éticos e responsáveis</p>
            </div>
            <div class="coluna">
                <i class="bi bi-person-check"></i>
                <h4>Formação de Profissionais</h4>
                <p>Intuito em capacitar novos profissionais de róbotica</p>
            </div>
        </aside>
    </article>

    <!--Como funciona-->
    <article class="container-fluid" id="article-como-funciona">
        <div class="row align-items-center" id="article-como-funciona">
            <aside class="col-12 col-lg-6" id="aside-txt-como-funciona">
                <h2>Como Funciona</h2>
                <p><i class="bi bi-mortarboard-fill"></i><strong>Formação Técnica:</strong> Aulas teóricas e
                    práticas em eletrônica, programação, robótica
                    e IoT</p>
                <p><i class="bi bi-bar-chart-fill"></i><strong>Desenvolvimento de Valores:</strong> Ensino baseado
                    em princípios cristãos para formar
                    líderes
                    éticos e responsáveis.</p>
            </aside>
            <aside class="img col-12 col-lg-6" id="aside-img-como-funciona">
                <!--img-->
            </aside>
        </div>
    </article>

    <!--Depoimentos-->
    <article class="container align-items-center center" id="depoimentos">
        <h2><i class="bi bi-quote"></i>Depoimentos</h2>
        <div class="row" id="depoimentos-div">
            <aside class="col-12 col-md-3">
                <div class="img-div">
                    <img class="img-fluid " src="img/depoimento-12.webp" alt="foto">
                </div>
                <h4>Eduardo</h4>

                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae ducimus impedit blanditiis
                    non vel eum fugit nulla! </p>
            </aside>
            <aside class="col-12 col-md-3">
                <div class="img-div">
                    <img class="img-fluid " src="img/depoimento-2.webp" alt="">
                </div>
                <h4>Gabriel</h4>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae ducimus impedit blanditiis
                    non vel eum fugit nulla! </p>
            </aside>
            <aside class="col-12 col-md-3">
                <div class="img-div">
                    <img class="img-fluid " src="img/depoimento-3.webp" alt="">
                </div>
                <h4>Julia</h4>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae ducimus impedit blanditiis
                    non vel eum fugit nulla!</p>
            </aside>
        </div>
    </article>

    <?php
    include("Componentes/footer.html");
    ?>



    <script src="js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

</body>