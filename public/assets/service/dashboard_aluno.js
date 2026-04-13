// Espera o carregamento da página
document.addEventListener("DOMContentLoaded", function () {
  const btnProjeto = document.getElementById("criar_projeto");
  const btnGrupo = document.getElementById("criar_grupo");

  // BOTÃO CRIAR PROJETO
  btnProjeto.addEventListener("click", function () {
    // redireciona para tela de cadastro de projeto
    window.location.href = "cadastro_projeto.html";
  });

  // BOTÃO CRIAR GRUPO
  btnGrupo.addEventListener("click", function () {
    // redireciona para tela de cadastro de grupo
    window.location.href = "cadastro_grupo.html";
  });
});
