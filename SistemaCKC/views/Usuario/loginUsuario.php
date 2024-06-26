<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@phosphor-icons/web"></script> <!-- ONDE PEGUEI OS ICON TEMPORARIOS 'phosphor-icons' -->
    <script defer src="/sistemackc/views/Js/nav.js"></script> <!-- O atributo "defer" serve para que o script roda depois do html -->
    <script defer src="/sistemackc/views/Js/notificacao.js"></script>

    <link rel="icon" href="/sistemackc/views/Img/ImgIcones/crash_icon.ico" type="image/x-icon">

    <link rel="stylesheet" href="/sistemackc/views/Css/variaveis.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/CssUsuario/login.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/CssUsuario/notificacoes.css">

    <title>Login</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    } ?>

    <?php
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Comum') : ?>
        <script>
            window.location.href = '/sistemackc/usuario/<?php echo $_SESSION['id']; ?>';
        </script>
    <?php endif ?>

    <header class="header">
        <nav class="nav">
            <a class="logo" href="/sistemackc/"><img src="/sistemackc/views/Img/ImgSistema/logoCKC.png" alt="logo do CKC"></a>

            <button class="hamburger"></button>
            <ul class="nav-list">
                <li><a href="/sistemackc/historia">História</a></li>

                <li class="drop-down">
                    <a href="#" class="dropdown-toggle">Corridas<i class="ph ph-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/sistemackc/etapas">Etapas</a></li>
                        <li><a href="/sistemackc/classificacao">Classificação</a></li>
                        <li><a href="/sistemackc/kartodromo">Kartódromos</a></li>
                    </ul>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Comum') {
                        echo "<p>Olá, " . $_SESSION['nome'] . "</p>";
                        echo "<ul class='drop-corrida'>";
                        echo "<li><a href='/sistemackc/usuario/{$_SESSION['id']}'>Perfil</a></li>";
                        echo "<li><a href='/sistemackc/logout'>Sair</a></li>";
                        echo "</ul>";
                    }
                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') {
                        echo "<p>Olá, " . $_SESSION['nome'] . "</p>";
                        echo "<ul class='drop-corrida'>";
                        echo "<li><a href='/sistemackc/usuario/{$_SESSION['id']}'>Perfil</a></li>";
                        echo "<li><a href='/sistemackc/admtm85/menu'>Menu</a></li>";
                        echo "<li><a href='/sistemackc/logout'>Sair</a></li>";
                        echo "</ul>";
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- botão de voltar -->
        <div id="bt-go-back">
            <a href="/sistemackc/"><i class="ph ph-caret-left"></i></a> <!--tag 'a' com o icone de seta '<' -->
        </div>
        <section class="container">
            <!-- titulo e imagem principal -->
            <div class="subTitleImg">
                <div class="Image-Text">
                    <img src="/sistemackc/views/Img/ImgSistema/WhatsApp_Image.jpeg" alt="piloto do ckc em seu kart">
                </div>
                <h2 class="subTitle">Cadastre-se e faça parte da comunidade CKC Kart</h2>
            </div>

            <?php if (isset($feedback)) : ?>
                <div class="nofifications">
                    <div class="toast alerta">
                        <div class="column">
                            <i class="ph-fill ph-warning"></i><!--icone de exclamação-->
                            <span class="<?php echo $classe ?>"><?php echo $feedback ?></span>
                        </div>
                        <i class="ph ph-x" onclick="(this.parentElement).remove()"></i><!--iconde de X -->
                    </div>
                </div>
            <?php endif ?>
            <!-- formulario -->
            <section class="formulario">
                <form action="login" method="post">
                    <!--caixa de Email -->
                    <div class="emails">
                        <label class="email" for="email">E-mail:</label>
                        <input type="text" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                    </div>
                    <!--caixa de Senha -->
                    <div class="passwords">
                        <label class="password" for="senha">Senha:</label>
                        <input type="password" name="senha">
                        <!-- link de esqueci minha senha-->
                        <a class="esquecerSenha" href="/sistemackc/usuario/solicitar/senha">Esqueci minha senha</a>
                    </div>
                    <!-- botão de entrar -->
                    <button class="bt-go-in">Entrar</button>
                </form>
                <!-- botão de cadastrar -->
                <a href="./cadastro" class="bt-cadastre">Cadastrar</a>
            </section>
        </section>
    </main>
    <footer>
        <!-- ondas -->
        <div class="water">
            <svg class="waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(47, 44, 44, 0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(47, 44, 44, 0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(49, 46, 46, 0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="var(--background-campos)" />
                </g>
            </svg>
        </div>
        <!-- conteudo na nav -->
        <div class="content">
            <div class="copyrights">
                <span class="copyright">© Sistema Gerenciador de corridas de kart. Todos os Direitos Reservados à Manas Code</span>
                <div class="logos">
                    <div class="logSistema">
                        <span class="copySistema">Plataforma</span>
                        <img class="logo logoSistema" src="/sistemackc/Views/Img/ImgSistema/logoSis_Gerenciador_kart.png" alt="logo do Sistema Gerenciador de Corridas de Kart ">
                    </div>
                    <div class="logManas">
                        <span class="copyDevs">Desenvolvedora</span>
                        <img class="logo logoManasC" src="/sistemackc/Views/Img/ImgSistema/logoManasC.png" alt="logo da desenvolvedora do sistema - Manas Code">
                    </div>
                </div>
            </div>

            <div class="navegation">
                <div class="contact">
                    <a href="https://www.instagram.com/crashkartchampionship?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                        <i class="ph-fill ph-instagram-logo"></i><!-- logo instagram-->
                    </a>
                    <a href="https://wa.me/5511984372045" target="_blank">
                        <i class="ph-fill ph-whatsapp-logo"></i><!-- logo whatsapp-->
                    </a>
                </div>
                <div class="navigationLink">
                    <a href="/sistemackc/etapas">Etapas</a>
                    <a href="/sistemackc/classificacao">Classificação</a>
                    <a href="/sistemackc/kartodromo">Kartódromos</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>