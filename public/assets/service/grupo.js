document.getElementById("cadastrar").addEventListener("click", (e) =>{
    e.preventDefault();
    cadastrar();
})

document.getElementById("adicionar").addEventListener("click", (e) =>{
    
    adicionar();
})

const participantesID = [];
async function adicionar(){
    var email = document.getElementById('email').value;

    const fd = new FormData();
    fd.append('email', email);
    fd.append('acao', 'adicionar');

    const retorno = await fetch("/gradly/app/controllers/grupo_controller.php",{
        method: "POST",
        body: fd
    }); 

    const resposta = await retorno.json();
        if(resposta.success){
            alert("Sucesso! " + resposta.message);
            participantesID.push(resposta.aluno_id);
            document.getElementById('email').value = "";            
        } else{
            alert("Erro! " + resposta.message);
        }
}

async function cadastrar(){
    var nome = document.getElementById('nome').value;
    var descricao = document.getElementById('descricao').value;
    var projeto = document.getElementById('projeto').value;
    var participantes = JSON.stringify(participantesID);

    const fd = new FormData();
    fd.append('nome', nome);
    fd.append('descricao', descricao);
    fd.append('participantes', participantes);
    fd.append('projeto', projeto);
    fd.append('acao', 'cadastrar');

    const retorno = await fetch("/gradly/app/controllers/grupo_controller.php",{
        method: "POST",
        body: fd
    });

    const resposta = await retorno.json();
        if(resposta.success){
            alert("Sucesso! " + resposta.message);
            window.location.href = "dashboard_aluno.html";
        }else{
            alert("Erro! " + resposta.message);
        }


}