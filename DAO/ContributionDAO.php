<!-- Data Access Object -->
<!-- Acesso ás contribuições no banco de dados  -->

<!-- TODO: Audrey: Cada Projeto vai ter suas contribuições - Criar pelo menos 2 pra cada, com usuários diferentes-->
<?php
include_once("../config/db.php");
include_once("/ProjectsDAO.php");
include_once("/UserDAO.php");
include_once("../models/Contribution.php");
include_once("../models/Project.php");
include_once("../models/User.php");

class ContributionDAO
{

    public function findAll()
    {
        $connection = dbCon::getConnection();
        if ($connection != null) {
            $result = mysqli_query($connection, "SELECT * FROM " . "contributions" . ";");
            $entidades = [];
            for ($c = 0; $c < mysqli_num_rows($result); $c++) {
                array_push($entidades, new Contribution(mysqli_fetch_array($result)));

                // Pra cada linha do resultado, criamos um objeto Contribution passando como 
                // parametro um vetor contendo todas as colunas da linha. 
            }
        }
        return $entidades;
    }

    public function addContribution($contribuition) {
        // TODO: Fazer a Lógica
    }




    public function getContributionById($id){
        $connection = dbCon::getConnection()->query("SELECT * FROM contributions WHERE id_contribuicao = $id");

        if ($connection) {
            $contrArray = mysqli_fetch_array($connection)[0];

            $Userdao = new UserDAO();
            $Projectdao = new ProjectsDAO();

            $usuario = $Userdao->findById($contrArray['id_user']);
            $projeto = $Projectdao->findById($contrArray['id_project']);


        }

    }

}
?>