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

// Recupera o ID do cliente
$id_cliente = $_SESSION['id_cliente'];

// Função para remover item do carrinho
if (isset($_GET['remover_id'])) {
    $id_produto = $_GET['remover_id'];
    $sql_remover = "DELETE FROM carrinho WHERE id_cliente = $id_cliente AND id_produto = $id_produto";
    $conn->query($sql_remover);
}

// Função para atualizar a quantidade de um item no carrinho
if (isset($_POST['atualizar_quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $nova_quantidade = $_POST['quantidade'];

    // Verifica se a quantidade é válida
    if ($nova_quantidade > 0) {
        // Remove todas as entradas do produto para o cliente
        $sql_remover_todos = "DELETE FROM carrinho WHERE id_cliente = $id_cliente AND id_produto = $id_produto";
        $conn->query($sql_remover_todos);

        // Insere uma nova linha com a quantidade atualizada
        $sql_inserir = "INSERT INTO carrinho (id_cliente, id_produto, quantidade) VALUES ($id_cliente, $id_produto, $nova_quantidade)";
        $conn->query($sql_inserir);
    } else {
        // Se a quantidade for 0 ou menor, remove o produto
        $sql_remover = "DELETE FROM carrinho WHERE id_cliente = $id_cliente AND id_produto = $id_produto";
        $conn->query($sql_remover);
    }
}

// Busca os produtos no carrinho, agrupando por ID do produto
$sql = "SELECT c.id_produto, SUM(c.quantidade) as quantidade, p.nome, p.preco, p.url_imagem 
        FROM carrinho c
        JOIN produtos p ON c.id_produto = p.id
        WHERE c.id_cliente = $id_cliente
        GROUP BY c.id_produto";
$result = $conn->query($sql);

$carregouProdutos = false;

if ($result->num_rows > 0) {
    $carregouProdutos = true;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Carrinho de Compras</title>
    <style>
        .back {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back:hover {
            background-color: #c82333;
        }

        .remove-btn {
            background-color: #ff0000;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .update-btn {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Estilos do modal */
        .modal {
            display: none; /* Oculto por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>

<div class="cart-container">
    <h1>Carrinho de Compras</h1>

    <?php if ($carregouProdutos): ?>
        <?php
        $total = 0;
        while ($produto = $result->fetch_assoc()): 
            $quantidade = $produto['quantidade'];
            $subtotal = $produto['preco'] * $quantidade;
            $total += $subtotal;
        ?>
            <div class="cart-item">
                <img src="<?php echo htmlspecialchars($produto['url_imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                <div class="cart-item-details">
                    <div class="cart-item-title"><?php echo htmlspecialchars($produto['nome']); ?></div>
                    <div class="cart-item-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></div>
                    <div class="cart-item-quantity">Quantidade: <?php echo htmlspecialchars($quantidade); ?></div>
                    <div class="cart-item-price">Subtotal: R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></div>
                    <a href="?remover_id=<?php echo $produto['id_produto']; ?>" class="remove-btn">Remover</a>
                    <button class="update-btn" onclick="openModal(<?php echo $produto['id_produto']; ?>, <?php echo $quantidade; ?>)">Modificar Quantidade</button>
                </div>
            </div>
        <?php endwhile; ?>

        <div class="cart-summary">
            <strong>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></strong>
        </div>

        <a href="checkout.php" class="checkout-btn">Finalizar Compra</a>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>

<!-- Modal para modificar a quantidade -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Modificar Quantidade</h2>
        <form method="POST" action="">
            <input type="hidden" name="id_produto" id="id_produto">
            <label for="quantidade">Nova Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" min="1" required>
            <button type="submit" name="atualizar_quantidade" class="update-btn">Atualizar</button>
        </form>
    </div>
</div>

<script>
    // Função para abrir o modal
    function openModal(idProduto, quantidadeAtual) {
        document.getElementById('id_produto').value = idProduto;
        document.getElementById('quantidade').value = quantidadeAtual;
        document.getElementById('modal').style.display = "block";
    }

    // Função para fechar o modal
    function closeModal() {
        document.getElementById('modal').style.display = "none";
    }

    // Fechar o modal clicando fora dele
    window.onclick = function(event) {
        if (event.target == document.getElementById('modal')) {
            closeModal();
        }
    }
</script>

</body>
</html>
