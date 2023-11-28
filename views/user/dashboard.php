<?php
include_once(__DIR__ . "/../../header.php");
include_once(__DIR__ . "/../../DAO/ProjectsDAO.php");

$projectsDAO = new ProjectsDAO();
$projects = $projectsDAO->findAll();
$total = 0;
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
                    <th>Investir</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; ?>
                <?php foreach ($projects as $project): 
                    
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $project->getId(); ?>
                        </td>

                        <td>
                            <label id="nome<?php echo $project->getId(); ?>">
                                <?php echo $project->getName(); ?>
                            </label>
                        </td>

                        <td>
                            <label id="descricao<?php echo $project->getId(); ?>">
                                <?php echo $project->getDescription(); ?><br>
                            </label>
                        </td>

                        <td>
                            <label id="estado<?php echo $project->getId(); ?>">
                                <?php echo $project->getState(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="cidade<?php echo $project->getId(); ?>">
                                <?php echo $project->getCity(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="rentabilidade<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getProfitability(), 2, ',', '.'); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="prazo<?php echo $project->getId(); ?>">
                                <?php echo $project->getDeadline(); ?>
                            </label><br>
                        </td>

                        <td>
                            <label id="metaF<?php echo $project->getId(); ?>">
                                <?php echo number_format($project->getFinancialGoal(), 2, ',', '.'); ?>
                            </label><br>
                        </td>

                        <td>
                            <?php echo number_format($project->getRaisedAmount(), 2, ',', '.'); ?>
                        </td>

                        <td>
                            <?php echo number_format($project->getCompletionPercentage(), 2, ',', '.') . '%'; ?>
                        </td>

                        <td>
                            <center>
                                <div style="display: flex;">
                                    <!-- Adicionando a text box para inserção do valor de investimento -->
                                    <input type="number" id="investmentValue<?php echo $i++;?>" name="investmentValue" class="input-grande" style="width: 110px; height: 30px;" placeholder="Digite o valor" oninput="atualizar()"> 
                                </div>
                            </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>
    </center>
    
    
    <!-- Soma de todos os investimentos com atualização em tempo real -->
    <div style="text-align: right; margin-right: 120px;">
        <p style="margin: 0;">
            <label id="valorTotal" style="margin-top: 20px; font-size: 22px;">
                <?php echo "TOTAL:    R$  " . number_format($total, 2, ',', '.'); ?>
            </label>
        </p>
    </div>



    <center>
        <div style="text-align: center; margin-top: 20px;">
        <a href="#" class="button" onclick="investir(<?php echo $project->getId(); ?>)">Investir</a>
        </div><br>
    </center>

    <center>
        <div style="text-align: center; margin-top: 20px;">
            <a href="../../index.php" class="button2">Sair</a>
        </div><br><br><br>
    </center>

    <?php include_once(__DIR__ . "/../../footer.php"); ?>

    <script>      

                    
        // Função para validar se o valor é um número não negativo
        function isNumberNonNegative(value) {
            // Substitui valores nulos, vazios ou não numéricos por 0
            value = isNaN(value) || value === null || value === '' ? 0 : parseFloat(value);

            // Verifica se o valor é um número não negativo
            return !isNaN(value) && value >= 0;
        }


        // Função para validar se o valor é um número positivo
        function isNumberPositive(value) {
            // Converte o valor para número
            value = parseFloat(value);

            // Verifica se o valor não é nulo e se é um número positivo
            return !isNaN(value) && value > 0;
        }


        // Função para atualizar o valor Total (Soma de todos os investimentos)
        function atualizar(investmentValue, id) {
            let total = 0.0;
            var i = 1;
            while(true){
                var elemento = document.getElementById("investmentValue"+i);
                if(!elemento) break;              
                if(elemento.value.length > 0 && isNumberNonNegative(elemento.value)) {
                    total += parseFloat(elemento.value);
                } 
                i++;
            }
            // Verifica se total é um número válido antes de chamar toLocaleString
            if (!isNaN(total)) {
                // Formata o número para exibição
                let formattedTotal = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                // Atualiza a exibição do total
                document.getElementById('valorTotal').innerText = "TOTAL: " + formattedTotal;
            } else {
                // Caso o total não seja um número válido, exibe uma mensagem de erro
                document.getElementById('valorTotal').innerText = "TOTAL: Erro no cálculo";
            }
        }





        // Função para atualizar o valor captado no banco de dados
        function atualizarValorCaptado(idProjeto, investmentValue) {
            // Criando um objeto Project com o ID do projeto
            var projectDAO = new ProjectsDAO();
            var project = projectDAO.findById(idProjeto);

            if (project) {
                // Atualizando os valores de raised_amount no objeto Project
                var raisedAmountAtual = project.getRaisedAmount();
                var raisedAmountNovo = raisedAmountAtual + investmentValue;
                project.setRaisedAmount(raisedAmountNovo);

                // Chamando a função updateRaisedAmount para atualizar no banco de dados
                var atualizacaoBemSucedida = projectDAO.updateRaisedAmount(project);

                if (atualizacaoBemSucedida === true) {
                    alert("Valor captado atualizado com sucesso!");
                    // Recarregando a página após a atualização
                    location.reload();
                } else {
                    alert("Erro ao atualizar valor captado: " + atualizacaoBemSucedida);
                }
            } else {
                alert("Projeto não encontrado.");
            }
        }

        
    </script>
</body>

</html>
