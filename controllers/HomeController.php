<?php
// Controle do Apoiador

class HomeController {
    public function index() {
        include __DIR__ . '/../index.php';
    }

    public function viewProjectAdm($projectId) {
        $db = Database::getInstance();
        $project = $db->select('projects', '*', "id = $projectId");
        include __DIR__ . '/../views/admin/projects.php';

    }

    public function viewProjectsAdm() {
        $db = Database::getInstance();
        $projects = $db->select('projects', '*');
        include __DIR__ . '/../views/admin/projects.php';

    }

    
    public function viewProjectUser($projectId) {
        $db = Database::getInstance();
        $project = $db->select('projects', '*', "id = $projectId");
        include __DIR__ . '/../views/user/projects_invest.php';

    }

    public function viewProjectsUser() {
        $db = Database::getInstance();
        $projects = $db->select('projects', '*');
        include __DIR__ . '/../views/views/user/projects_invest.php';
    }

    public function processRegistrationForm($postData) {
        $name = $postData['name'];
        $email = $postData['email'];
        $password = $postData['password'];
    
        $db = Database::getInstance();
    
        $existingUser = $db->select('users', 'id', "email = '$email'");
    
        if (!$existingUser) {
            $userId = $db->insert('users', [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT), // Armazenar a senha de forma segura
            ]);
            session_start();
    
            // Armazenar o ID do usuário na sessão para fins de autenticação
            $_SESSION['user_id'] = $userId;
    
            // Redirecionar para a página inicial ou outra página de sucesso
            echo '<script>window.location.href = "index.php";</script>';
            exit;
        } else {
            echo "Erro: O e-mail já está registrado. Tente novamente com um e-mail diferente.";
        }
    }
}
?>
