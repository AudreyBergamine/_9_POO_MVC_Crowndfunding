<!-- Contém classes de modelo que representam entidades do banco de dados -->

<!-- Contribuição -->

<!-- Todos os atibutos dessa classe:
id, data_contribuicao, valor, recompensa_selecionada, apoiador_id, projeto_id -->

<?php

/**
 * Classe Contribution representa uma contribuição em uma plataforma de crowdfunding.
 */
class Contribution { 
    private $id_contribuicao;                    // Identificador único da contribuição
    private $contributionDate;      // Data da contribuição
    private $amount;                // Valor da contribuição
    private $selectedReward;        // Recompensa selecionada para a contribuição (Yield) ( Avaliar se vai usar)
    private $id_user;                // Identificador único do apoiador (usuário)
    private $id_project;             // Identificador único do projeto ao qual a contribuição está vinculada

    /**
     * Construtor da classe Contribution.
     * @param int $id_contribuicao - Identificador da contribuição.
     * @param string $contributionDate - Data da contribuição.
     * @param float $amount - Valor da contribuição.
     * @param string $selectedReward - Recompensa selecionada para a contribuição.
     * @param int $supporterId - Identificador único do apoiador (usuário).
     * @param int $projectId - Identificador único do projeto ao qual a contribuição está vinculada.
     */
    public function __construct($array) {
        $this->id_contribuicao = $array[0];
        $this->contributionDate = $array[1];
        $this->amount = $array[2];
        $this->selectedReward = $array[3];
        $this->id_user = $array[4];
        $this->id_project = $array[5];
    }

    /**
     * Obtém o identificador único da contribuição.
     *
     * @return int - Identificador único da contribuição.
     */
    public function getId() {
        return $this->id_contribuicao;
    }

    /**
     * Obtém a data da contribuição.
     *
     * @return string - Data da contribuição.
     */
    public function getContributionDate() {
        return $this->contributionDate;
    }

    /**
     * Obtém o valor da contribuição.
     *
     * @return float - Valor da contribuição.
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Obtém a recompensa selecionada para a contribuição.
     *
     * @return string - Recompensa selecionada para a contribuição.
     */
    public function getSelectedReward() {
        return $this->selectedReward;
    }

    /**
     * Obtém o identificador único do apoiador (usuário).
     *
     * @return int - Identificador único do apoiador (usuário).
     */
    public function getSupporterId() {
        return $this->id_user;
    }

    /**
     * Obtém o identificador único do projeto ao qual a contribuição está vinculada.
     *
     * @return int - Identificador único do projeto.
     */
    public function getProjectId() {
        return $this->id_project;
    }

    /**
     * Define o identificador único da contribuição.
     *
     * @param int $id_contribuicao - Identificador único da contribuição.
     */
    public function setId($id) {
        $this->id_contribuicao = $id;
    }
}
