<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verifica se a conexão foi estabelecida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $question = $_POST['question'];
    $data_envio = date('Y-m-d H:i:s');

    // Prepara e executa a inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO FAQ (email, pergunta, data_envio) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $question, $data_envio);

    if ($stmt->execute()) {
        header("Location: FAQ.php?status=enviado");
        exit();
    } else {
        echo "Erro ao enviar a pergunta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
