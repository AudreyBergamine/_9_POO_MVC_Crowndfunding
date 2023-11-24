<?php
include_once(__DIR__ . "/../../header.php");
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

$projectsDAO = new ProjectsDAO();
$projects = $projectsDAO->findAll();
?>


<!DOCTYPE html>
<html lang="pt-BR">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        html {
            zoom: 80%;
        }
    </style>

   
</head>

<body>
    <center>
        <!-- Adicione um ID ao botão para facilitar a manipulação pelo JavaScript -->
        <label for="project">Deseja Inserir Novo Projeto? </label><br><br>
        <button id="addProjectButton" class="button2" onclick="toggleCamposCadastro()">Adicionar Novo Projeto</button><br><br>
    </center>

    <!-- Campos de preenchimento ocultos inicialmente -->
    <div id="camposCadastro" style="display: none;">
        <h1>Cadastro de Projeto</h1>

        <!-- Formulário de registro -->
        <form action="../admin/process_addProject.php" method="post" style="max-width: 400px; margin: 0 auto; text-align: left;">
        <table>
            <tr>
                <td><label for="name">Nome:</label></td>
                <td><input type="text" id="name" name="name" style="width: 190px;" required></td>
            </tr>
            <tr>
                <td><label for="description">Descrição:</label></td>
                <td><textarea id="description" name="description" style="width: 190px;" required></textarea></td>
            </tr>
            <tr>
                <td><label for="state">Estado:</label></td>
                <td><input type="text" id="state" name="state" style="width: 190px;" required></td>
            </tr>
            <tr>
                <td><label for="city">Cidade:</label></td>
                <td><input type="text" id="city" name="city" style="width: 190px;" required></td>
            </tr>
            <tr>
                <td><label for="profitability">Rentabilidade:</label></td>
                <td><input type="text" id="profitability" name="profitability" style="width: 190px;" required></td>
            </tr>
            <tr>
                <td><label for="deadline">Prazo do Projeto:</label></td>
                <td><input type="date" id="deadline" name="deadline" style="width: 190px;" required></td>
            </tr>
            <tr>
                <td><label for="financialGoal">Meta Financeira:</label></td>
                <td><input type="text" id="financialGoal" name="financialGoal" style="width: 190px;" required></td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 10px;">
            <button type="submit">Registrar</button><br><br>
        </div>
    </form>
