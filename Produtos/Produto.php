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
    
    body {
    font-family: Arial, sans-serif;
    background-image: url('fundo.png'); /* Adicionando a imagem de fundo */
    background-size: cover;
    background-position: center;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.product-container {
    background-color: rgba(255, 255, 255, 0.9); /* Fundo branco com transparência */
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    display: flex;
    max-width: 1800px;
    max-height: 650px;
    height: 100%;
    width: 100%;
    padding: 20px;
    position: relative;
}

.product-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-image img {
    width: 100%;
    height: 100%;
    max-width: 460px;
    max-height: 580px;
    border: 2px solid #ccc; /* Moldura ao redor da imagem */
    border-radius: 10px;
}

.product-details {
    flex: 1;
    padding: 20px;
}

.product-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.product-price {
    font-size: 24px;
    color: #e74c3c; /* Destaque no preço */
    margin-bottom: 20px;
    font-weight: bold;
}

.product-description {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
    margin-bottom: 20px;
}



.quantity-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-bottom: 20px;
}

.quantity-btn button {
    padding: 10px 15px;
    font-size: 18px;
    background-color: #28a745;
    border: none;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.quantity-btn button:hover {
    background-color: #218838;
}

.quantity-btn input {
    width: 50px;
    height: 40px;
    text-align: center;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 0 10px;
    outline: none;
}

.add-to-cart-btn {
    background-color: #28a745;
    padding: 15px 30px;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 18px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

.add-to-cart-btn:hover {
    background-color: #218838;
}


.popup {
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

.popup.active {
    display: block;
}

.back {
    background-color: #dc3545; /* Vermelho para voltar */
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    text-decoration: none;
    display: inline-block;
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
}

.back:hover {
    background-color: #c82333; /* Cor mais escura no hover */
}

body {
    font-family: Arial, sans-serif;
    background-image: url('fundo.png'); /* Adicionando a imagem de fundo */
    background-size: cover;
    background-position: center;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.product-container {
    background-color: rgba(255, 255, 255, 0.9); /* Fundo branco com transparência */
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    display: flex;
    max-width: 1800px;
    max-height: 650px;
    height: 100%;
    width: 100%;
    padding: 20px;
    position: relative;
}

.product-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-image img {
    width: 100%;
    height: 100%;
    max-width: 460px;
    max-height: 580px;
    border: 2px solid #ccc; /* Moldura ao redor da imagem */
    border-radius: 10px;
}

.product-details {
    flex: 1;
    padding: 20px;
}

.product-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.product-price {
    font-size: 24px;
    color: #e74c3c; /* Destaque no preço */
    margin-bottom: 20px;
    font-weight: bold;
}

.product-description {
    font-size: 16px;
    line-height: 1.5;
    color: #555;
    margin-bottom: 20px;
}

.quantity-btn {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.quantity-btn button {
    padding: 10px;
    margin-right: 10px;
    cursor: pointer;
}

.add-to-cart-btn {
    background-color: #28a745;
    padding: 15px 30px;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
}

.add-to-cart-btn:hover {
    background-color: #218838;
}


.popup.active {
    display: block;
}

.back {
    background-color: #dc3545; /* Vermelho para voltar */
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 16px;
    text-decoration: none;
    display: inline-block;
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
}

.back:hover {
    background-color: #c82333; /* Cor mais escura no hover */
}
</style>
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


    
        admin-btns {
    display: flex;
    gap: 15px; /* Espaçamento entre os botões */
    margin-bottom: 20px; /* Espaçamento abaixo dos botões */
}

.edit-product-btn,
.delete-product-btn {
    background-color: #007bff; /* Cor azul para os botões */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-product-btn:hover {
    background-color: #0056b3; /* Cor mais escura no hover do botão Editar */
}

.delete-product-btn {
    background-color: #dc3545; /* Cor vermelha para o botão Excluir */
}

.delete-product-btn:hover {
    background-color: #c82333; /* Cor mais escura no hover do botão Excluir */
}

/* Estilos para a camada de fundo do popup */



/* Animação de fade-in */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Títulos do popup */
.popup-content h2 {
    margin-top: 0;
    color: #333;
    font-size: 24px;
    text-align: center;
}

/* Estilo dos botões */
.save-btn,
.cancel-btn,
.delete-btn {
    background-color: #007bff; /* Cor azul para botões principais */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin: 10px;
    transition: background-color 0.3s ease;
}

.cancel-btn {
    background-color: #6c757d; /* Cor cinza para o botão de cancelar */
}

.delete-btn {
    background-color: #dc3545; /* Cor vermelha para o botão de excluir */
}

/* Hover nos botões */
.save-btn:hover {
    background-color: #0056b3; /* Azul mais escuro no hover */
}

.cancel-btn:hover {
    background-color: #5a6268; /* Cinza mais escuro no hover */
}

.delete-btn:hover {
    background-color: #c82333; /* Vermelho mais escuro no hover */
}

/* Estilo para o fundo escurecido */
.popup-overlay {
    display: none; /* Oculto inicialmente */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6); /* Fundo escuro com opacidade */
    z-index: 999; /* Sobrepondo a página */
}

/* Estilo do conteúdo do popup */
.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out; /* Animação de entrada suave */
}

/* Título do popup */
.popup-content h2 {
    color: #333;
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

/* Animação de fade-in */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Botões do popup */
.popup-buttons button {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-right: 10px;
}

.popup-buttons button:hover {
    background-color: #218838;
}

.cancel-btn {
    background-color: #6c757d; /* Botão de cancelar cinza */
}

.cancel-btn:hover {
    background-color: #5a6268;
}

/* Estilo para o pop-up de exclusão */
#confirm-popup {
    display: none; /* Oculto inicialmente */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 30px;
    border: 2px solid #dc3545; /* Borda vermelha */
    border-radius: 10px;
    z-index: 1001;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 400px;
    animation: fadeIn 0.3s ease-in-out; /* Animação de fade-in */
}

/* Estilo para a camada de fundo (overlay) */
.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Fundo semitransparente */
    z-index: 1000;
}

/* Ativar visibilidade do pop-up e da overlay */
#confirm-popup.active,
.popup-overlay.active {
    display: block;
}

/* Título do pop-up */
#confirm-popup h3 {
    margin-bottom: 20px;
    color: #dc3545;
    font-size: 24px;
}

/* Botões no pop-up de exclusão */
#confirm-popup button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 10px;
}

