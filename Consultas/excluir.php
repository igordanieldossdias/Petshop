<?php
session_start();

// Verificar se o usuário é um administrador autenticado
if (!isset($_SESSION['autenticado_adm']) || $_SESSION['autenticado_adm'] !== true) {
    header("Location: login.php"); // Redirecionar se não for um admin
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

// Verificar se o ID da consulta foi passado via GET
if (isset($_GET['id'])) {
    $id_consulta = intval($_GET['id']);

    // Excluir a consulta do banco de dados
    $sql = "DELETE FROM consultas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_consulta);

    if ($stmt->execute()) {
        echo "Consulta excluída com sucesso.";
        header("Location: consultas.php"); // Redirecionar após exclusão
        exit();
    } else {
        echo "Erro ao excluir a consulta: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID da consulta não fornecido.";
}

// Fechar a conexão
$conn->close();
?>
