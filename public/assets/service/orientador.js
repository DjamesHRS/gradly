document.getElementById("cadastrar").addEventListener("click", (e) =>{
    e.preventDefault();
    cadastrar();
})

async function cadastrar(){
    var nome = document.getElementById('nome').value;
    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;
    var data_cadastro = new Date().toISOString().slice(0, 19).replace('T', ' ');
    var departamento = document.getElementById('departamento').value;
    var instituicao = document.getElementById('instituicao').value;

    const fd = new FormData();
    fd.append('nome', nome);
    fd.append('email', email);
    fd.append('senha', senha);
    fd.append('data_cadastro', data_cadastro);
    fd.append('departamento', departamento);
    fd.append('instituicao', instituicao);
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