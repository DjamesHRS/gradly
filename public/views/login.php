<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Login</h4>
                </div>

                <div class="card-body">

                    <form>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input id="senha" type="password" name="senha" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <p>Novo por aqui? <a href="../views/tipo_usuario.php">Cadastre-se</a>!</p>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" id="logar" class="btn btn-primary">
                                Entrar
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="../assets/service/login.js"></script>
</body>
</html>
