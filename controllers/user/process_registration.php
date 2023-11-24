<?php
// Importando o UserDAO.php
include_once(__DIR__ . '/../../DAO/UserDAO.php');

// Importando o User.php
include_once("../../models/User.php");

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifique se os campos necessários foram preenchidos
    if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["user_type"], $_POST["notification_preference"])) {

        // Defina o valor de notification com base na escolha do usuário
        $notificationPreference = strtolower($_POST["notification_preference"]);

        // Defina o tipo de usuário com base na escolha do usuário
        $userType = ($_POST["user_type"] == 'creator') ? 'creator' : 'user';

        // Verifique se o usuário já existe no banco de dados
        $userDAO = new UserDAO();
        $existingUser = $userDAO->findByEmailAndPassword($_POST["email"], $_POST["password"]);
        var_dump($existingUser);

        if ($existingUser) {
            // Usuário já existe, exiba uma mensagem de erro ou redirecione para a página de registro
            $errorMessage = "Usuário já cadastrado!  Faça login para entrar! ";
            echo '<script>';
            echo 'alert("' . $errorMessage . '");';
            echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/login.php";'; 
            echo '</script>';
            exit();
        } else {
            // Criar um array com os atributos na ordem específica
            $userAttributes = [
                null, // O ID será gerado automaticamente pelo banco de dados
                $_POST["username"],
                $_POST["email"],
                $_POST["password"],
                $userType,
                $notificationPreference
            ];

            // Crie uma instância da classe User com os dados do formulário
            $user = new User($userAttributes);

            // Salve o usuário no banco de dados
            $saveSuccess = $userDAO->addUser($user);

            if ($saveSuccess) {
                $successMessage = "Cadastro Realizado com Sucesso!! Agora faça o login! ";
                echo '<script>';
                echo 'alert("' . $successMessage . '");';
                echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/login.php";'; 
                echo '</script>';
            } else {
                echo "Erro ao registrar o usuário.";
            }
        }
    } else {
        // Campos não preenchidos, exiba uma mensagem de erro ou redirecione para a página de registro
        echo "Não foi possível registrar!";
    }
} else {
    // Redirecionar para a página de registro com a mensagem de erro, se houver
    if (isset($errorMessage)) {
        echo '<script>';
        echo 'alert("' . $errorMessage . '");';
        echo 'window.location.href = "/_9_POO_MVC_Crowndfunding/views/user/register.php";';
        echo '</script>';
        exit();
    } else {
        echo "Erro desconhecido ao tentar registrar o usuário. Verifique o código para mais detalhes.";
    }
}
?>
