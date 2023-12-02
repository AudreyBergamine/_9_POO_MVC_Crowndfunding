<!-- Data Access Object -->
<!-- Acesso ás contribuições no banco de dados  -->

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

    public function addContribution(Contribution $contribution) {
        $connection = dbCon::getConnection();
    
        if ($connection != null) {
            $contributionDate = $contribution->getContributionDate();
            $amount = $contribution->getAmount();
            $id_user = $contribution->getIdUser();
            $id_project = $contribution->getIdProject();
    
            $query = "INSERT INTO contributions 
                (contribution_date, amount, id_user, id_project) 
                VALUES (?, ?, ?, ?)";
    
            $stmt = $connection->prepare($query);
    
            if ($stmt) {
                $stmt->bind_param(
                    "sddd",
                    $contributionDate,
                    $amount,
                    $id_user,
                    $id_project
                );
    
                $success = $stmt->execute();    
                $stmt->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }    
            mysqli_close($connection);    
            return $success;
        }    
        return false;
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