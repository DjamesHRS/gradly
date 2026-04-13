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
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Criar Projeto</title>

    <!-- Bootstrap 5 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
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
              <h4>Criar Projeto</h4>
            </div>

            <div class="card-body">
              <form action="criar_projeto.php" method="POST">
                <!-- DADOS DO PROJETO -->
                <h5 class="mb-3">Dados do Projeto</h5>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Título</label>
                    <input
                      id="titulo"
                      type="text"
                      name="titulo"
                      class="form-control"
                      required
                    />
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea
                      id="descricao"
                      name="descricao"
                      class="form-control"
                      rows="3"
                      required
                    ></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Objetivo</label>
                    <textarea
                      id="objetivo"
                      name="objetivo"
                      class="form-control"
                      rows="2"
                      required
                    ></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Temas</label>
                    <input
                      id="temas"
                      type="text"
                      name="temas"
                      class="form-control"
                      required
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Áreas</label>
                    <input
                      id="areas"
                      type="text"
                      name="areas"
                      class="form-control"
                      required
                    />
                  </div>
                </div>

                <hr />

                <!-- DADOS DO ORIENTADOR -->
                <h5 class="mb-3">Orientador</h5>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">ID do Orientador</label>
                    <input
                      type="text"
                      id="orientador_id"
                      name="orientador_id"
                      class="form-control"
                      required
                    />
                  </div>
                </div>

                <div class="d-grid mt-4">
                  <button
                    type="button"
                    id="criar_projeto"
                    class="btn btn-primary"
                  >
                    Criar Projeto
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/service/projeto.js"></script>
<script src="../assets/service/logout.js"></script>
  </body>
</html>
