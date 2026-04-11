document.getElementById("logar").addEventListener("click", (e) =>{
    e.preventDefault();
    logar();
})

async function logar(){
    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;

    const fd = new FormData();
    fd.append('email', email);
    fd.append('senha', senha);
    fd.append('acao', 'logar');

    const retorno = await fetch("/gradly/app/controllers/login_controller.php",{
        method: "POST",
        body: fd
    });

    const resposta = await retorno.json();
    
    if(resposta.success){
        alert("Bem-vindo! " + resposta.message);
        
        // Armazenar dados do usuário na sessão/localStorage
        localStorage.setItem('usuario_id', resposta.usuario_id);
        localStorage.setItem('usuario_tipo', resposta.usuario_tipo);
        localStorage.setItem('usuario_nome', resposta.usuario_nome);
        
        // Redirecionar baseado no tipo de usuário
        switch(resposta.usuario_tipo){
            case 'orientador':
                window.location.href = "home_orientador.html";
                break;
            case 'administrador':
                window.location.href = "home_admin.html";
                break;
            case 'coordenador':
                window.location.href = "home_coordenador.html";
                break;
            case 'aluno':
                window.location.href = "home_aluno.html";
                break;
            default:
                alert("Tipo de usuário inválido");
        }
    }else{
        alert("Erro! " + resposta.message);
    }
}
