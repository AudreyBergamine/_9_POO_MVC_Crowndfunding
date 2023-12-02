<?php

include_once(__DIR__ . "./../../config/db.php");
include_once(__DIR__ . "./../../models/Project.php");
include_once(__DIR__ . "./../../DAO/ProjectsDAO.php");
include_once(__DIR__ . "./../../DAO/ContributionDAO.php");

// Verifica se é uma requisição POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se a ação é investir
    if ($_POST["action"] === "invest") {
        // Inicializa o array de resposta
        $response = ["message" => ""];

        // Inicializa o DAO de projetos
        $projectsDAO = new ProjectsDAO();

        // Loop através dos valores de investimento
        foreach ($_POST as $projectId => $investmentValue) {
            // Obtém o projeto pelo ID
            $project = $projectsDAO->findById($projectId);

            $investmentValue = doubleval($investmentValue);

            if ($project) {
                // Atualiza os valores no objeto do projeto
                $project->setRaisedAmount($project->getRaisedAmount() + $investmentValue);
                
                
                // Recalcula a porcentagem de conclusão                
                $raizedAmount = $project->getRaisedAmount();
                $financialGoal = $project->getFinancialGoal();
                
                $soma = $raizedAmount + $investmentValue;

                
                if ($raizedAmount > 0 && $soma <= $financialGoal) {

                    if (!isset($_SESSION['user_id'])) {
                        session_start();
                        $user_id = $_SESSION['user_id'];
                    } else {
                        $user_id = $_SESSION['user_id'];
                    }



                    $completionPercentage = ($raizedAmount / $financialGoal) * 100;
                    $project->setCompletionPercentage($completionPercentage);
                   
                }
               

                // Atualiza o projeto no banco de dados
                $success = $projectsDAO->updateRaisedAmount($project);

                if (!$success) {
                    $response["message"] .= "Erro ao registrar o investimento para o projeto com ID $projectId. ";
                }
            } else {
                $response["message"] .= "Projeto com ID $projectId não encontrado. ";
            }
        }

        // Resposta para o frontend
        echo $response["message"];
    } else {
        // Lógica para outros tipos de ação, se necessário
        echo "Ação desconhecida.";
    }
} else {
    echo "Método de requisição inválido.";
}

?>

<script>
    window.location.href = '/_9_POO_MVC_Crowndfunding/views/user/dashboard.php';
</script>
