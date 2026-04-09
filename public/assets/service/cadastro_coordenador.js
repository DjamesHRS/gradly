document.getElementById("enviar").addEventListener("click", function () {
        const nome = document.querySelector('input[placeholder="Digite o nome"]').value;
        const cpf = document.querySelector('input[placeholder="000.000.000-00"]').value;
        const email = document.querySelector('input[type="email"]').value;
        const telefone = document.querySelector('input[type="tel"]').value;
        const curso = document.querySelector('select').value;
        const senha = document.querySelectorAll('input[type="password"]')[0].value;

        // Criando objeto
        const coordenador = {nome, cpf, email, telefone, curso, senha};

        // Recupera lista existente ou cria nova
        let coordenadores = JSON.parse(localStorage.getItem("coordenadores")) || [];

        // Adiciona novo
        coordenadores.push(coordenador);

        // Salva
        localStorage.setItem("coordenadores", JSON.stringify(coordenadores));

        // Feedback
        alert("Coordenador cadastrado com sucesso!");
});


document.getElementById("salvar").addEventListener("click", () =>{
    var pergunta = document.getElementById("pergunta").value;

    var lista = [
        {valor: "1", texto: "Certo"},
        {valor: "2", texto: "Errado"}
    ];

    lista.forEach(
        (item, index) => {
            if(pergunta == item.valor){
                alert("certo");
                pass;
            }else{
                alert("errado");
                pass;
            }
        }
    )
})