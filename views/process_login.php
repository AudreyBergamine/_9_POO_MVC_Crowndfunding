<!-- processamento do login -->

<?php 
include_once('../DAO/userDAO.php');

$email = $_POST["email"];
$password = $_POST["password"];

$userdao = new UserDAO();

$user = $userdao->findByEmailAndPassword($email, $password);

session_start();

$_SESSION['user_id'] = $user->getId();

if(empty($user)){
    echo "USUARIO VAZIO";
}else{
    echo "BEM VINDO(A) ".$user->getName();

    switch ($user->getUserType()) {
        case 'admin':
            // Direcionar usando Javascript para /admin/dashboard
            echo "<script> window.location.href= 'admin/dashboard.php'</script>";
            # code...
            break;
        case 'creator':
            // Direcionar usando Javascript para /creator/dashboard
            echo "<script> window.location.href= 'creator/listProjects.php'</script>";
            # code...
            break;
        case 'user':
            // Direcionar usando Javascript para /user/dashboard
            echo "<script> window.location.href= 'user/dashboard.php'</script>";
            # code...
            break;
        
        default:
            echo 'Login Inválido';
            break;
    }
}



?>