</div>

    <h1>Lista de Projetos</h1>
    <center>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Rentabilidade</th>
                    <th>Prazo do Projeto</th>
                    <th>Meta Financeira</th>
                    <th>Valor Captado</th>
                    <th>% Concluído</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>

                    <!-- Formulário de edição (inicialmente oculto) -->
                    <form class="edit-field" id="editForm<?php echo $project->getId(); ?>" method="post" action="process_edit_project.php">
                        <tr>
                            <td style="text-align: center;"> 
                                <?php echo $project->getId(); ?>
                                <input hidden id="id_project<?php echo $project->getId();?>"  name="id_project" value="<?php echo $project->getId(); ?>">
                            </td>

                            <td>
                                <label id="nome<?php echo $project->getId(); ?>">
                                    <?php echo $project->getName(); ?>
                                </label>
                                <input type="text" id="editedName<?php echo $project->getId();?>" name="editedName" style="width: 160px; display: none;" value="<?php echo $project->getName(); ?>"><br><br>
                            </td>

                            <td>
                                <label id="descricao<?php echo $project->getId(); ?>">
                                    <?php echo $project->getDescription(); ?><br>
                                </label>
                                <textarea id="editedDescription<?php echo $project->getId();?>" name="editedDescription" style="width: 190px; display: none;"><?php echo $project->getDescription(); ?></textarea><br><br>
                            </td>

                            <td>
                                <label id="estado<?php echo $project->getId(); ?>">
                                    <?php echo $project->getState(); ?>
                                </label><br>
                                <input type="text" id="editedState<?php echo $project->getId();?>" name="editedState" style="width: 40px; display: none;" value="<?php echo $project->getState(); ?>"><br><br>                        
                            </td>

                            <td>
                                <label id="cidade<?php echo $project->getId(); ?>">
                                    <?php echo $project->getCity(); ?>
                                </label><br>
                                <input type="text" id="editedCity<?php echo $project->getId();?>" name="editedCity" style="width: 90px; display: none;" value="<?php echo $project->getCity(); ?>"><br><br>                            
                            </td>

                            <td>
                                <label id="rentabilidade<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getProfitability(), 2, ',', '.'); ?>
                                </label><br>
                                <input type="text" id="editedProfitability<?php echo $project->getId();?>" name="editedProfitability" style="width: 40px; display: none;" value="<?php echo $project->getProfitability(); ?>"><br><br>                        
                            </td>

                            <td>
                                <label id="prazo<?php echo $project->getId(); ?>">
                                <?php echo $project->getDeadline(); ?>
                                </label><br>
                                <input type="date" id="editedDeadline<?php echo $project->getId();?>" name="editedDeadline" style="width: 90px; display: none;" value="<?php echo $project->getDeadline(); ?>"><br><br>
                            </td>

                            <td>
                                <label id="metaF<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getFinancialGoal(), 2, ',', '.'); ?>
                                </label><br>
                                <input type="text" id="editedFinancialGoal<?php echo $project->getId();?>" name="editedFinancialGoal" style="width: 100px; display: none;" value="<?php echo $project->getFinancialGoal(); ?>"><br><br>                    
                            </td>

                            <td>
                                <?php echo number_format($project->getRaisedAmount(), 2, ',', '.'); ?></td>
                            <td>
                                <?php echo number_format($project->getCompletionPercentage(), 2, ',', '.') . '%'; ?>
                            </td>

                            <td>
                                <center>
                                    <div style="display: flex;">

                                        <!-- Botão para abrir o formulário de edição -->
                                        <button type="button" onclick="editProject(<?php echo $project->getId(); ?>)" id="btnEditar<?php echo $project->getId(); ?>">Editar</button>

                                        <!-- Botão para excluir o projeto -->
                                        <button type="button" onclick="deleteProject(<?php echo $project->getId(); ?>)"style="Display: none" id="btnExcluir<?php echo $project->getId(); ?>">Excluir</button>
                                    
                                        <input type="submit" value="Salvar" class="button2" style="Display: none" id="btnSalvar<?php echo $project->getId(); ?>">
                                    </div>
                                </center>
                            </td>
                        </tr>                        
                    </form>
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
    function editProject(id_project) {
        
        var btnEditar = document.getElementById("btnEditar" + id_project);

        if ( btnEditar.innerHTML == "Editar" ) {
        var labelName = document.getElementById("nome" + id_project).style = "Display: none;";
        var inputName = document.getElementById("editedName" + id_project).style = "width: 160px";
       
        var labelDesc = document.getElementById("descricao" + id_project).style = "Display: none;";
        var inputDesc = document.getElementById("editedDescription" + id_project).style = "width: 190px";

        var labelEstate = document.getElementById("estado" + id_project).style = "Display: none;";
        var InputEstate = document.getElementById("editedState" + id_project).style = "width: 20px";

        var labelCity = document.getElementById("cidade" + id_project).style = "Display: none;";
        var labelCity = document.getElementById("editedCity" + id_project).style = "width: 90px";

        var labelRent = document.getElementById("rentabilidade" + id_project).style = "Display: none;";
        var labelRent = document.getElementById("editedProfitability" + id_project).style = "width: 40px";

        var labelPrazo = document.getElementById("prazo" + id_project).style = "Display: none;";
        var labelPrazo = document.getElementById("editedDeadline" + id_project).style = "width: 80px";

        var labelMeta = document.getElementById("metaF" + id_project).style = "Display: none;";
        var labelMeta = document.getElementById("editedFinancialGoal" + id_project).style = "width: 100px";


        var btnSalvar = document.getElementById("btnSalvar" + id_project).style = "Display: flex";
        var btnExcluir = document.getElementById("btnExcluir" + id_project).style = "Display: flex";

        btnEditar.innerText = "Voltar";
        btnEditar.style = "background-color: red";

        } else {
        var labelName = document.getElementById("nome" + id_project).style = " ";
        var inputName = document.getElementById("editedName" + id_project).style = "Display: none;";
       
        var labelDesc = document.getElementById("descricao" + id_project).style = " ";
        var inputDesc = document.getElementById("editedDescription" + id_project).style = "Display: none;";

        var labelEstate = document.getElementById("estado" + id_project).style = " ";
        var labelEstate = document.getElementById("editedState" + id_project).style = "Display: none;";

        var labelCity = document.getElementById("cidade" + id_project).style = " ";
        var labelCity = document.getElementById("editedCity" + id_project).style = "Display: none;";

        var labelRent = document.getElementById("rentabilidade" + id_project).style = "";
        var labelRent = document.getElementById("editedProfitability" + id_project).style = "Display: none;";

        var labelPrazo = document.getElementById("prazo" + id_project).style = "";
        var labelPrazo = document.getElementById("editedDeadline" + id_project).style = "Display: none;";

        var labelMeta = document.getElementById("metaF" + id_project).style = "";
        var labelMeta = document.getElementById("editedFinancialGoal" + id_project).style = "Display: none;";

        var btnSalvar = document.getElementById("btnSalvar" + id_project).style = "Display: none;";
        var btnExcluir = document.getElementById("btnExcluir" + id_project).style = "Display: none;";
        
        btnEditar.innerText = "Editar";
        btnEditar.style = "background-color: rgb(132, 31, 158)";

        }   
    }

    // Função para confirmar exclusão e redirecionar para o processamento
    function deleteProject(id_project) {
        var confirmDelete = confirm("Tem certeza de que deseja excluir este Projeto?");
        if (confirmDelete) {
            window.location.href = "process_delete_project.php?id_project=" + id_project;
        }
    }

    // Função para exibir e ocultar os campos de cadastro ao clicar no botão
    function toggleCamposCadastro() {
        var camposCadastro = document.getElementById('camposCadastro');
        camposCadastro.style.display = (camposCadastro.style.display === 'none' || camposCadastro.style.display === '') ? 'block' : 'none';
        document.getElementById('addProjectButton').style.display = 'none';
    }   

    
</script>
</body>
</html>

