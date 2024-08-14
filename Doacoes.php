<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    include("Componentes/headBasic.html");
    ?>
    <link rel="stylesheet" href="css/styleDonate.css?6">

    <title>ISFN | Doações</title>

</head>



<body>
    <div class="pg-doacao">
        <?php
        include("Componentes/menu.html");
        ?>
    </div>




    <section class="doacao container-fluid">
        <article class="row banner">
            <aside class="col col-12 col-md-5">
                <h1>Com o seu apoio, formaremos líderes com <mark>valores inegociáveis</mark></h1>
                <p>Juntos vamos proporcionar, a cada criança e adolescente que alcançarmos, um aprendizado de valores cristãos e pensamentos lógicos</p>
                <a href="#row-doacao">Faça sua contribuição</a>
            </aside>

        </article>

        <article class="row row-doacao" id="row-doacao">
            <h2>Faça sua doação</h2>
            <aside class="col col-12">
                <div class="col-11 col-md-5">
                    <h3>Selecione o valor da sua contribuição:</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            R$50
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            R$100
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            R$200
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                        <label class="form-check-label" for="flexRadioDefault5">
                            R$500
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
                        <label class="form-check-label" for="flexRadioDefault4">
                            Outro Valor
                        </label>
                    </div>
                </div>

                <div class="col-11 col-md-5 qrcode">
                    <h4>Seja a mão que auxilia a formação de novos líderes</h4>

                    <img id="img_qrcode" src="./img/img-doacoes/QR/outro.png" alt="QrCode pix">

                    <div class="div-copiar">
                        <p>PIX COPIA/COLA</p>
                        <input type="text" name="url-txt" id="url_txt" value="00020126360014BR.GOV.BCB.PIX0114511773660001715204000053039865802BR5904ISFN6007Goiania62070503***63048F56">
                        <button id="btn_copiar"> Copiar</button>
                    </div>

                    <p>51.177.366/0001-71</p>
                    <p>PIX CNPJ INSTITUTO SÃO FILIPE NÉRI</p>
                </div>
            </aside>

        </article>

    </section>

    <a class="btn btn-padrinho" href="formularioDoador.php">Seja um colaborador mensal</a>




    <?php

    include("Componentes/footer.html");

    ?>


</body>

<script>
    const radio50 = document.querySelector('#flexRadioDefault1')
    const radio100 = document.querySelector('#flexRadioDefault2')
    const radio200 = document.querySelector('#flexRadioDefault3')
    const radio500 = document.querySelector('#flexRadioDefault5')
    const radio_outro = document.querySelector('#flexRadioDefault4')
    const img_qrcode = document.querySelector('#img_qrcode')
    const btn_copiar = document.querySelector('#btn_copiar')


    radio50.addEventListener("click", function() {
        img_qrcode.setAttribute("src", "./img/img-doacoes/QR/50.png")
        url_txt.setAttribute("value", "00020126360014BR.GOV.BCB.PIX011451177366000171520400005303986540550.005802BR5904ISFN6007Goiania62070503***6304FE0B")
    })
    radio100.addEventListener("click", function() {
        img_qrcode.setAttribute("src", "./img/img-doacoes/QR/100.png")
        url_txt.setAttribute("value", "00020126360014BR.GOV.BCB.PIX0114511773660001715204000053039865406100.005802BR5904ISFN6007Goiania62070503***6304A866")
    })
    radio200.addEventListener("click", function() {
        img_qrcode.setAttribute("src", "./img/img-doacoes/QR/200.png")
        url_txt.setAttribute("value", "00020126360014BR.GOV.BCB.PIX0114511773660001715204000053039865406200.005802BR5904ISFN6007Goiania62070503***6304414C")
    })
    radio500.addEventListener("click", function() {
        img_qrcode.setAttribute("src", "./img/img-doacoes/QR/500.png")
        url_txt.setAttribute("value", "00020126360014BR.GOV.BCB.PIX0114511773660001715204000053039865406500.005802BR5904ISFN6007Goiania62070503***63042BC0")
    })
    radio_outro.addEventListener("click", function() {
        img_qrcode.setAttribute("src", "./img/img-doacoes/QR/outro.png")
        url_txt.setAttribute("value", "00020126360014BR.GOV.BCB.PIX0114511773660001715204000053039865802BR5904ISFN6007Goiania62070503***63048F56")
    })

    btn_copiar.addEventListener("click", function() {
        let textoCopiado = document.getElementById("url_txt");
        textoCopiado.select();
        textoCopiado.setSelectionRange(0, 999);

        document.execCommand("copy")
        alert('Copiado')
    })
</script>

</html>