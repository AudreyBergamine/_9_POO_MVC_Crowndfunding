<!-- Todos os atributos:
id, nome, email, senha, tipo_usuario, notificacao -->

<?php

// Diretório do meu User.php: C:\wamp64\www\_9_POO_MVC_Crowndfunding\models\User.php

/**
 * Classe User representa um usuário no contexto de uma plataforma de crowdfunding.
 */
class User {
    private $id_user;        // Identificador único do usuário
    private $name;          // Nome do usuário
    private $email;         // Endereço de e-mail do usuário
    private $password;      // Senha do usuário
    private $userType;      // Tipo de usuário
    private $notification;  // Configuração de notificação do usuário

    /**
     * Construtor da classe User.
     * @param int $id_user - Identificador do usuário.
     * @param string $name - Nome do usuário.
     * @param string $email - Endereço de e-mail do usuário.
     * @param string $password - Senha do usuário.
     * @param string $userType - Tipo de usuário.
     * @param string $notification - Configuração de notificação do usuário.
     */
    public function __construct($array) {


        $this->id_user = $array[0];
        $this->name = $array[1];
        $this->email = $array[2];
        $this->password = isset($array[5]) ? $array[3] : '';
        $this->userType = isset($array[5]) ? $array[4] : $array[3];
        $this->notification = isset($array[5]) ? $array[5] : $array[4];
    }

    /**
     * Obtém o identificador único do usuário.
     *
     * @return int - Identificador único do usuário.
     */
    public function getId() {
        return $this->id_user;
    }

    /**
     * Obtém o nome do usuário.
     *
     * @return string - Nome do usuário.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Obtém o endereço de e-mail do usuário.
     *
     * @return string - Endereço de e-mail do usuário.
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Obtém a senha do usuário.
     *
     * @return string - Senha do usuário.
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Obtém o tipo de usuário.
     *
     * @return string - Tipo de usuário.
     */
    public function getUserType() {
        return $this->userType;
    }

    /**
     * Obtém a configuração de notificação do usuário.
     *
     * @return string - Configuração de notificação do usuário.
     */
    public function getNotification() {
        return $this->notification;
    }

    /**
     * Define o identificador único do usuário.
     *
     * @param int $id_user - Identificador único do usuário.
     */
    public function setId($id) {
        $this->id_user = $id;
    }

    // Outros métodos conforme necessário

}

