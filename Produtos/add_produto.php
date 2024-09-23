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

// Adiciona o produto ao carrinho
if (isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = intval($_POST['quantidade']);

    // Recupera o preço do produto
    $sql = "SELECT preco FROM produtos WHERE id = $id_produto";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
        $preco = $produto['preco'];
        $valor_total = $preco * $quantidade;

        // Recupera o ID do cliente
        $id_cliente = $_SESSION['id_cliente'];

        // Verifica se o carrinho já existe na sessão
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        // Adiciona ou atualiza o produto no carrinho
        if (isset($_SESSION['carrinho'][$id_produto])) {
            $_SESSION['carrinho'][$id_produto]['quantidade'] += $quantidade;
            $_SESSION['carrinho'][$id_produto]['valor'] = $_SESSION['carrinho'][$id_produto]['quantidade'] * $preco;
        } else {
            $_SESSION['carrinho'][$id_produto] = array(
                'quantidade' => $quantidade,
                'valor' => $valor_total
            );
        }

        // Insere o produto no banco de dados
        $sql_insert = "INSERT INTO carrinho (id_cliente, id_produto, quantidade, valor) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("iiid", $id_cliente, $id_produto, $quantidade, $valor_total);
        $stmt->execute();
        $stmt->close();
    }
}

// Fecha a conexão
$conn->close();
?>
