<?php

include_once("../config/conexao.php");

class Grupo {

    public $id;
    public $nome;
    public $descricao;

    public function inserir() {

        try {

            $parametros = Array(
                ':id' => $this->id,
                ':nome' => $this->nome,
                ':descricao' => $this->descricao,
            );

            $query = "INSERT INTO grupo
                    (id, nome, descricao, dataCriacao)
                    VALUES
                    (:id, :nome, :descricao, NOW())";

            Conexao::executarComParametros($query, $parametros);

            return Conexao::conectar()->lastInsertId();

        } catch (Exception $e) {
            throw new Exception("Erro ao inserir coordenador: " . $e->getMessage());
        }
    }
}
?>