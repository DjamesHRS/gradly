<?php
include_once("../models/user.php");
header('Content-Type: application/json; charset=utf-8');

class LoginControle {

    public function logar() {
        $conn = Conexao::conectar();

        try {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // Buscar usuário na tabela user
            $query = "SELECT id, nome, senha FROM user WHERE email = :email";
            $stmt = Conexao::executarComParametros($query, [':email' => $email]);
            
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                throw new Exception("Usuário não encontrado");
            }

            // Verificar senha
            if (!password_verify($senha, $usuario['senha'])) {
                throw new Exception("Senha incorreta");
            }

            $userId = $usuario['id'];
            $tipo_usuario = null;

            // Verificar em cada tabela filha
            // Verificar se é Orientador
            $queryOrientador = "SELECT id FROM orientador WHERE id = :id";
            $stmtOrientador = Conexao::executarComParametros($queryOrientador, [':id' => $userId]);
            if ($stmtOrientador->fetch()) {
                $tipo_usuario = 'orientador';
            }

            // Verificar se é Administrador
            if (!$tipo_usuario) {
                $queryAdmin = "SELECT id FROM administrador WHERE id = :id";
                $stmtAdmin = Conexao::executarComParametros($queryAdmin, [':id' => $userId]);
                if ($stmtAdmin->fetch()) {
                    $tipo_usuario = 'administrador';
                }
            }

            // Verificar se é Coordenador
            if (!$tipo_usuario) {
                $queryCoordenador = "SELECT id FROM coordenador WHERE id = :id";
                $stmtCoordenador = Conexao::executarComParametros($queryCoordenador, [':id' => $userId]);
                if ($stmtCoordenador->fetch()) {
                    $tipo_usuario = 'coordenador';
                }
            }

            // Verificar se é Aluno
            if (!$tipo_usuario) {
                $queryAluno = "SELECT id FROM aluno WHERE id = :id";
                $stmtAluno = Conexao::executarComParametros($queryAluno, [':id' => $userId]);
                if ($stmtAluno->fetch()) {
                    $tipo_usuario = 'aluno';
                }
            }

            if (!$tipo_usuario) {
                throw new Exception("Tipo de usuário não identificado");
            }

            echo json_encode([
                'success' => true,
                'message' => 'Login realizado com sucesso',
                'usuario_id' => $userId,
                'usuario_nome' => $usuario['nome'],
                'usuario_tipo' => $tipo_usuario
            ]);

        } catch (Exception $e) {
            http_response_code(401);

            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

$controle = new LoginControle();
$acao = $_POST["acao"];

if ($acao == "logar") {
    $controle->logar();
}   
?>
