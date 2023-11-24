
<!-- header.php -->

<?php
// echo "Verificação se o Header foi incluído: included!";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crowdfunding</title>

    <!-- Caminho do css: C:\wamp64\www\_9_POO_MVC_Crowndfunding\style.css-->
        <?php   
        // include_once("./style.css");
        // include_once("../style.css"); 
        // include_once("./../style.css"); 
        ?>
    
    <!-- Importa o arquivo style.css -->
    <!-- <link rel="stylesheet" href="style.css"> -->

        
    <!-- Importa o arquivo style.css usando caminho absoluto dinâmico -->
    <!-- <link rel="stylesheet" href="<?= __DIR__ ?>/../style.css"> -->

        
    <!-- Importa o arquivo style.css usando caminho absoluto -->
    <link rel="stylesheet" href="/_9_POO_MVC_Crowndfunding/style.css">




</head>

<body>
    <center>

        <div class="header">
            <img src="/_9_POO_MVC_Crowndfunding/Crowdfunding.png" alt="Logo Audrey" width="310" height="90"><br>
        </div>

        <!-- Abre a div do conteúdo principal -->
        <div class="content">

            



        </div>

    </center>
</body>

</html>
