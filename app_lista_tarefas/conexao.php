<?php

class Conexao {

    private $host = 'localhost';
    private $dbname = 'php_com_pdo';
    private $user = 'root';
    private $pass = '';


    public function conectar() {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass",
            );
            return $conexao;
        } 
        catch(PDOException $e) { //caso de algum erro na conexão com o banco de dados
            echo '<p>'.$e->getMessage().'</p>';
        }
    }
}
?>