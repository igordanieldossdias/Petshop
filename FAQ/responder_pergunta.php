<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verifica se o usuário é um administrador
if (!isset($_SESSION['autenticado_adm']) || !$_SESSION['autenticado_adm']) {
    die("Acesso negado. Apenas administradores podem enviar respostas.");
}

// Verifica se o ID da pergunta e a resposta foram enviados via POST
if (isset($_POST['id']) && isset($_POST['resposta'])) {
    $id = intval($_POST['id']); // Garantir que o ID seja um número inteiro
    $resposta = mysqli_real_escape_string($conn, trim($_POST['resposta'])); // Limpar a resposta

    // Atualizar a coluna 'resposta' da pergunta no banco de dados
    $query = "UPDATE FAQ SET resposta = '$resposta' WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "Resposta enviada com sucesso!";
        // Redirecionar de volta para a página de FAQ após a resposta
        header("Location: FAQ.php");
        exit();
    } else {
        echo "Erro ao enviar a resposta: " . mysqli_error($conn);
    }
} else {
    echo "Dados inválidos. Por favor, tente novamente.";
}

mysqli_close($conn); // Fechar a conexão com o banco de dados
?>
