<?php
include_once(__DIR__ . "/../../header.php");
include_once(__DIR__ . "/../../DAO/UserDAO.php");


$userDAO = new UserDAO();
$users = $userDAO->findAll();
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <script>
        // Função para exibir e ocultar os campos de cadastro ao clicar no botão
        function toggleCamposCadastro() {
            var camposCadastro = document.getElementById('camposCadastro');
            camposCadastro.style.display = (camposCadastro.style.display === 'none' || camposCadastro.style.display === '') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <center>
        <label for="email">Deseja Inserir Novo Usuário ?  </label><br><br>
        <button id="addUserButton" class="button2" onclick="toggleCamposCadastro()">Adicionar Novo Usuário</button>
    </center><br><br>

    <!-- Campos de preenchimento ocultos inicialmente -->
    <div id="camposCadastro" style="display: none;">
        <h1>Cadastro de Usuário</h1>

        <!-- Formulário de registro -->
        <form action="../admin/process_addUser.php" method="post" style="max-width: 400px; margin: 0 auto; text-align: left;">
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
                <button type="submit">Registrar</button><br><br>
            </div>
        </form>
    </div>





    <h1>Lista de Usuários </h1>
    <center>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Tipo de Usuário</th>
                    <th>Notificação</th>
                    <th>Ações</th>  
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php if ($user->getId() > 1): ?>
                        <form class="edit-field" id="editForm<?php echo $user->getId(); ?>" method="post" action="process_edit_user.php">
                            <tr id="editTr<?php echo $user->getId(); ?>" >

                                <td>
                                    <?php echo $user->getId(); ?>
                                    <input type="hidden" name="userId" value="<?php echo $user->getId(); ?>"><br>
                                </td>
                                <td>
                                    <label id="nome<?php echo $user->getId();?>">
                                        <?php echo $user->getName(); ?>
                                    </label>
                                    <input type="text" id="editedName<?php echo $user->getId();?>" name="editedName" style="width: 190px; display: none;" value="<?php echo $user->getName(); ?>"><br><br>

                                </td>
                                <td>
                                    <label id="email<?php echo $user->getId();?>">
                                        <?php echo $user->getEmail(); ?>
                                    </label>
                                    <input type="email" id="editedEmail<?php echo $user->getId();?>" name="editedEmail" style="width: 190px; display: none;" value="<?php echo $user->getEmail(); ?>"><br><br>

                                </td>
                                <td>
                                <label id="UserType<?php echo $user->getId();?>">
                                    <?php echo $user->getUserType(); ?>
                                    </label>
                                    <input type="text" id="editedUserType<?php echo $user->getId();?>" name="editedUserType" style="width: 60px; display: none;" value="<?php echo $user->getUserType(); ?>"><br><br>

                                </td>
                                <td>
                                <label id="Notification<?php echo $user->getId();?>">
                                    <?php echo $user->getNotification(); ?>
                                    </label>
                                    <input type="text" id="editedNotification<?php echo $user->getId();?>" name="editedNotification" style="width: 80px; display: none;" value="<?php echo $user->getNotification(); ?>"><br><br>

                                </td>
                                <td>
                                    <center>
                                        <div style="display: flex;">
                                            
                                            <!-- Botão para abrir o formulário de edição -->
                                            <button type="button" onclick="editUser(<?php echo $user->getId(); ?>)" id="btnEditar<?php echo $user->getId(); ?>">Editar</button>
                                            
                                            <!-- Botão para excluir o usuário -->
                                            <button type="button" onclick="deleteUser(<?php echo $user->getId(); ?>)"style="Display: none" id="btnExcluir<?php echo $user->getId(); ?>">Excluir</button>
                                            
                                            <input type="submit" value="Salvar" class="button2" style="Display: none" id="btnSalvar<?php echo $user->getId(); ?>">
                                        </div>
                                    </center>                                        
                                </td>
                            </tr>
                        </form>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table><br>
    </center>

    <!-- Botão para voltar ao painel de administração -->
    <center>
        <div style="text-align: center; margin-top: 20px;">
        <a href="../admin/dashboard.php" class="button2">Voltar</a>
    </div><br><br><br>
    </center>
    
<?php include_once(__DIR__ . "/../../footer.php"); ?>

<script>
    // Função para exibir o campo de edição ao clicar no botão
    function editUser(userId) {
        
        var btnEditar = document.getElementById("btnEditar" + userId);

        if ( btnEditar.innerHTML == "Editar" ) {
        var labelName = document.getElementById("nome" + userId).style = "Display: none;";
        var inputName = document.getElementById("editedName" + userId).style = "";
       
        var labelEmail = document.getElementById("email" + userId).style = "Display: none;";
        var inputEmail = document.getElementById("editedEmail" + userId).style = "";

        var labelUserType = document.getElementById("UserType" + userId).style = "Display: none;";
        var inputUserType = document.getElementById("editedUserType" + userId).style = "";

        var labelNotif = document.getElementById("Notification" + userId).style = "Display: none;";
        var inputNotif = document.getElementById("editedNotification" + userId).style = "";

        var btnSalvar = document.getElementById("btnSalvar" + userId).style = "Display: flex";
        var btnExcluir = document.getElementById("btnExcluir" + userId).style = "Display: flex";

        btnEditar.innerText = "Voltar";
        btnEditar.style = "background-color: red";

        } else {
        var labelName = document.getElementById("nome" + userId).style = " ";
        var inputName = document.getElementById("editedName" + userId).style = "Display: none;";
       
        var labelEmail = document.getElementById("email" + userId).style = " ";
        var inputEmail = document.getElementById("editedEmail" + userId).style = "Display: none;";

        var labelUserType = document.getElementById("UserType" + userId).style = " ";
        var inputUserType = document.getElementById("editedUserType" + userId).style = "Display: none;";

        var labelNotif = document.getElementById("Notification" + userId).style = " ";
        var inputNotif = document.getElementById("editedNotification" + userId).style = "Display: none;";
        
        var btnSalvar = document.getElementById("btnSalvar" + userId).style = "Display: none;";
        var btnExcluir = document.getElementById("btnExcluir" + userId).style = "Display: none;";
        
        btnEditar.innerText = "Editar";
        btnEditar.style = "background-color: rgb(132, 31, 158)";

        }   
    }

    // Função para confirmar exclusão e redirecionar para o processamento
    function deleteUser(userId) {
        var confirmDelete = confirm("Tem certeza de que deseja excluir este usuário?");
        if (confirmDelete) {
            window.location.href = "process_delete_user.php?user_id=" + userId;
        }
    }
</script>

</body>
</html>
