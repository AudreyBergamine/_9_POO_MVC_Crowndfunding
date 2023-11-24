
<?php

class Project {
    private $id_project;                    // Identificador único do projeto
    private $name;                          // Nome do projeto
    private $description;                   // Descrição do projeto
    private $state;                         // Estado do projeto
    private $city;                          // Cidade do projeto
    private $profitability;                 // Rentabilidade do projeto
    private $deadline;                      // Prazo do projeto (date)
    private $financial_goal;                // Meta financeira do projeto
    private $raised_amount;                 // Valor captado do projeto
    private $completion_percentage;         // Percentual concluído do projeto
    private $updates;                       // Atualizações do projeto

    public function __construct($array) {
        $this->id_project = $array[0];
        $this->name = $array[1];
        $this->description = $array[2];
        $this->state = $array[3];
        $this->city = $array[4];
        $this->profitability = $array[5];
        $this->deadline = $array[6];
        $this->financial_goal = $array[7];
        $this->raised_amount = isset($array[8]) ? $array[8] : 0;  // Inicializado com zero se não estiver definido
        $this->completion_percentage = isset($array[9]) ? $array[9] : 0;  // Inicializado com zero se não estiver definido
        $this->updates = isset($array[10]) ? $array[10] : " ";  // Inicializado com um espaço em branco se não estiver definido

    }

    public function getId() {
        return $this->id_project;
    }


    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getState() {
        return $this->state;
    }

    public function getCity() {
        return $this->city;
    }

    public function getProfitability() {
        return $this->profitability;
    }

    public function getDeadline() {        
        [$ano, $mes, $dia] = explode("-",$this->deadline);
        return "$dia/$mes/$ano";
    }

    public function getDeadlineEUA() {      
        return $this->deadline;
    }

    public function ConvertDataBRtoEUA($data) {
        [$dia, $mes, $ano] = explode("/",$data);
        return "$mes-$dia-$ano";
    }


    public function getFinancialGoal() {
        return $this->financial_goal;
    }

    public function getRaisedAmount() {
        return $this->raised_amount;
    }

    public function setRaisedAmount($amount) {
        $this->raised_amount = $amount;
    }

    public function getCompletionPercentage() {
        return $this->completion_percentage;
    }

    public function setCompletionPercentage($percentage) {
        $this->completion_percentage = $percentage;
    }

    public function getUpdates() {
        return $this->updates;
    }

    public function setId($id) {
        $this->id_project = $id;
    }


}
?>
