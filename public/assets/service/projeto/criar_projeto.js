import { notificarSucesso, notificarErro } from '../notificacao/notificacao.js';

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("criar_projeto")?.addEventListener("click", (e) => {
    e.preventDefault();
    criarProjeto();
  });

  document.getElementById("form_criar_projeto")?.addEventListener("submit", (e) => {
    e.preventDefault();
    criarProjeto();
  });
});

async function criarProjeto() {
  var titulo = document.getElementById("titulo").value;
  var descricao = document.getElementById("descricao").value;
  var objetivo = document.getElementById("objetivo").value;
  var temas = document.getElementById("temas").value;
  var areas = document.getElementById("areas").value;

  const fd = new FormData();
  fd.append("titulo", titulo);
  fd.append("descricao", descricao);
  fd.append("objetivo", objetivo);
  fd.append("temas", temas);
  fd.append("areas", areas);
  fd.append("acao", "criar");

  const retorno = await fetch(
    "/gradly/app/controllers/projeto_controller.php",
    {
      method: "POST",
      body: fd,
    },
  );

  const resposta = await retorno.json();
  if (resposta.success) {
    notificarSucesso(resposta.message, "dashboard_aluno.php");
  } else {
    const detalhe = resposta.error ? ": " + resposta.error : "";
    notificarErro(resposta.message + detalhe);
  }
}
