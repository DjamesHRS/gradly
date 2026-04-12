document.getElementById("cadastrarOrientador").addEventListener("click", (e) =>{
    e.preventDefault();
    cadastrar();
})

async function cadastrar(){
    var nome = document.getElementById('nome').value;
    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;
    var data_cadastro = new Date().toISOString().slice(0, 19).replace('T', ' ');
    var atuacao = document.getElementById('atuacao').value;
    var titulacao = document.getElementById('titulacao').value;

        if (!nome || !email || !senha || !atuacao || !titulacao) {
            console.error("Algum input não foi encontrado no DOM");
            return;
        }


    const fd = new FormData();
    fd.append('nome', nome);
    fd.append('email', email);
    fd.append('senha', senha);
    fd.append('data_cadastro', data_cadastro);
    fd.append('atuacao', atuacao);
    fd.append('titulacao', titulacao);
    fd.append('acao', 'cadastrar');

    const retorno = await fetch("/gradly/app/controllers/orientador_controller.php",{
        method: "POST",
        body: fd
    });

    const resposta = await retorno.json();
        if(resposta.success){
            alert("Sucesso! " + resposta.message);
            window.location.href = "login.html";
        }else{
            alert("Erro! " + resposta.message);
        }


}