/* Botão "Sim, excluir" */
#confirm-popup button:first-of-type {
    background-color: #dc3545;
    color: white;
}

/* Estilização geral do pop-up */
.edit-popup {
    width: 400px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    display: none; /* Escondido por padrão */
}

/* Cabeçalho do pop-up */
.popup-header {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

/* Estilização do formulário */
#edit-product-form {
    display: flex;
    flex-direction: column;
}

/* Estilização dos campos de input */
#edit-product-form label {
    margin-bottom: 5px;
    font-size: 14px;
    color: #333;
}

#edit-product-form input, 
#edit-product-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Estilização dos botões */
.popup-buttons {
    display: flex;
    justify-content: space-between;
}

.popup-buttons button {
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.popup-buttons button:hover {
    background-color: #218838;
}

.popup-buttons button:nth-child(2) {
    background-color: #dc3545;
}

.popup-buttons button:nth-child(2):hover {
    background-color: #c82333;
}

/* Responsividade */
@media (max-width: 500px) {
    .edit-popup {
        width: 90%;
    }
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
    <div class="admin-btns">
        <button class="edit-product-btn" onclick="openEditPopup()">Editar Produto</button>
        <button class="delete-product-btn" onclick="openConfirmPopup()">Excluir Produto</button>
    </div>
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