<?php
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

$projectsDAOPath = __DIR__ . "/../../DAO/ProjectsDAO.php";

if (file_exists($projectsDAOPath)) {
    include_once($projectsDAOPath);
} else {
    die("Erro: O arquivo ProjectsDAO.php não foi encontrado em $projectsDAOPath");
}

// Verificando se o ID do projeto a ser excluído foi fornecido via parâmetro ou formulário
$projectIdToDelete = isset($_GET['id_project']) ? $_GET['id_project'] : null;

// var_dump($projectIdToDelete); 

// Adicionando logs para depuração
// error_log("ID do projeto a ser excluído: " . $projectIdToDelete);

// Se o ID do projeto foi fornecido
if ($projectIdToDelete) { // d
    $projectsDAO = new ProjectsDAO();

    // Recupera o projeto que você deseja excluir
    $projectToDelete = $projectsDAO->findById($projectIdToDelete);

    if ($projectToDelete) {
        // Exclue o projeto
        $deleteSuccess = $projectsDAO->deleteProject($projectToDelete);

        if ($deleteSuccess) {
            echo '<script>';
            echo 'alert("Projeto excluído com sucesso.");';
            echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/creator/listarProjects.php";'; 
            echo '</script>';
            exit();
        } else {
            echo "Erro ao excluir o projeto.";
        }
    } else {
        echo "Projeto não encontrado. ID: " . $projectIdToDelete;
    }
} else {
    echo "ID do projeto não fornecido.";
}
?>
