<?php
include_once("../models/user.php");
include_once("../models/orientador.php");
header('Content-Type: application/json; charset=utf-8');

class OrientadorControle {

    public function cadastrar() {
        $conn = Conexao::conectar();

        try {
            $conn->beginTransaction();

            $user = new User();
            $user->nome = $_POST['nome'];
            $user->email = $_POST['email'];
            $user->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $user->dataCadastro = $_POST['data_cadastro'];

            $userId = $user->inserir();

            $coordenador = new Orientador();
            $coordenador->id = $userId;
            $coordenador->departamento = $_POST['departamento'];
            $coordenador->instituicao = $_POST['instituicao'];

            $coordenador->inserir();

            $conn->commit();
            echo json_encode([
                'success' => true,
                'message' => 'Orientador cadastrado com sucesso',
            ]);

        } catch (Exception $e) {
            $conn->rollBack();
            http_response_code(500);

            echo json_encode([
                'success' => false,
                'message' => 'Erro ao cadastrar usuário',
                'error'   => $e->getMessage() // em produção você pode ocultar
            ]);
        }
    }
}

$controle = new OrientadorControle();
$acao = $_POST["acao"];

if ($acao == "cadastrar") {
    $controle->cadastrar();
}   
?>