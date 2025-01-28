document.getElementById("lead-form").addEventListener("submit", function(event){
    event.preventDefault();

    let formData = new FormData(this);

    fetch("http://localhost:8000/salvar_lead.php", { // Ajuste conforme a hospedagem
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("SUCESSO")) {
            alert("Obrigado! Seus dados foram salvos com sucesso.");
            document.getElementById("lead-form").reset();
        } else {
            alert("Erro ao enviar. Verifique os dados e tente novamente.");
            console.error("Erro:", data);
        }
    })
    .catch(error => {
        alert("Erro ao enviar. Tente novamente.");
        console.error("Erro:", error);
    });
});