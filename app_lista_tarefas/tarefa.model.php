<?php
 class Tarefa {

    private $id;
    private $id_status;
    private $tarefa;
    private $data_cadastro;

    public function __get($attribute) {
        return $this->$attribute;
    }

    public function __set($attribute, $valor) {
        $this->$attribute = $valor;
    }
 }

?>