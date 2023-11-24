<!-- Cadastro de Novos Usuários... Seja Criador ou Apoiador -->

<!-- views/user/register.php -->

<?php 
include_once("../../header.php");
?>

<!-- Página de Registro de Usuário -->

<div class="user-container" style="text-align: left;">
   <center>
    
    <h1>Cadastro de Usuário</h1>

    <!-- Formulário de registro -->
    <form action="process_registration.php" method="post" style="max-width: 400px; margin: 0 auto; text-align: left;">
    
        <div style="margin-bottom: 10px;">
            <label for="username" style="padding-right: 20px;">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="email" style="padding-right: 99px;">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password" style="padding-right: 99px;">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="notification_preference" style="padding-right: 48px;">Notificações:</label>
            <select id="notification_preference" name="notification_preference">
                <option value="email">E-mail</option>
                <option value="whatsapp">WhatsApp</option>
            </select>
        </div>



        <!-- Adicionar campo de escolha entre Criador e Apoiador -->
        <div style="margin-bottom: 10px;">
            <label for="user_type" style="padding-right: 28px;">Tipo de Usuário:</label>
            <select id="user_type" name="user_type" required>
                <option value="creator">Criador</option>
                <option value="supporter">Apoiador</option>
            </select>
        </div><br>

        <div style="text-align: center; margin-top: 10px;">
            <button type="submit">Registrar</button>
        </div>

    </form>
    </center>
</div>

<?php 
include_once("../../footer.php");
?>

