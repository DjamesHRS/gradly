document.getElementById("criar_projeto").addEventListener("click", (e) => {
  e.preventDefault();
  criarProjeto();
});

async function criarProjeto() {
  var titulo = document.getElementById("titulo").value;
  var descricao = document.getElementById("descricao").value;
  var objetivo = document.getElementById("objetivo").value;
  var temas = document.getElementById("temas").value;
  var areas = document.getElementById("areas").value;
  var orientador_id = document.getElementById("orientador_id").value;

  const fd = new FormData();
  fd.append("titulo", titulo);
  fd.append("descricao", descricao);
  fd.append("objetivo", objetivo);
  fd.append("temas", temas);
  fd.append("areas", areas);
  fd.append("orientador_id", orientador_id);
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
    alert("Sucesso! " + resposta.message);
    window.location.href = "dashboard_aluno.html";
  } else {
    alert("Erro! " + resposta.message);
  }
}
