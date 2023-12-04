<!-- views/admin/contributions.php -->
    <!--  CÓDIGO COM ERRO -->
<?php
include_once(__DIR__ . "/../../header.php");
include_once(__DIR__ . "/../../config/db.php");

include_once(__DIR__ . "/../../DAO/ContributionDAO.php");
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");
include_once(__DIR__ . "/../../DAO/UserDAO.php");

include_once(__DIR__ . "/../../models/Contribution.php");
include_once(__DIR__ . "/../../models/Project.php");
include_once(__DIR__ . "/../../models/User.php");



$userDAO = new UserDAO();
$users = $userDAO->findAll();

$projectsDAO = new ProjectsDAO();
$projects = $projectsDAO->findAll();

$contributionsDAO = new ContributionDAO();
$contributions = $contributionsDAO->findAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        html {
            zoom: 80%;
        }
    </style>

</head>

<body>
    <!-- <center>
        <label for="project">Deseja Inserir Nova Contribuição? </label><br><br>
        <button id="addContributionButton" class="button2" onclick="toggleCamposCadastro()">Adicionar Nova Contribuição</button><br><br>
    </center> -->

    <!-- Campos de preenchimento ocultos inicialmente -->
    <!-- <div id="camposCadastro" style="display: none;">
        <h1>Cadastro de Contribuição</h1> -->

        <!-- Formulário de registro -->
        <!-- <form action="/_9_POO_MVC_Crowndfunding/controllers/admin/process_addContribution.php" method="post"
            style="max-width: 400px; margin: 0 auto; text-align: left;">
            <table>
                <tr>
                    <td><label for="contributionDate">Data da Contribuição:</label></td>
                    <td><input type="date" id="contributionDate" name="contributionDate" style="width: 190px;"
                            required></td>
                </tr>
                <tr>
                    <td><label for="amount">Valor:</label></td>
                    <td><input type="text" id="amount" name="amount" style="width: 190px;" required></td>
                </tr>
                <tr>
                    <td><label for="id_user">ID do Usuário:</label></td>
                    <td><input type="text" id="id_user" name="id_user" style="width: 190px;" required></td>
                </tr>
                <tr>
                    <td><label for="id_project">ID do Projeto:</label></td>
                    <td><input type="text" id="id_project" name="id_project" style="width: 190px;" required></td>
                </tr>
            </table>

            <div style="text-align: center; margin-top: 10px;">
                <button type="submit">Registrar</button><br><br>
            </div>
        </form>
    </div> -->


    <h1>Lista de Contribuições</h1>
    <center>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data da Contribuição</th>
                    <th>Valor</th>
                    <th>Usuário</th>
                    <th>Projeto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contributions as $contribution): ?>
                <tr>
                    <td><?php echo $contribution->getIdContribuicao(); ?></td>
                    <td><?php echo $contribution->getContributionDate(); ?></td>
                    <td><?php echo $contribution->getAmount(); ?></td>
                    <td><?php echo $contribution->getUser()->getName(); ?></td>
                    <td><?php echo $contribution->getProject()->getName(); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>
    </center>

    <center>
        <div style="text-align: center; margin-top: 20px;">
            <a href="../admin/dashboard.php" class="button2">Voltar</a>
        </div><br><br><br>
    </center>

    <?php include_once(__DIR__ . "/../../footer.php"); ?>

    <script>
        // // Função para exibir e ocultar os campos de cadastro ao clicar no botão
        // function toggleCamposCadastro() {
        //     var camposCadastro = document.getElementById('camposCadastro');
        //     camposCadastro.style.display = (camposCadastro.style.display === 'none' || camposCadastro.style.display === '') ? 'block' : 'none';
        //     document.getElementById('addContributionButton').style.display = 'none';
        // }
    </script>
</body>

</html>
