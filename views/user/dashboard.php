<?php
include_once(__DIR__ . "/../../header.php");
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

$projectsDAO = new ProjectsDAO();
$projects = $projectsDAO->findAll();
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
    <h1>Lista de Projetos</h1>
    <center>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Rentabilidade</th>
                    <th>Prazo do Projeto</th>
                    <th>Meta Financeira</th>
                    <th>Valor Captado</th>
                    <th>% Concluído</th>
                    <th>Investir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $project->getId(); ?>
                        </td>

                        <td>
                            <label id="nome<?php echo $project->getId(); ?>">
                                <?php echo $project->getName(); ?>
                            </label>
                        </td>

                        <td>
                            <label id="descricao<?php echo $project->getId(); ?>">
                                <?php echo $project->getDescription(); ?><br>
                            </label>
                        </td>

                        <td>
                            <label id="estado<?php echo $project->getId(); ?>">
                                <?php echo $project->getState(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="cidade<?php echo $project->getId(); ?>">
                                <?php echo $project->getCity(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="rentabilidade<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getProfitability(), 2, ',', '.'); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="prazo<?php echo $project->getId(); ?>">
                                <?php echo $project->getDeadline(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="metaF<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getFinancialGoal(), 2, ',', '.'); ?>
                            </label><br>
                        </td>

                        <td>
                            <?php echo number_format($project->getRaisedAmount(), 2, ',', '.'); ?>
                        </td>

                        <td>
                            <?php echo number_format($project->getCompletionPercentage(), 2, ',', '.') . '%'; ?>
                        </td>

                        <td>
                            <center>
                                <div style="display: flex;">
                                    <!-- Adicionando a text box para inserção do valor de investimento -->
                                    <input type="text" id="investmentValue<?php echo $project->getId(); ?>" name="investmentValue" style="width: 80px;" placeholder="Digite o valor">
                                </div>
                            </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>
    </center>
    <center>
        <div style="text-align: center; margin-top: 20px;">
            <!-- Corrigindo a classe do botão "Investir" para "button" -->
            <a href="../login.php" class="button">Investir</a>
        </div><br>
    </center>

    <center>
        <div style="text-align: center; margin-top: 20px;">
            <a href="../login.php" class="button2">Sair</a>
        </div><br><br><br>
    </center>

    <?php include_once(__DIR__ . "/../../footer.php"); ?>

    <script>
        // Se houver algum script adicional, você pode adicionar aqui
    </script>
</body>

</html>
