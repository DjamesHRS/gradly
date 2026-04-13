document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formCadastro");
    const btn = document.getElementById("btnCadastrar");

    btn.addEventListener("click", (e) => {
        e.preventDefault();
        validarFormulario();
    });

    carregarLocalStorage();
});

// =============================
// 🔍 VALIDAÇÃO PRINCIPAL
// =============================
function validarFormulario() {

    let nome = document.getElementById("nome");
    let email = document.getElementById("email");
    let senha = document.getElementById("senha");
    let confirmarSenha = document.getElementById("confirmarSenha");
    let rg = document.getElementById("rg");

    let erros = [];

    // =============================
    // 🧠 VALIDAÇÕES
    // =============================

    // Nome obrigatório
    if (!nome.value.trim()) {
        erros.push("Nome é obrigatório");
        marcarErro(nome);
    } else {
        marcarSucesso(nome);
    }

    // Email válido (regex)
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email.value)) {
        erros.push("Email inválido");
        marcarErro(email);
    } else {
        marcarSucesso(email);
    }

    // Senha mínima
    if (senha.value.length < 6) {
        erros.push("Senha deve ter no mínimo 6 caracteres");
        marcarErro(senha);
    } else {
        marcarSucesso(senha);
    }

    // Confirmar senha
    if (senha.value !== confirmarSenha.value) {
        erros.push("As senhas não coincidem");
        marcarErro(confirmarSenha);
    } else {
        marcarSucesso(confirmarSenha);
    }

    // RG (somente números + tamanho)
    let regexNumero = /^[0-9]+$/;
    if (!regexNumero.test(rg.value) || rg.value.length < 7 || rg.value.length > 9) {
        erros.push("RG inválido (somente números entre 7 e 9 dígitos)");
        marcarErro(rg);
    } else {
        marcarSucesso(rg);
    }

    // =============================
    // ❌ SE TIVER ERRO
    // =============================
    if (erros.length > 0) {
        alert(erros.join("\n"));
        return;
    }

    // =============================
    // 💾 SALVAR LOCALSTORAGE
    // =============================
    salvarLocalStorage(nome.value, email.value);

    // =============================
    // 🌐 SIMULA ENVIO (FETCH)
    // =============================
    enviarDados();

    alert("Cadastro realizado com sucesso!");
}


// =============================
// 💾 LOCAL STORAGE
// =============================
function salvarLocalStorage(nome, email) {
    localStorage.setItem("nome", nome);
    localStorage.setItem("email", email);
}

function carregarLocalStorage() {
    let nome = localStorage.getItem("nome");
    let email = localStorage.getItem("email");

    if (nome) document.getElementById("nome").value = nome;
    if (email) document.getElementById("email").value = email;
}

// =============================
// 🎨 FEEDBACK VISUAL
// =============================
function marcarErro(input) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
}

function marcarSucesso(input) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
}

// =============================
// 🌐 FETCH (EXEMPLO)
// =============================
async function enviarDados() {

    const dados = {
        nome: document.getElementById("nome").value,
        email: document.getElementById("email").value
    };

    try {
        const response = await fetch("https://jsonplaceholder.typicode.com/posts", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(dados)
        });

        const result = await response.json();
        console.log("Resposta:", result);

    } catch (error) {
        console.error("Erro na requisição:", error);
    }
}