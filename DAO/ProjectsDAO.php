<?php
include_once(__DIR__ . "/../config/db.php");
include_once(__DIR__ . "/../models/Project.php");

class ProjectsDAO {

    
    public function findAll() {
        $connection = dbCon::getConnection();
        $projects = [];

        if ($connection != null) {
            $result = mysqli_query($connection, "SELECT * FROM projects;");

            while ($row = mysqli_fetch_array($result)) {
                array_push($projects, new Project($row));
            }
            mysqli_close($connection);
        }
        return $projects;
    }

    public function findById($id) {
        $connection = dbCon::getConnection();

        if ($connection != null) {
            $pstm = $connection->prepare("SELECT * FROM projects WHERE id_project = ?");

            if ($pstm) {
                $pstm->bind_param("i", $id);
                $pstm->execute();
                $result = $pstm->get_result();

                if ($result->num_rows > 0) {
                    $projectData = $result->fetch_assoc();

                    $projectData = array_values($projectData);

                    return new Project($projectData);
                } else {
                    echo "Projeto não encontrado.";
                }
                $pstm->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }
            mysqli_close($connection);
        }
        return null;
    }


    // =================================== CRUD =====================================================

    // CREATE
    public function addProject(Project $project) {
        $connection = dbCon::getConnection();
    
        if ($connection != null) {
            $name = $project->getName();
            $description = $project->getDescription();
            $state = $project->getState();
            $city = $project->getCity();
            $profitability = $project->getProfitability();
            $deadline = $project->getDeadline();
            $financialGoal = $project->getFinancialGoal();
            $raisedAmount = $project->getRaisedAmount();
            $completionPercentage = $project->getCompletionPercentage();
            $updates = $project->getUpdates();

            [$dia, $mes, $ano] = explode("/",$deadline);
            
            $deadline = "$ano-$mes-$dia";

            $query = "INSERT INTO projects 
                (name, description, state, city, profitability, deadline, financial_goal, raised_amount, completion_percentage, updates) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $stmt = $connection->prepare($query);
    
            if ($stmt) {
                $stmt->bind_param(
                    "ssssssddds",
                    $name,
                    $description,
                    $state,
                    $city,
                    $profitability,
                    $deadline,
                    $financialGoal,
                    $raisedAmount,
                    $completionPercentage,
                    $updates
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
    

    
    // READ (Já está no findById)



    // UPDATE
    function editProject(Project $project) {
        $connection = dbCon::getConnection();

        if ($connection != null) {
            $projectId = $project->getId();
            $name = $project->getName();
            $description = $project->getDescription();
            $state = $project->getState();
            $city = $project->getCity();
            $profitability = $project->getProfitability();
            $deadline = $project->getDeadline();
            $financialGoal = $project->getFinancialGoal();
    
            $pstm = $connection->prepare("UPDATE projects SET name=?, description=?, state=?, city=?, profitability=?, deadline=?, financial_goal=? WHERE id_project=?");
    
            if ($pstm) {
                $pstm->bind_param("ssssdsdi", $name, $description, $state, $city, $profitability, $deadline, $financialGoal, $projectId);
                $success = $pstm->execute();
    
                if ($success) {
                    $pstm->close();
                    return true;
                } else {
                    $error = $pstm->error;
                    $pstm->close();
                    return "Erro ao editar projeto: " . $error;
                }
            } else {
                return "Erro na preparação da declaração: " . $connection->error;
            }
        }    
        return false;
    }
    



    // DELETE
    public function deleteProject(Project $project) {
        $connection = dbCon::getConnection();

        if ($connection != null) {
            $projectId = $project->getId();
            $query = "DELETE FROM projects WHERE id_project=?";

            $stmt = $connection->prepare($query);

            if ($stmt) {
                $stmt->bind_param("i", $projectId);
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

}
?>
