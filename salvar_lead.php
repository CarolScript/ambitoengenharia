<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Configuração do banco de dados
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "Lucas1401$";

// Criando conexão
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar conexão
if (!$conn) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro na conexão com o banco de dados."]);
    exit;
}

// Verificar se os dados foram enviados via POST
if (!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['telefone']) || !isset($_POST['mensagem'])) {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
    exit;
}

// Capturar e sanitizar os dados
$nome = htmlspecialchars($_POST['nome']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$telefone = htmlspecialchars($_POST['telefone']);
$mensagem = htmlspecialchars($_POST['mensagem']);

// Preparar e executar a query de inserção
$query = "INSERT INTO leads (nome, email, telefone, mensagem) VALUES ($1, $2, $3, $4)";
$result = pg_prepare($conn, "inserir_lead", $query);
$result = pg_execute($conn, "inserir_lead", [$nome, $email, $telefone, $mensagem]);

// Verificar se a inserção foi bem-sucedida
if ($result) {
    echo json_encode(["status" => "sucesso", "mensagem" => "Dados salvos com sucesso."]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao salvar os dados."]);
}

// Fechar conexão
pg_close($conn);
?>
