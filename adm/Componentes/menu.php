<!--------------------------------MENU------------------------------------->
<div class="container-fluid" id="menu">
    <div class="row align-items-center" id="row-menu">


        <!--Navbar -->
        <div class="col-4 navbar ps-5" id="navbar">
            <nav>
                <ul>
                    <li><a href="#">O Instituto</a></li>
                    <li><a href="#">Equipe</a></li>
                    <li><a href="#">Projetos</a></li>
                    <li><a href="../Doacoes.php">Doações</a></li>
                </ul>
            </nav>
        </div>

        <div class="col-7 col-md-4" id="logo"><!--Logo -->
            <a href="../index.php">
                <img class="img-logo-normal" src="img/img-logo/LOGO-AZUL-PNG.png" />
                <img class="img-logo-mini" src="img/img-logo/EspiritoSantoAzul.png" />
            </a>
        </div>

        <nav class="col-4 navbar adm-links pe-5">
            <ul class="d-flex align-items-center">
                <?php 

                    if(!isset($_SESSION['login'])){
                        //nao esta logado
                        echo '
                        <li><a class="" href="login.php">Entrar</a></li>
                        <li><a class="" href="../formularioDoador.php">Cadastre-se</a></li>
                        ';
                        
                    }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 1){
                        //esta logado nivel 1
                        echo '
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                '. $_SESSION['nome'] .'
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            </ul>
                        </div>
                                         
                        <li><a class="" href="transparencia.php">Transparência</a></li>
                        ';
                    }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 2){
                        //esta logado nivel 2
                        echo '
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                '. $_SESSION['nome'] .'
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            </ul>
                        </div>
                                         
                        <li><a class="" href="transparencia.php">Transparência</a></li>
                        ';
                    }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 7){
                        //esta logado nivel 7 
                        echo '
                         <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                '. $_SESSION['nome'] .'
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../formularioDoador.php">Cadastrar Doador</a></li>
                                <li><a class="dropdown-item" href="cadastroExtrato.php">Cadastrar Extrato</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            </ul>
                        </div>

                        <li><a class="" href="transparencia.php">Transparência</a></li>   
                        <li><a class="" href="admDoadores.php">Doadores</a></li>
                        ';
                    }
                ?>
                                
            </ul>

        </nav>

        <div class="col-3 hamburguer" id="hamburguer">
            <i onclick="animarMenu()" class="bi bi-list" id="icone"></i>
        </div>
    </div>
</div>

<div class="container-fluid" id="menu-mobile">
    <div class="row">
        <div class="col-12" id="navbar-mobile">
            <nav>
                <ul>
                    <li><i onclick="fecharMenu()" class="bi bi-x-circle-fill" id="icone2"></i></li>
                    <li><a href="../index.php">Inicio</a></li>
                    <!--
                    <li><a href="#">O Instituto</a></li>
                    <li><a href="#">EQUIPE</a></li>
                    <li><a href="#">PROJETOS</a></li>
                    -->
                    <li><a href="../Doacoes.php">Doações</a></li>

                    <?php 

                        if(!isset($_SESSION['login'])){
                            //nao esta logado
                            echo '
                            <li><a href="login.php">Entrar</a></li>
                            <li><a href="../formularioDoador.php">Cadastre-se</a></li>
                            ';
                            
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 1){
                            //esta logado nivel 1
                            echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="text-danger" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 2){
                           //esta logado nivel 2
                           echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="text-danger" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                       }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 7){
                            //esta logado nivel 7
                            echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><a href="cadastroExtrato.php">Cadastrar Extrato</a></li>
                            <li><a href="../formularioDoador.php">Cadastrar Doador</a></li>
                            <li><a href="admDoadores.php">Lista de Doadores</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="text-danger" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }
                            
                    ?>

                    <nav class="d-flex mt-5" id="">
                        <a class="col-4 text-center" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="col-4 text-center" href="https://wa.me//5562992862544" target="_blank"><i class="bi bi-whatsapp"></i></a>
                        <a class="col-4 text-center" href="https://www.instagram.com/isfilipeneri/" target="_blank"><i class="bi bi-instagram"></i></a>
                    </nav>
                </ul>
            </nav>
        </div>
    </div>
</div>