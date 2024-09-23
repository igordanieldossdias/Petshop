<?php
session_start();

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_petshop2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID do item foi passado
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $id_cliente = $_SESSION['id_cliente'];

    // Remove o item do carrinho
    $sql = "DELETE FROM carrinho WHERE id_produto = ? AND id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id_cliente);

    if (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);
        $sql = "DELETE FROM carrinho WHERE id_cliente = $id_cliente AND id_produto = $delete_id";
        $conn->query($sql);
    } else {
        // Erro
        echo "Erro ao remover item: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
