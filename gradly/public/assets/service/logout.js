document.getElementById("logout").addEventListener("click", (e) =>{
    e.preventDefault();
    logout();
})

async function logout() {
    await fetch("/gradly/app/controllers/login_controller.php", {
        method: "POST",
        body: new URLSearchParams({ acao: "logout" })
    });

    window.location.href = "login.html";
}