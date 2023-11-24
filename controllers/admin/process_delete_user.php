<?php
// include_once(__DIR__ . "/../../DAO/UserDAO.php");

$userDAOPath = __DIR__ . "/../../DAO/UserDAO.php";

if (file_exists($userDAOPath)) {
    include_once($userDAOPath);
} else {
    die("Erro: O arquivo UserDAO.php não foi encontrado em $userDAOPath");
}


// Verificando se o ID do usuário a ser excluído foi fornecido via parâmetro ou formulário
$userIdToDelete = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Se o ID do usuário foi fornecido
if ($userIdToDelete) {
    $userDAO = new UserDAO();

    // Recupera o usuário que você deseja excluir
    $userToDelete = $userDAO->findById($userIdToDelete);

    if ($userToDelete) {
        // Exclue o usuário
        $deleteSuccess = $userDAO->deleteUser($userToDelete);

        if ($deleteSuccess) {
            echo '<script>';
            echo 'alert("Usuário excluído com sucesso.");';
            echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/admin/listUsers.php";';  
            echo '</script>';
            exit();
        } else {
            echo "Erro ao excluir o usuário.";
        }
    } else {
        echo "Usuário não encontrado. ID: " . $userIdToDelete;
    }
} else {
    echo "ID do usuário não fornecido.";
}
?>
