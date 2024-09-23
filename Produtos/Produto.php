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

// Pegar o ID do produto
$id_produto = intval($_GET['id']);

// Busca os detalhes do produto
$sql = "SELECT * FROM produtos WHERE id = $id_produto";
$result = $conn->query($sql);

// Verifica se encontrou o produto
if ($result->num_rows > 0) {
    $produto = $result->fetch_assoc();
} else {
    echo "Produto não encontrado.";
    exit();
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="produto.css">
    <style>
        /* Seu estilo existente */
        
        /* Estilo para o pop-up de edição */
        .edit-popup, .confirm-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 2px solid #28a745;
            z-index: 1000;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .edit-popup.active, .confirm-popup.active {
            display: block;
        }
    </style>
</head>
<body>

<button class="back" onclick="history.back()">Voltar</button>

<div class="product-container">
    <div class="product-image">
        <img src="<?php echo htmlspecialchars($produto['url_imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
    </div>

    <div class="product-details">
        <h1 class="product-title"><?php echo htmlspecialchars($produto['nome']); ?></h1>
        <p class="product-price" id="product-price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
        <p class="product-description"><?php echo htmlspecialchars($produto['descricao']); ?></p>

        <?php if (isset($_SESSION['autenticado_adm']) && $_SESSION['autenticado_adm'] === true) { ?>
            <button onclick="openEditPopup()">Editar Produto</button>
            <button onclick="openConfirmPopup()">Excluir Produto</button>
        <?php } else { ?>
            <div class="quantity-btn">
                <button onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1" readonly style="width: 50px; text-align: center;">
                <button onclick="increaseQuantity()">+</button>
            </div>
            <button class="add-to-cart-btn" onclick="addToCart()">Adicionar ao Carrinho</button>
        <?php } ?>
    </div>
</div>

<!-- Pop-up de edição -->
<div id="edit-popup" class="edit-popup">
    <h3>Editar Produto</h3>
    <form id="edit-form" method="post" action="editar_produto.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required><br><br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br><br>

        <label for="url_imagem">URL da Imagem 1:</label>
        <input type="text" name="url_imagem" value="<?php echo htmlspecialchars($produto['url_imagem']); ?>" required><br><br>

        <label for="url_imagem2">URL da Imagem 2:</label>
        <input type="text" name="url_imagem2" value="<?php echo htmlspecialchars($produto['url_imagem2']); ?>"><br><br>

        <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
        <button type="submit">Salvar Alterações</button>
        <button type="button" onclick="closeEditPopup()">Cancelar</button>
    </form>
</div>  

<!-- Pop-up de confirmação para excluir -->
<div id="confirm-popup" class="confirm-popup">
    <h3>Tem certeza que deseja excluir este produto?</h3>
    <button onclick="confirmDelete()">Sim, excluir</button>
    <button onclick="closeConfirmPopup()">Cancelar</button>
</div>

<script>
    let price = <?php echo $produto['preco']; ?>;

    function increaseQuantity() {
        let quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
        updatePrice();
    }

    function decreaseQuantity() {
        let quantity = document.getElementById('quantity');
        if (quantity.value > 1) {
            quantity.value = parseInt(quantity.value) - 1;
            updatePrice();
        }
    }

    function updatePrice() {
        let quantity = document.getElementById('quantity').value;
        let totalPrice = price * quantity;
        document.getElementById('product-price').textContent = 'R$ ' + totalPrice.toFixed(2).replace('.', ',');
    }

    function addToCart() {
        let quantity = document.getElementById('quantity').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_produto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Produto adicionado ao carrinho!');
            }
        };
        xhr.send('id_produto=<?php echo $id_produto; ?>&quantidade=' + quantity);
    }

    // Funções para o pop-up de edição
    function openEditPopup() {
        document.getElementById('edit-popup').classList.add('active');
    }

    function closeEditPopup() {
        document.getElementById('edit-popup').classList.remove('active');
    }

    // Funções para o pop-up de confirmação de exclusão
    function openConfirmPopup() {
        document.getElementById('confirm-popup').classList.add('active');
    }

    function closeConfirmPopup() {
        document.getElementById('confirm-popup').classList.remove('active');
    }

    function confirmDelete() {
        window.location.href = 'excluir_produto.php?id=<?php echo $id_produto; ?>';
    }
</script>

</body>
</html>
