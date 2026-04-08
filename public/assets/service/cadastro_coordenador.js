document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formCoordenador");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // evita recarregar a página

        // Capturando valores
        const nome = document.querySelector('input[placeholder="Digite o nome"]').value;
        const cpf = document.querySelector('input[placeholder="000.000.000-00"]').value;
        const email = document.querySelector('input[type="email"]').value;
        const telefone = document.querySelector('input[type="tel"]').value;
        const curso = document.querySelector('select').value;
        const senha = document.querySelectorAll('input[type="password"]')[0].value;

        // Criando objeto
        const coordenador = {
            nome,
            cpf,
            email,
            telefone,
            curso,
            senha
        };

        // Recupera lista existente ou cria nova
        let coordenadores = JSON.parse(localStorage.getItem("coordenadores")) || [];

        // Adiciona novo coordenador
        coordenadores.push(coordenador);

        // Salva no localStorage
        localStorage.setItem("coordenadores", JSON.stringify(coordenadores));

        // Feedback
        alert("Coordenador cadastrado com sucesso!");

        // Limpa o formulário
        form.reset();
    });
});