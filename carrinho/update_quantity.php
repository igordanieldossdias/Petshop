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

// Verifica se o ID e a quantidade foram passados
if (isset($_POST['id']) && isset($_POST['quantidade'])) {
    $id = intval($_POST['id']);
    $quantidade = intval($_POST['quantidade']);
    $id_cliente = $_SESSION['id_cliente'];

    // Atualiza a quantidade se o item já existir no carrinho
    $sql = "SELECT * FROM carrinho WHERE id_produto = ? AND id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($nova_quantidade > 0) {
        // Atualiza a quantidade no banco de dados
        $update_sql = "UPDATE carrinho SET quantidade = ?, valor = (preco * ?) WHERE id_produto = ? AND id_cliente = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param('iiii', $nova_quantidade, $nova_quantidade, $id_produto, $id_cliente);
        $stmt->execute();
        $stmt->close();
    } else {
        // Remove o produto do carrinho se a quantidade for menor ou igual a zero
        $delete_sql = "DELETE FROM carrinho WHERE id_produto = ? AND id_cliente = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param('ii', $id_produto, $id_cliente);
        $stmt->execute();
        $stmt->close();
    }

    if ($stmt->execute()) {
        // Sucesso
        echo "Quantidade atualizada com sucesso.";
    } else {
        // Erro
        echo "Erro ao atualizar quantidade: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
