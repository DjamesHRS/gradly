<?php
include_once("../models/grupo.php");
include_once("../models/projeto.php");
header('Content-Type: application/json; charset=utf-8');

class GrupoControle {

    public function adicionar() {
        $email = $_POST['email'];

        $parametros = [
            ":email" => $email
        ];

        $query = "SELECT aluno.id 
              FROM aluno
              JOIN user ON aluno.id = user.id
              WHERE user.email = :email";

        $resultado = Conexao::executarComParametros($query, $parametros)->fetch();;
        
        if ($resultado) {

        $alunoId = $resultado['id'];

        echo json_encode([
            'success' => true,
            'message' => 'Aluno encontrado',
            'aluno_id' => $alunoId
        ]);
        } else {

        echo json_encode([
            'success' => false,
            'message' => 'Email não encontrado'
        ]);
    }
    }

    public function cadastrar() {
        $conn = Conexao::conectar();

        try {
            $conn->beginTransaction();

            $grupo = new Grupo();
            $grupo->nome = $_POST['nome'];
            $grupo->descricao = $_POST['descricao'];
            $grupo->participantes = $_POST['participantes'];
            

            $grupoId = $grupo->inserir();


            $participantes = json_decode($_POST['participantes'], true);

            foreach ($participantes as $alunoId) {

                $query = "UPDATE aluno SET grupo_id = :grupo_id WHERE id = :id";

                $parametros = [
                    ':grupo_id' => $grupoId,
                    ':id' => $alunoId
                ];

                Conexao::executarComParametros($query, $parametros);
            }

            
            $conn->commit();
            echo json_encode([
                'success' => true,
                'message' => 'Grupo criado com sucesso',
            ]);

        } catch (Exception $e) {
            $conn->rollBack();
            http_response_code(500);

            echo json_encode([
                'success' => false,
                'message' => 'Erro ao criar grupo',
                'error'   => $e->getMessage() // em produção você pode ocultar
            ]);
        }
    }
}

$controle = new GrupoControle();
$acao = $_POST["acao"];

if ($acao == "cadastrar") {
    $controle->cadastrar();
}  else if ($acao == "adicionar") {
    $controle->adicionar();
}
?>