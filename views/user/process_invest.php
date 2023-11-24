<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["investmentValue"]) && isset($_POST["project_id"])) {
        $investmentValue = floatval($_POST["investmentValue"]);
        $projectId = intval($_POST["project_id"]);

        include_once(__DIR__ . "/../models/Project.php");
        include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

        $projectsDAO = new ProjectsDAO();
        $project = $projectsDAO->findById($projectId);

        if ($project) {
            // Atualiza os valores no objeto do projeto
            $project->setRaisedAmount($project->getRaisedAmount() + $investmentValue);

            // Recalcula a porcentagem de conclusão
            $completionPercentage = ($project->getRaisedAmount() / $project->getFinancialGoal()) * 100;
            $project->setCompletionPercentage($completionPercentage);

            // Atualiza o projeto no banco de dados
            $success = $projectsDAO->editProject($project);

            if ($success === true) {                 
                // Redireciona para a página de projetos após o sucesso
                $successMessage = "Projeto cadastrado com sucesso!";
                echo '<script>';
                echo 'alert("' . $successMessage . '");';
                echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/creator/listProjects.php";';
                echo '</script>';
                exit(); 
            } else {
                echo "Erro ao cadastrar o projeto.";
            }
        } else {
            echo "Projeto não encontrado.";
        }
    } else {
        echo "Parâmetros inválidos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
