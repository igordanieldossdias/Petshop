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

<?php if (isset($_GET['status']) && $_GET['status'] === 'sucesso') { ?>
    <div class="alert alert-success">Produto excluído com sucesso!</div>
<?php } ?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="produto.css">
    <style>
        /* Seu estilo existente */
        
        /* Estilo para o pop-up de edição e exclusão */
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

        .popup-header {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .popup-buttons {
            margin-top: 10px;
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

<!-- Pop-up de edição do produto -->
<div id="edit-popup" class="edit-popup">
    <div class="popup-header">Editar Produto</div>
    <form id="edit-product-form">
        <label for="edit-name">Nome:</label>
        <input type="text" id="edit-name" name="edit-name" value="<?php echo htmlspecialchars($produto['nome']); ?>"><br>

        <label for="edit-price">Preço:</label>
        <input type="text" id="edit-price" name="edit-price" value="<?php echo number_format($produto['preco'], 2, ',', '.'); ?>"><br>

        <label for="edit-description">Descrição:</label>
        <textarea id="edit-description" name="edit-description"><?php echo htmlspecialchars($produto['descricao']); ?></textarea><br>

        <div class="popup-buttons">
            <button type="button" onclick="submitEditForm()">Salvar</button>
            <button type="button" onclick="closeEditPopup()">Cancelar</button>
        </div>
    </form>
</div>

<!-- Pop-up de confirmação para excluir -->
<div id="confirm-popup" class="confirm-popup">
    <h3>Tem certeza que deseja excluir este produto?</h3>
    <button onclick="confirmDelete()">Sim, excluir</button>
    <button onclick="closeConfirmPopup()">Cancelar</button>
</div>

<script>
    // Preço inicial do produto
    let price = <?php echo $produto['preco']; ?>;

    // Função para aumentar a quantidade de itens
    function increaseQuantity() {
        let quantity = document.getElementById('quantity');
        quantity.value = parseInt(quantity.value) + 1;
        updatePrice();
    }

    // Função para diminuir a quantidade de itens
    function decreaseQuantity() {
        let quantity = document.getElementById('quantity');
        if (quantity.value > 1) {
            quantity.value = parseInt(quantity.value) - 1;
            updatePrice();
        }
    }

    // Função para atualizar o preço total de acordo com a quantidade
    function updatePrice() {
        let quantity = document.getElementById('quantity').value;
        let totalPrice = price * quantity;
        document.getElementById('product-price').textContent = 'R$ ' + totalPrice.toFixed(2).replace('.', ',');
    }

    // Função para adicionar o produto ao carrinho
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

    // Função para abrir pop-up de edição
    function openEditPopup() {
        document.getElementById('edit-popup').classList.add('active');
    }

    // Função para fechar pop-up de edição
    function closeEditPopup() {
        document.getElementById('edit-popup').classList.remove('active');
    }

    // Função para enviar o formulário de edição
    function submitEditForm() {
        let name = document.getElementById('edit-name').value;
        let price = document.getElementById('edit-price').value.replace(',', '.');
        let description = document.getElementById('edit-description').value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'editar_produto.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Produto atualizado com sucesso!');
                location.reload(); // Recarrega a página após a atualização
            }
        };
        xhr.send('id_produto=<?php echo $id_produto; ?>&nome=' + encodeURIComponent(name) + '&preco=' + encodeURIComponent(price) + '&descricao=' + encodeURIComponent(description));
    }

    // Função para abrir pop-up de confirmação de exclusão
    function openConfirmPopup() {
        document.getElementById('confirm-popup').classList.add('active');
    }

    // Função para fechar pop-up de confirmação
    function closeConfirmPopup() {
        document.getElementById('confirm-popup').classList.remove('active');
    }

    // Função para confirmar exclusão e redirecionar
    function confirmDelete() {
        window.location.href = 'excluir_produto.php?id=<?php echo $id_produto; ?>';
    }
</script>

</body>
</html>
