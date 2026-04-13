<?php

include_once("../config/conexao.php");

class Projeto {

    public $id;
    public $titulo;
    public $descricao;
    public $objetivo;
    public $temas;
    public $areas;
    public $orientador_id;

    public function inserir() {

        try {

            $parametros = Array(
                ':titulo' => $this->titulo,
                ':descricao' => $this->descricao,
                ':objetivo' => $this->objetivo,
                ':temas' => $this->temas,
                ':areas' => $this->areas,
                ':orientador_id' => $this->orientador_id
            );

            $query = "INSERT INTO projeto_tcc
                    (titulo, descricao, objetivo, temas, areas, orientador_id)
                    VALUES
                    (:titulo, :descricao, :objetivo, :temas, :areas, :orientador_id)";

            Conexao::executarComParametros($query, $parametros);

            return true;

        } catch (Exception $e) {
            throw new Exception("Erro ao inserir projeto: " . $e->getMessage());
        }
    }
}
?>