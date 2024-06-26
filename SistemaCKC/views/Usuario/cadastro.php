<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- ícone de menu  -->

    <script defer src="/sistemackc/views/Js/notificacao.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/sistemackc/views/Css/CssUsuario/notificacoes.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/variaveis.css">
    <link rel="stylesheet" href="/sistemackc/views/Css/CssUsuario/cadastro.css">

    <link rel="icon" href="/sistemackc/views/Img/ImgIcones/crash_icon.ico" type="image/x-icon">

    <script src="https://unpkg.com/@phosphor-icons/web"></script> <!-- ONDE PEGUEI OS ICON TEMPORARIOS 'phosphor-icons' -->
    <script defer src="/sistemackc/views/Js/nav.js"></script> <!-- O atributo "defer" serve para que o script roda depois do html -->
    <!-- <script src="/sistemackc/views/Js/validarcpf.js"></script>-->
    <script src="/sistemackc/views/Js/validarCpfSenhaEmail.js"></script>


    <title>Cadastro</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <header class="header">
        <nav class="nav">
            <a class="logo" href="/sistemackc/"><img src="/sistemackc/views/Img/ImgSistema/logoCKC.png" alt="logo do CKC"></a>

            <button class="hamburger"></button>
            <ul class="nav-list">
                <?php
                if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Comum' || !isset($_SESSION['tipo'])) {
                    echo "<li><a href='/sistemackc/historia'>História</a></li>";
                ?>
                    <li class="drop-down">
                        <a href="#" class="dropdown-toggle">Corridas<i class="ph ph-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="/sistemackc/etapas">Etapas</a></li>
                            <li><a href="/sistemackc/">Classificação</a></li>
                            <li><a href="/sistemackc/kartodromo">Kartódromos</a></li>
                        </ul>
                    </li>
                <?php } elseif (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') {
                    echo "<li><a href='/sistemackc/admtm85/usuario'>Usuarios</a></li>";
                    echo "<li><a href='/sistemackc/admtm85/campeonato'>Campeonatos</a></li>";
                    echo "<li><a href='/sistemackc/admtm85/corrida'>Corridas</a></li>";
                    echo "<li><a href='/sistemackc/admtm85/kartodromo'>Kartodromos</a></li>";
                    echo "<li><a href='/sistemackc/admtm85/resultado'>Resultados</a></li>";
                } ?>

                <?php
                if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Comum') { ?>
                    <li class="drop-down">
                        <?php echo "<a href='#' class='dropdown-toggle'>Olá, " . $_SESSION['nome'] . "<i class='ph ph-caret-down'></i></a>"; ?>
                        <ul class="dropdown-menu">
                            <?php echo "<li><a href='/sistemackc/usuario/{$_SESSION['id']}'>Perfil</a></li>"; ?>
                            <?php echo "<li><a href='/sistemackc/logout'>Sair</a></li>"; ?>
                        </ul>
                    </li>
                <?php } elseif (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') { ?>
                    <li class='drop-down'>
                        <?php echo "<a href='#' class='dropdown-toggle'>Olá, " . $_SESSION['nome'] . "<i class='ph ph-caret-down'></i></a>"; ?>
                        <ul class='dropdown-menu'>
                            <?php echo "<li><a href='/sistemackc/usuario/{$_SESSION['id']}'>Perfil</a></li>"; ?>
                            <li><a href='/sistemackc/admtm85/menu'>Menu</a></li>
                            <li><a href='/sistemackc/logout'>Sair</a></li>
                        </ul>
                    </li>
                <?php } else {
                    echo "<a href='/sistemackc/usuario/login'>Entrar</a>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <div class="background-image"></div>
        <div id="bt-go-back">
            <a href="/sistemackc/"><i class="ph ph-caret-left"></i></a>
        </div>
        <section class="container">
            <div class="titulo">
                <h1>Cadastro</h1>
            </div>

            <?php
            if (isset($feedback) && $feedback != '') {
                echo "<div class='container-feedback'>";
                if (isset($classe) && $classe == 'erro') {
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
                } else {
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
            ?>


            <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') {
                echo "<form action='/sistemackc/admtm85/usuario/cadastrar' class='form' method='POST'>";
            } else {
                echo "<form action='/sistemackc/usuario/cadastro' class='form' method='POST'>";
            } ?>

            <div class="div_container">
                <div class="campo">
                    <label class="nome" for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo isset($dados[0]) ? $dados[0] : ''; ?>" required>
                </div>

                <div class="campo">
                    <label class="sobrenome" for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" value="<?php echo isset($dados[1]) ? $dados[1] : ''; ?>" required>
                </div>

                <div class="campo">
                    <label class="dataNascimento" for="dataNascimento">Data de Nascimento:</label>
                    <input type="date" name="dataNascimento" value="<?php echo isset($dados[2]) ? $dados[2] : ''; ?>" required>
                </div>

                <div class="genero">
                    <label class="escolha" for="genero">Gênero:</label>
                    <input type="radio" value="Masculino" name="genero" <?php echo isset($dados[9]) && $dados[9] == 'Masculino' ? 'checked' : ''; ?>>
                    <label class="homem" for="homem">Masculino</label>

                    <input type="radio" value="Feminino" name="genero" <?php echo isset($dados[9]) && $dados[9] == 'Feminino' ? 'checked' : ''; ?>>
                    <label class="mulher" for="mulher">Feminino</label>

                    <input type="radio" value="Outro" name="genero" <?php echo isset($dados[9]) && $dados[9] == 'Outro' ? 'checked' : ''; ?>>
                    <label class="outro" for="outro">Outro</label>
                </div>

                <div class="campo">
                    <label class="cpf" for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" value="<?php echo isset($dados[3]) ? $dados[3] : ''; ?>" required>
                    <span id="cpfError" style="color: red;"></span>
                </div>

                <div class="campo">
                    <label class="telefone" for="telefone">Celular:</label>
                    <input type="text" name="telefone" value="<?php echo isset($dados[10]) ? $dados[10] : ''; ?>" required>
                </div>

                <div class="campo">
                    <label class="email" for="email">E-mail:</label>
                    <input type="text" name="email" id="email" value="<?php echo isset($dados[4]) ? htmlspecialchars($dados[4]) : ''; ?>" required>
                </div>

                <div class="campo">
                    <label class="email" for="confirmarEmail">Confirmação de E-mail:</label>
                    <input type="text" name="confirmarEmail" id="confirmarEmail" value="<?php echo isset($dados[5]) ? htmlspecialchars($dados[5]) : ''; ?>" required>
                    <span id="emailError" style="color: red;" class="error"></span>
                </div>

                <div class="campo">
                    <label class="senha" for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" value="<?php echo isset($dados[6]) ? htmlspecialchars($dados[6]) : ''; ?>" required>
                </div>

                <div class="campo">
                    <label class="senha" for="confirmarSenha">Confirmação de Senha:</label>
                    <input type="password" name="confirmarSenha" id="confirmarSenha" value="<?php echo isset($dados[7]) ? htmlspecialchars($dados[7]) : ''; ?>" required>
                    <span id="senhaError" style="color: red;" class="error"></span>
                </div>

                <div class="campo">
                    <label class="peso" for="peso">Peso:</label>
                    <input type="number" name="peso" value="<?php echo isset($dados[8]) ? $dados[8] : ''; ?>" required>
                </div>

                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'Administrador') : ?>
                    <div class="campo">
                        <label class="peso" for="peso">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="Comum" <?php echo isset($dados[12]) && $dados[12] == 'Comum' ? 'selected' : ''; ?>>Comum</option>
                            <option value="Administrador" <?php echo isset($dados[12]) && $dados[12] == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                    </div>
                <?php endif; ?>
            </div>

            <div class="button-container">
                <button type="submit" class="bt-cadastrar" <?php echo isset($dados[13]) ? $dados[13] : 'disabled' ?>>Cadastrar</button>
            </div>

            </form>
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