<!-- Contribuição -->

<?php


class Contribution {  
    private $id_contribuicao;      // Identificador único da contribuição
    private $contributionDate;     // Data da contribuição
    private $amount;               // Valor da contribuição
    private $id_user;              // Identificador único do apoiador (usuário)
    private $id_project;           // Identificador único do projeto ao qual a contribuição está vinculada

    public function __construct($array) {
        $this->id_contribuicao = $array[0];
        $this->contributionDate = $array[1];
        $this->amount = $array[2];
        $this->id_user = $array[3];
        $this->id_project = $array[4];
    }

    public function getIdContribuicao() {
        return $this->id_contribuicao;
    }

    public function getContributionDate() {
        return $this->contributionDate;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdProject() {
        return $this->id_project;
    }

    public function setIdContribuicao($id) {
        $this->id_contribuicao = $id;
    }
}

