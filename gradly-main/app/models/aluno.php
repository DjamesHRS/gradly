<?php

include_once("../config/conexao.php");

class Aluno {

    public $id;
    public $matricula;
    public $curso;

    public function inserir() {

        try {

            $parametros = Array(
                ':id' => $this->id,
                ':matricula' => $this->matricula,
                ':curso' => $this->curso,
            );

            $query = "INSERT INTO aluno
                    (id, matricula, curso)
                    VALUES
                    (:id, :matricula, :curso)";

            Conexao::executarComParametros($query, $parametros);

            return true;

        } catch (Exception $e) {
            throw new Exception("Erro ao inserir aluno: " . $e->getMessage());
        }
    }
}
?>