<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!--Fonte-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    
    <title>ISFN | Retiro </title>

    <link rel="stylesheet" href="retiro/Section.css">
    <link rel="stylesheet" href="retiro/Section2.css">
    <link rel="shortcut icon" href="./favicon.svg" type="image/x-icon">
</head>

<div class="container-fluid d-flex Section" id="Section">
  <div class="row align-items-center">
    <div class="col-6 col-md-5 ColunaA">
      <h1>Peta Sabor Pimenta</h1>
        <p>
        O Biscoito Forno de Goiás sabor Pimenta é feito com os melhores ingredientes conservando o sabor, leveza e a crocância apimentada.
        Uma ótima opção para petiscos e entradas.
        Disponível na embalagem de 100g.        
        </p>
      

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
        id="bt-abrirPopup">
        Tabela Nutricional
      </button><!--abtir popup-->


      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title center" id="exampleModalLongTitle">
                Peta Sabor Pimenta
              </h5><!--titulo do poppup-->

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>

              </button><!--CLOSE X-->
            </div><!--HEADER-->

            <div class="modal-body"><img class="img-fluid w-100" src="./Imagens/Tabelas/TabelaPimenta.svg" alt=""></div>
            <!--<div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        id="BTNclose"
                      >
                        Close
                      </button>
                      <button type="button" class="btn btn-primary">
                        Save changes
                      </button>
                    </div>-->
          </div><!--Container MODAL-->
        </div><!--diálogo centralizado. Corpo do MODAL-->
      </div><!-- MODAL -->

    </div>

    <div class="col-6 col-md-7 ColunaB end">
      <img class="img-hero" src="./Imagens/Produtos/PetaPimenta.webp" alt="biscoito de pimenta" />
    </div>
  </div>
</div>

