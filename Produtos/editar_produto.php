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

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os dados do formulário
    $id_produto = intval($_POST['id_produto']);
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $url_imagem = $_POST['url_imagem'];
    $url_imagem2 = $_POST['url_imagem2'];

    // Montar a SQL para atualizar os dados
    $sql = "UPDATE produtos SET nome = ?, preco = ?, descricao = ?, url_imagem = ?, url_imagem2 = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsssi", $nome, $preco, $descricao, $url_imagem, $url_imagem2, $id_produto);

    if ($stmt->execute()) {
        header("Location: produto.php?id=$id_produto&status=editado");
        exit();
    } else {
        echo "Erro ao atualizar o produto: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
