<?php

include_once("../config/conexao.php");

class orientador {

    public $id;
    public $departamento;
    public $instituicao;

    public function inserir() {

        try {

            $parametros = Array(
                ':id' => $this->id,
                ':departamento' => $this->departamento,
                ':instituicao' => $this->instituicao,
            );

            $query = "INSERT INTO orientador
                    (id, departamento, instituicao_id)
                    VALUES
                    (:id, :departamento, :instituicao)";

            Conexao::executarComParametros($query, $parametros);

            return true;

        } catch (Exception $e) {
            throw new Exception("Erro ao inserir orientador: " . $e->getMessage());
        }
    }
}
?>