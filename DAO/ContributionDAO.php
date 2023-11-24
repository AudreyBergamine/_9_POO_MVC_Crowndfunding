<!-- Data Access Object -->
<!-- Acesso ás contribuições no banco de dados  -->

<!-- Cada Projeto vai ter suas contribuições - Criar pelo menos 2 pra cada, com usuários diferentes-->
<?php
include_once("../config/db.php");
include_once("../models/Contribution.php");

class ContributionDAO {  

    public function findAll(){
    $connection = dbCon::getConnection();
    if ($connection!=null){
        $result = mysqli_query ($connection, "SELECT * FROM "."contributions".";");
        $entidades = [];
        for ($c=0; $c<mysqli_num_rows($result); $c++){
            array_push($entidades, new Contribution(mysqli_fetch_array($result))); 
            
            // Pra cada linha do resultado, criamos um objeto Contribution passando como 
            // parametro um vetor contendo todas as colunas da linha. 
        }
    }
    return $entidades;
}


}
?>