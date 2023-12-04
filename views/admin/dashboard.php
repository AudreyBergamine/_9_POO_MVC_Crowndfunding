<?php 
include_once(__DIR__ . "/../../header.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        // Função para limpar todos os formulários na página
        function limparFormularios() {
            var formularios = document.getElementsByTagName('form');

            for (var i = 0; i < formularios.length; i++) {
                formularios[i].reset(); // Limpa cada formulário
            }
        }
    </script>
</head>

<body>
    <center>
        <div class="content">
            <div class="dashboard" style="text-align: center; margin-top: 0px;"> 
                <a class="box" id="users" href="listUsers.php">Gerenciar Usuários</a>
                <a class="box" id="projects" href="listProjects.php">Gerenciar Projetos</a>
                <a class="box" id="contributions" href="contributions.php">Extrato de Contribuições</a>
                <a class="box" id="novaFuncao" href="novaFuncao.php">Em Implementação</a>
            </div>
        </div>
        <center>
            <div style="text-align: center; margin-top: 0px;">
                <a href="../../index.php" class="button2" onclick="limparFormularios()">Sair</a>
            </div>
        </center>

        <?php include_once(__DIR__ . "/../../footer.php"); ?>
    </body>
</html>
