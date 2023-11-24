<!-- Acesso ao usuário no banco de dados  -->
<?php

include_once(__DIR__ . "/../config/db.php");
include_once(__DIR__ . "/../models/User.php");


class UserDAO {  
   
        public function findAll(){
        $connection = dbCon::getConnection();

        if($connection!=null){
            $result = mysqli_query ($connection, "SELECT * FROM "."users".";");
            $entidades = [];
            for ($c=0; $c<mysqli_num_rows($result); $c++){
                array_push($entidades, new User(mysqli_fetch_array($result))); 
                // Pra cada linha do resultado, criamos um objeto User passando como 
                // parametro um vetor contendo todas as colunas da linha. 
            }
        }
        return $entidades;
    }
 
        public function findByEmailAndPassword($email, $password){
        $connection = dbCon::getConnection();
        if($connection!=null){
            $pstm = $connection->prepare ("SELECT * FROM "."users where email = ? and password = ?".";");
            $pstm->bind_param("ss", $email, $password);
            $pstm->execute();
            $result = $pstm->get_result();
    
            $entidade = [];
            for ($c=0; $c<mysqli_num_rows($result);){
                return new User(mysqli_fetch_array($result));
            }
        }
        return null;
    }


    
    public function findById($id) {
        $connection = dbCon::getConnection();
        if ($connection != null) {
            $pstm = $connection->prepare("SELECT * FROM users WHERE id_user = ?");
        
            if ($pstm) {
                $pstm->bind_param("i", $id);
                $pstm->execute();
                $result = $pstm->get_result();
        
                if ($result->num_rows > 0) {
                    $userData = $result->fetch_assoc();
        
                    // Verifica se todas as chaves necessárias estão presentes no array
                    $requiredKeys = ['id_user', 'username', 'email', 'password', 'user_type', 'notification_preference'];
    
                    // Verifica se todas as chaves em $requiredKeys estão presentes em $userData
                    if (count(array_diff($requiredKeys, array_keys($userData))) === 0) {

                        $userData = array_values($userData);

                        return new User($userData);
                    } else {
                        echo "Array não contém todas as chaves necessárias.";
                    }
                } else {
                    echo "Usuário não encontrado.";
                }
                $pstm->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }
        }
        return null;
    }
    
    


 
    // ============================================== CRUD ===========================================

    public function addUser(User $user) { // CREATE
        $connection = dbCon::getConnection();
        if ($connection != null) {
            $pstm = $connection->prepare("INSERT INTO users (username, email, password, user_type, notification_preference) VALUES (?, ?, ?, ?, ?)");
            
            if ($pstm) {
                $username = $user->getName(); 
                $email = $user->getEmail();
                $password = $user->getPassword();
                $userType = $user->getUserType();
                $notification = $user->getNotification();
                
                $pstm->bind_param("sssss", $username, $email, $password, $userType, $notification);
                $success = $pstm->execute();

                if ($success) {
                    return true;
                } else {
                    echo "Erro ao adicionar usuário: " . $pstm->error;
                }
                
                $pstm->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }
        }
        return false;
    }

    // Read já está no findAll ou FindById




    public function editUser(User $user) { // UPDATE
        $connection = dbCon::getConnection();
        if ($connection != null) {
            $userId = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $userType = $user->getUserType();
            $notification = $user->getNotification();
    
            $pstm = $connection->prepare("UPDATE users SET username=?, email=?, user_type=?, notification_preference=? WHERE id_user=?");
    
            var_dump($connection);

            if ($pstm) {
                $pstm->bind_param("ssssi", $name, $email, $userType, $notification, $userId);
                $success = $pstm->execute();
    
                if ($success) {
                    return true;
                } else {
                    echo "Erro ao editar usuário: " . $pstm->error;
                }    
                $pstm->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }
        }
        return false;
    }
        


    public function deleteUser(User $user) {         // DELETE
        $connection = dbCon::getConnection();
        
        if ($connection != null) {
            $userId = $user->getId();
            $pstm = $connection->prepare("DELETE FROM users WHERE id_user = ?");
            
            if ($pstm) {
                $pstm->bind_param("i", $userId);
                $success = $pstm->execute();
    
                if ($success) {
                    return true;
                } else {
                    echo "Erro ao excluir usuário: " . $pstm->error;
                }    
                $pstm->close();
            } else {
                echo "Erro na preparação da declaração: " . $connection->error;
            }
        }    
        return false;
    }
    
  

}
?>
