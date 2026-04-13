<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Tipo de Usuário</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Escolha seu Perfil</h4>
                </div>

                <div class="card-body text-center">

                    <p class="mb-4">Selecione o tipo de usuário para continuar o cadastro</p>

                    <div class="d-grid gap-3">

                        <button onclick="redirecionar('aluno')" class="btn btn-outline-primary btn-lg">
                            Aluno
                        </button>

                        <button onclick="redirecionar('orientador')" class="btn btn-outline-success btn-lg">
                            Orientador
                        </button>

                        <button onclick="redirecionar('coordenador')" class="btn btn-outline-dark btn-lg">
                            Coordenador
                        </button>
                        <div class="d-grid mt-4">
                            <a href="login.php" class="btn btn-secondary btn-lg">
                            Voltar
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    function redirecionar(tipo) {
        if (tipo === 'aluno') {
            window.location.href = 'cadastro_aluno.php';
        } 
        else if (tipo === 'orientador') {
            window.location.href = 'cadastro_orientador.php';
        } 
        else if (tipo === 'coordenador') {
            window.location.href = 'cadastro_coordenador.php';
        }
    }
</script>

</body>
</html>