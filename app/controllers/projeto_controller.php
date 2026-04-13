<?php
include_once("../models/projeto.php");
include_once("../config/conexao.php");
header('Content-Type: application/json; charset=utf-8');

class ProjetoControle {

    public function criar() {
        $conn = Conexao::conectar();

        try {
            $conn->beginTransaction();

            // Criar projeto diretamente com o ID recebido
            $projeto = new Projeto();
            $projeto->titulo = $_POST['titulo'];
            $projeto->descricao = $_POST['descricao'];
            $projeto->objetivo = $_POST['objetivo'];
            $projeto->temas = $_POST['temas'];
            $projeto->areas = $_POST['areas'];
            $projeto->orientador_id = $_POST['orientador_id'];

            // (Opcional, mas recomendado) validar se o ID existe
            if (empty($projeto->orientador_id)) {
                throw new Exception("ID do orientador não informado");
            }

            $projeto->inserir();

            $conn->commit();

            echo json_encode([
                'success' => true,
                'message' => 'Projeto criado com sucesso'
            ]);

        } catch (Exception $e) {
            $conn->rollBack();
            http_response_code(500);

            echo json_encode([
                'success' => false,
                'message' => 'Erro ao criar projeto',
                'error'   => $e->getMessage()
            ]);
        }
    }
}

$controle = new ProjetoControle();
$acao = $_POST["acao"];

if ($acao == "criar") {
    $controle->criar();
}
?>