<?php
$host = "localhost"; // Ou endereço do servidor
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "Lucas1401$";

// Conectar ao banco de dados
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
}

// Capturar os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Inserir no banco de dados
$query = "INSERT INTO leads (nome, email, telefone, mensagem) VALUES ('$nome', '$email', '$telefone', '$mensagem')";
$result = pg_query($conn, $query);

if ($result) {
    echo "SUCESSO";
} else {
    echo "Erro ao salvar os dados.";
}

// Fechar conexão
pg_close($conn);
?>