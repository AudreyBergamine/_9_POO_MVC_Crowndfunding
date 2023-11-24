<?php
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

var_dump($_POST); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST["projectId"];
    $editedName = $_POST["editedName"];
    $editedDescription = $_POST["editedDescription"];
    $editedState = $_POST["editedState"];
    $editedCity = $_POST["editedCity"];
    $editedProfitability = $_POST["editedProfitability"];
    $editedDeadline = $_POST["editedDeadline"];
    $editedFinancialGoal = $_POST["editedFinancialGoal"];
    

    // Validar e processar os dados conforme necessário

    $projectsDAO = new ProjectsDAO();
    $project = new Project([
        '0' => $projectId,
        '1' => $editedName,
        '2' => $editedDescription,
        '3' => $editedState,
        '4' => $editedCity,
        '5' => $editedProfitability,
        '6' => $editedDeadline,
        '7' => $editedFinancialGoal,
    ]);
    // var_dump($project); 

    $success = $projectsDAO->editProject($project);


    // var_dump($success); 


    if ($success) {
        // Redirecionar para a página principal ou exibir uma mensagem de sucesso
        $successMessage = "Edição realizada com Sucesso! ";
        echo '<script>';
        echo 'alert("' . $successMessage . '");';
        // echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/creator/listProjects.php";'; 
        echo '</script>';
        exit();

    } else {
        echo "Erro ao editar o projeto.";
    }
}
?>
