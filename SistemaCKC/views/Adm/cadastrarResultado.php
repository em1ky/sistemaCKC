<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">

    <link rel="icon" href="/sistemackc/views/Img/ImgIcones/crash_icon.ico" type="image/x-icon">

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script defer src="/sistemackc/views/Js/nav.js"></script>
    <script defer src="/sistemackc/views/Js/scriptResultados.js"></script>
    <script defer src="/sistemackc/views/Js/notificacao.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/sistemackc/views/Css/CssUsuario/notificacoes.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/variaveis.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/CssAdm/resultadoExibir.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/CssAdm/cadastrarResultado.css">

    <title>Cadastrar Resultados</title>
</head>

<body>

    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') {
    ?>
        <header class="header">
            <nav class="nav">
                <a class="logo" href="/sistemackc/"><img src="/sistemackc/views/Img/ImgSistema/logoCKC.png" alt="logo do CKC"></a>

                <button class="hamburger"></button>
                <ul class="nav-list">
                    <li><a href="/sistemackc/admtm85/usuario">Usuarios</a></li>
                    <li><a href="/sistemackc/admtm85/campeonato">Campeonatos</a></li>
                    <li><a href="/sistemackc/admtm85/corrida">Corridas</a></li>
                    <li><a href="/sistemackc/admtm85/resultado">Resultados</a></li>
                    <li><a href="/sistemackc/admtm85/kartodromo">Kartodromos</a></li>

                    <li class="drop-down">
                        <?php
                        if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') {
                            echo "<a href='#' class='dropdown-toggle'>Olá, " . $_SESSION['nome'] . "<i class='ph ph-caret-down'></i></a>";
                            echo "<ul class='dropdown-menu'>";
                            echo "<li><a href='/sistemackc/usuario/{$_SESSION['id']}'>Perfil</a></li>";
                            echo "<li><a href='/sistemackc/admtm85/menu'>Menu</a></li>";
                            echo "<li><a href='/sistemackc/logout'>Sair</a></li>";
                            echo "</ul>";
                        } else {
                            echo "<a href='/sistemackc/usuario/login'>Entrar</a>";
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="background-image"></div>
            <h1 class="titulo">Cadastro de Resultado</h1>

            <div class="containerInformacoes">
                <div class="containerImagem">
                    <img class="fundoImg" src="/sistemackc/Views/Img/ImgTelas/fundo.png" alt="fundo da foto do Crash">
                    <img class="imagem" src="/sistemackc/Views/Img/ImgTelas/crash.png" alt="foto do Crash">
                </div>
                <div class="informacoesCorrida">
                    <div class="title">
                        <span><?php echo $dadosCorrida['Nome_Campeonato']; ?></span>
                    </div>
                    <?php $classeH2 = strtolower($nomeAbreviado) . $dadosCorrida['Categoria']; ?>
                    <h2>
                        <strong class="<?php echo $classeH2; ?>"><?php echo strtoupper($nomeAbreviado) ?></strong>
                        <?php echo $dadosCorrida['Nome']; ?>
                    </h2>
                    <div class="date">
                        <span><?php echo date('d/m/Y', strtotime($dadosCorrida['Data_corrida'])); ?></span>
                    </div>
                    <div class="categoria">
                        <span class="categoria <?php echo 'cat' . $dadosCorrida['Categoria']; ?>">
                            <?php
                            if ($dadosCorrida['Categoria'] == "Livre") {
                                echo $dadosCorrida['Categoria'];
                            } else {
                                echo $dadosCorrida['Categoria'] . " kg";
                            }
                            ?>

                        </span>
                    </div>
                </div>
            </div>
            <?php
            if (isset($feedback) && !empty($feedback)) {
                echo "<div class='container-feedback'>";
                if ($classe == 'erro') {
                    echo '
                        <div class="nofifications">
                            <div class="toast alerta">
                                <div class="column">
                                    <i class="ph-fill ph-warning"></i><!--icone de exclamação-->
                                    <span class="' . $classe . '">' . $feedback . '</span>
                                </div>
                                <i class="ph ph-x" onclick="(this.parentElement).remove()"></i><!--iconde de X -->
                            </div>
                        </div>';
                }
                echo "</div>";
            }

            if (isset($usuarios) && $usuarios == []) {
                echo "<p>É necessário ter ao menos 1 usuário cadastrado no sistema, para registrar um resultado</p>";
                echo "<a class='bt-redirecionar' href='/sistemackc/admtm85/usuario/cadastrar'>Cadastrar usuario</a><br>";
            } else {
            ?>

                <section class="container">
                    <form action='' method="POST" id="formResultados">
                        <div id="pilotosContainer">
                            <?php
                            if (isset($dados) && $dados != NULL) {
                                foreach ($dados as $dadosItem) { ?>
                                    <div class="piloto">
                                        <div class="campos">
                                            <label>Posição:</label>
                                            <select id="posicao" name="posicoes[]" required>
                                                <?php
                                                $posicoes = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15");
                                                foreach ($posicoes as $posicao) {
                                                    echo "<option value='$posicao' " . (stripos($dadosItem[0], $posicao) !== false ? 'selected' : '') . ">$posicao º</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="campos">
                                            <label>Piloto:</label>
                                            <select name="pilotos[]" required>
                                                <?php foreach ($usuarios as $usuario) { ?>
                                                    <option value="<?php echo $usuario['id']; ?>" <?php echo $usuario['id'] == $dadosItem[1] ? 'selected' : ''; ?>>
                                                        <?php echo $usuario['nome'] . ' ' . $usuario['sobrenome']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="campos">
                                            <label>Melhor tempo:</label>
                                            <input type="time" name="melhor_tempo[]" value="<?php echo $dadosItem[2]; ?>" placeholder="Melhor Tempo" required>
                                        </div>
                                        <div class="campos">
                                            <label>Pontuação:</label>
                                            <input readonly type="number" name="pontuacao[]" value="<?php echo isset($dadosItem[3]) ? $dadosItem[3] : ''; ?>">
                                        </div>

                                        <div class="excluirRegistro">
                                            <button type="button" class="btn_excluirRegistro">Excluir registro</button>
                                        </div>
                                    </div>
                            <?php
                                }
                            } ?>
                        </div>
                        <div class="botoes">
                            <button type="button" id="addPiloto">Adicionar piloto</button>
                            <button type="submit" id="bt-Cadastrar">Cadastrar</button>

                        </div>
                    </form>
                </section>

                <script>
                    //Passando os dados do array de $usuarios pro JS conseguir popular
                    var usuarios = <?php echo json_encode($usuarios); ?>;
                </script>

            <?php } ?>
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
    <?php } else { ?>
        <div class="containerAcesso">
            <h1>Acesso não autorizado<i class="ph-fill ph-warning"></i></h1>
            <p>Apenas administradores do Sistema tem acesso</p>
        </div>
    <?php } ?>
    
</body>

</html>