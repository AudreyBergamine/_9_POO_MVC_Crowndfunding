<!-- views/login.php -->

<?php 
// include_once("../header.php");
// include_once(__DIR__ . "/../../header.php");
// include_once("/_9_POO_MVC_Crowndfunding/header.php");
include_once(__DIR__ . "/../header.php");

?>

<!-- Página de Login de Usuário -->

<div class="user-container">
    <center>
    <h1>Olá! Seja Bem Vindo(a)!</h1><br>
    
    <h4>Faça seu login agora: </h4>


    <!-- Adicione aqui o formulário de login -->
    <form action="/_9_POO_MVC_Crowndfunding/views/process_login.php" method="post">
        <!-- Adicione campos do formulário conforme necessário -->
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button class="button2" type="submit"> ENTRAR </button><br><br><br> 

        <label for="email">Ainda não tem uma conta?  </label><br><br>
        <a class="button" id="cadastro" href="/_9_POO_MVC_Crowndfunding/views/user/register.php">Criar Conta</a>

    </form>
    </center>
</div>

<?php 
include_once(__DIR__ . "/../footer.php");
?>


