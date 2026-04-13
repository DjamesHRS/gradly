<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}

if ($_SESSION['usuario_tipo'] != 'orientador') {
    echo "Acesso negado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home do Orientador</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-hover:hover {
            transform: scale(1.03);
            transition: 0.3s;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold">Gradly</a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                🧑‍💼 <?php echo $_SESSION['usuario_nome']; ?>
            </span>

            <button class="btn btn-light btn-sm" id="logout">
                Sair
            </button>
        </div>
    </div>
</nav>

<!-- CONTEÚDO -->
<div class="container mt-5">

    <h3 class="mb-4 text-center">Painel do Orientador</h3>

    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-md-4">
            <div class="card shadow text-center card-hover">
                <div class="card-body">
                    <h5 class="card-title">📚 Meus Alunos</h5>
                    <p class="card-text">Gerencie seus alunos</p>
                    <button class="btn btn-primary w-100">Acessar</button>
                </div>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="col-md-4">
            <div class="card shadow text-center card-hover">
                <div class="card-body">
                    <h5 class="card-title">📝 Trabalhos</h5>
                    <p class="card-text">Visualizar orientações</p>
                    <button class="btn btn-primary w-100">Acessar</button>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="col-md-4">
            <div class="card shadow text-center card-hover">
                <div class="card-body">
                    <h5 class="card-title">📅 Agenda</h5>
                    <p class="card-text">Gerenciar reuniões</p>
                    <button class="btn btn-primary w-100">Acessar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="../assets/service/logout.js"></script>

</body>
</html>