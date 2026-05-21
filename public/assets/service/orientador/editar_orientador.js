import { notificarErro, notificarSucesso } from "../notificacao/notificacao.js";

document
  .getElementById("enviar_edicao")
  .addEventListener("click", async (e) => {
    e.preventDefault();

    const fd = new FormData();

    fd.append(
      "usuario_id",
      new URLSearchParams(window.location.search).get("id"),
    );

    fd.append("nome", document.getElementById("input-nome").value);

    fd.append("email", document.getElementById("input-email").value);

    fd.append("areaAtuacao", document.getElementById("input-area").value);

    fd.append("titulacao", document.getElementById("input-titulacao").value);

    fd.append("acao", "editarOrientador");

    try {
      const retorno = await fetch(
        "/gradly/app/controllers/orientador_controller.php",
        {
          method: "POST",
          body: fd,
        },
      );

      const resposta = await retorno.json();

      if (resposta.success) {
        const novoNome = document.getElementById("input-nome").value;

        localStorage.setItem("usuario_nome", novoNome);

        notificarSucesso(resposta.message);
      } else {
        notificarErro(resposta.message);

        console.log(resposta.error);
      }
    } catch (error) {
      console.error(error);

      notificarErro("Erro ao editar orientador");
    }
  });
