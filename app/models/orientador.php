<?php

include_once("../config/conexao.php");

class Orientador {

    public $id;
    public $atuacao;
    public $titulacao;

    public function inserir() {

        try {

            $parametros = Array(
                ':id' => $this->id,
                ':atuacao' => $this->atuacao,
                ':titulacao' => $this->titulacao,
            );

            $query = "INSERT INTO orientador
                    (id, areaAtuacao, titulacao)
                    VALUES
                    (:id, :atuacao, :titulacao)";

            Conexao::executarComParametros($query, $parametros);

            return true;

        } catch (Exception $e) {
            throw new Exception("Erro ao inserir orientador: " . $e->getMessage());
        }
    }
}
?>