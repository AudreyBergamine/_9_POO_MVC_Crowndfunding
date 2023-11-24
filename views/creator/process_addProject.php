<?php
// Importando a classe ProjectDAO.php
include_once(__DIR__ . '/../../DAO/ProjectsDAO.php');

// Importando a classe Project.php
include_once(__DIR__ . '/../../models/Project.php');

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifique se os campos necessários foram preenchidos
    if (isset(
        $_POST["name"],
        $_POST["description"],
        $_POST["state"],
        $_POST["city"],
        $_POST["profitability"],
        $_POST["deadline"],
        $_POST["financialGoal"]
    )) {

        // Criar um array com os atributos na ordem específica
        $projectAttributes = [
            null, // O ID será gerado automaticamente pelo banco de dados
            $_POST["name"],
            $_POST["description"],
            $_POST["state"],
            $_POST["city"],
            $_POST["profitability"],
            $_POST["deadline"],
            $_POST["financialGoal"],
            // Os seguintes atributos são inicializados com zero e espaço em branco
            0,   // raised_amount
            0,   // completion_percentage
            " "  // updates
        ];

        // Crie uma instância da classe Project com os dados do formulário
        $project = new Project($projectAttributes);

        // Salve o projeto no banco de dados
        $projectsDAO = new ProjectsDAO();
        $saveSuccess = $projectsDAO->addProject($project);

        if ($saveSuccess) {
            $successMessage = "Projeto cadastrado com sucesso!";
            echo '<script>';
            echo 'alert("' . $successMessage . '");';
            echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/creator/listProjects.php";';
            echo '</script>';
        } else {
            echo "Erro ao cadastrar o projeto.";
        }
    } else {
        // Campos não preenchidos, exiba uma mensagem de erro ou redirecione para a página de registro
        echo "Não foi possível cadastrar o projeto. Certifique-se de preencher todos os campos obrigatórios.";
    }
} else {
    // Redirecionar para a página de registro com a mensagem de erro, se houver
    echo "Erro desconhecido ao tentar cadastrar o projeto. Verifique o código para mais detalhes.";
}
?>
