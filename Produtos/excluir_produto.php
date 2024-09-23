<?php
session_start(); // Inicia a sessão

// Verifica se o usuário é um administrador autenticado
if (!isset($_SESSION['autenticado_adm']) || $_SESSION['autenticado_adm'] !== true) {
    header("Location: login.php"); // Redireciona se não for um admin
    exit();
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_petshop2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID do produto foi passado via GET
if (isset($_GET['id'])) {
    $id_produto = intval($_GET['id']);

    // Excluir o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_produto);

    if ($stmt->execute()) {
        header("Location: ../principal/index.php?status=sucesso"); // Redirecionar com um parâmetro de sucesso
        exit();
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID do produto não fornecido.";
}

// Fechar a conexão
$conn->close();
?>
