<!--------------------------------MENU------------------------------------->
<div class="container-fluid" id="menu">
    <div class="row align-items-center" id="row-menu">


        <!--Navbar -->
        <div class="col-4" id="navbar">
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

        <nav class="col-4" id="social">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me//5562992862544" target="_blank"><i class="bi bi-whatsapp"></i></a>
            <a href="https://www.instagram.com/isfilipeneri/" target="_blank"><i class="bi bi-instagram"></i></a>
            
            <div class="dropdown">
                <a class=" " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#333" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                    </svg>
                </a>
              
                <ul class="dropdown-menu">
                    <?php 
                        if(!isset($_SESSION['login'])){
                            //nao esta logado
                            echo '
                            <li><a class="dropdown-item" href="login.php">Entrar</a></li>
                            <li><a class="dropdown-item" href="../formularioDoador.php">Cadastre-se</a></li>
                            ';
                            
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 1){
                            //esta logado nivel baixo
                            echo '
                            <li><a class="dropdown-item" href="transparencia.php">Transparência</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 2){
                            //esta logado nivel baixo
                            echo '
                            <li><a class="dropdown-item" href="transparencia.php">Transparência</a></li>
                            <li><a class="dropdown-item" href="Doadores.php">Lista de Doadores</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 7){
                            //esta logado nivel 7 
                            echo '
                            <li><a class="dropdown-item" href="transparencia.php">Transparência</a></li>
                            <li><a class="dropdown-item" href="cadastroExtrato.php">Cadastrar Extrato</a></li>
                            <li><a class="dropdown-item" href="../formularioDoador.php">Cadastrar Doador</a></li>
                            <li><a class="dropdown-item" href="admDoadores.php">Lista de Doadores ADM</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger text-center" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';

                        }
                    ?>
                                    
                </ul>
            </div>

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
                            //esta logado nivel baixo
                            echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="text-danger" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 2){
                            //esta logado nivel baixo
                            echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><a href="admDoadores.php">Lista de Doadores</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="text-danger" href="process/sair.php"><i class="bi bi-power text-danger"></i> Sair</a></li>
                            ';
                        }else if(isset($_SESSION['login']) && $_SESSION['nivel'] == 7){
                            //esta logado nivel 7
                            echo '
                            <li><a href="transparencia.php">Transparência</a></li>
                            <li><a href="cadastroExtrato.php">Cadastrar Extrato</a></li>
                            <li><a href="../formularioDoador.php">Cadastrar Doador</a></li>
                            <li><a href="admDoadores.php">Lista de Doadores ADM</a></li>
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