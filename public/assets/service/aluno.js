document.getElementById("cadastrar").addEventListener("click", (e) =>{
    e.preventDefault();
    cadastrar();
})

async function cadastrar(){
    var nome = document.getElementById('nome').value;
    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;
    var data_cadastro = new Date().toISOString().slice(0, 19).replace('T', ' ');
    var matricula = document.getElementById('matricula').value;
    var curso = document.getElementById('curso').value;

    const fd = new FormData();
    fd.append('nome', nome);
    fd.append('email', email);
    fd.append('senha', senha);
    fd.append('data_cadastro', data_cadastro);
    fd.append('matricula', matricula);
    fd.append('curso', curso);
    fd.append('acao', 'cadastrar');

    const retorno = await fetch("/gradly/app/controllers/aluno_controller.php",{
        method: "POST",
        body: fd
    });

    const resposta = await retorno.json();
        if(resposta.success){
            alert("Sucesso! " + resposta.message);
            window.location.href = "index.html";
        }else{
            alert("Erro! " + resposta.message);
        }


}