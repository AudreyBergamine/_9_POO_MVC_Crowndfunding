<?php
include_once(__DIR__ . "/../../DAO/UserDAO.php");

echo "<pre>";
print_r($_POST);
echo "<pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["userId"];
    $editedName = $_POST["editedName"];
    $editedEmail = $_POST["editedEmail"];
    $editedUserType = $_POST["editedUserType"];
    $editedNotification = $_POST["editedNotification"];

    // Validar e processar os dados conforme necessário

    $userDAO = new UserDAO();
    $user = new User([
        '0' => $userId,
        '1' => $editedName,
        '2' => $editedEmail,

        '3' => $editedUserType,
        '4' => $editedNotification,
    ]);

    $success = $userDAO->editUser($user);

    if ($success) {
        // Redirecionar para a página principal ou exibir uma mensagem de sucesso
        $successMessage = "Edição realizada com Sucesso! ";
        echo '<script>';
        echo 'alert("' . $successMessage . '");';
        // echo 'window.location.href = "\_9_POO_MVC_Crowndfunding\views\admin\listUsers copy.php";'; 
        echo 'window.location.href = "listUsers copy.php"'; 

        echo '</script>';
    } else {
        echo "Erro ao editar o usuário.";
    }
}
?>
