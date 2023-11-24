<?php

// Autoloader
spl_autoload_register(function ($class) {
    // Construa o caminho absoluto do arquivo
    $filePath = __DIR__ . '/controllers/' . $class . '.php';

    // Verifique se o arquivo existe antes de incluí-lo
    if (file_exists($filePath)) {
        require_once $filePath;
    } else {
        // Se o arquivo não existir, emita um aviso (pode ser ajustado conforme necessário)
        echo "Warning: Class file not found: $filePath";
    }
});

// Rotas
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

switch ($route) {
    case 'admin':
        //$controller = new AdminController();
        echo "SOU UM ADMINISTRADOR";
        break;
    case 'creator':
        //$controller = new CreatorController();
        echo "SOU UM CRIADOR";
        break;
    case 'user':
        echo "SOU UM USUARIO";
        break;
    default:
        $controller = new HomeController();
        break;
}

// Redirecionar para a página correta
//$controller->index();


include __DIR__ . '/views/login.php';

?>
<?php
// Para fazer o teste: 
// http://localhost/_9_POO_MVC_Crowndfunding/index.php
?>
