// script.js

// Quando o formulário é enviado...
document.getElementById("lead-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Não recarrega a página

    // Pega os dados do formulário e os elementos de feedback
    const formData = new FormData(this);
    const feedback = document.getElementById("feedback");
    const enviarBtn = document.getElementById("enviar-btn");

    // Desativa o botão para evitar cliques múltiplos e mostra que está enviando
    enviarBtn.disabled = true;
    enviarBtn.textContent = "Enviando...";

    // Faz a requisição para o seu PHP (ajuste a URL conforme sua hospedagem)
    fetch("http://localhost:8000/salvar_lead.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error("Erro na rede");
        return response.json();
    })
    .then(data => {
        // Se o status retornado for "sucesso", mostra mensagem positiva
        if (data.status === "sucesso") {
            feedback.textContent = "Obrigado! Seus dados foram salvos com sucesso.";
            feedback.style.color = "green";
            document.getElementById("lead-form").reset();
        } else {
            // Se houver erro, mostra a mensagem de erro vinda do PHP
            feedback.textContent = "Erro ao enviar: " + data.mensagem;
            feedback.style.color = "red";
        }
    })
    .catch(error => {
        feedback.textContent = "Erro ao enviar. Tente novamente.";
        feedback.style.color = "red";
        console.error("Erro:", error);
    })
    .finally(() => {
        // Reativa o botão e restaura o texto
        enviarBtn.disabled = false;
        enviarBtn.textContent = "Enviar";
    });
});
