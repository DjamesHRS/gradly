import { notificarErro, notificarSucesso } from "../notificacao/notificacao.js";

document.getElementById("enviar_edicao").addEventListener("click", async (e) => {
    e.preventDefault();

    const fd = new FormData();
    fd.append('usuario_id', new URLSearchParams(window.location.search).get('id'));
    fd.append('nome', document.getElementById("input-nome").value);
    fd.append('email', document.getElementById("input-email").value);
    fd.append('matricula', document.getElementById("input-matricula").value);
    fd.append('curso', document.getElementById("select-curso").value);
    fd.append('acao', 'editarAluno');

    const retorno = await fetch('/gradly/app/controllers/aluno_controller.php', {
        method: 'POST',
        body: fd
    });

    const resposta = await retorno.json();
    if (resposta.success) {
        localStorage.setItem("usuario_nome", document.getElementById("input-nome").value);
        notificarSucesso(resposta.message);
        setTimeout(() => window.location.reload(), 1500);
    } else {
        notificarErro(resposta.message);
    }
});
