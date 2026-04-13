<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['usuario_tipo'] != 'aluno') {
    echo "Acesso negado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Grupo</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
        <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold">Gradly</a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <?php echo $_SESSION['usuario_nome']; ?>
            </span>

            <button class="btn btn-light btn-sm" id="logout">
                Sair
            </button>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Cadastrar Grupo</h4>
                </div>

                <div class="card-body">

                    <form action="cadastrar_coordenador.php" method="POST">

                        <!-- DADOS DO USUÁRIO -->
                        <h5 class="mb-3">Dados do Grupo</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome</label>
                                <input id="nome" type="text" name="nome" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Descrição</label>
                                <input id="descricao" type="text" name="descricao" class="form-control" required>
                            </div>

                        </div>

                        <hr>

                        <!-- DADOS DO COORDENADOR -->
                        <h5 class="mb-3">Adicionar Participante</h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email do Participante</label>
                                <div class="d-flex gap-2">
                                        <input id="email" type="text" name="email" class="form-control" required>
                                        <button type="button" id="adicionar" class="btn btn-primary">
                                            +
                                        </button>
                                    </div>
                            </div>
                            

                        </div>

                        <div class="d-grid mt-4">
                            <button type="button" id="cadastrar" class="btn btn-primary">
                                Cadastrar Grupo
                            </button>
                        </div>

                        <div class="d-grid mt-4">
                            <a href="dashboard_aluno.php" class="btn btn-secondary btn-lg">
                            Voltar
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="../assets/service/grupo.js"></script>
<script src="../assets/service/logout.js"></script>
</body>
</html>
