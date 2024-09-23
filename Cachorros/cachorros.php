<?php
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Busca produtos com a tag "Gatos"
$sql = "SELECT * FROM produtos WHERE categoria = 'cachorros'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cachorros.css">
    <title>Produtos para cachorros</title>

    <style>
        /* Estilos atualizados para hover */
        .img-holder {
            position: relative;
        }
        .img-cover {
            transition: opacity 0.5s ease;
        }
        .img-cover.default {
            opacity: 1;
        }
        .img-cover.hover {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
        /* Quando o mouse estiver em cima da div, mostre a segunda imagem */
        .img-holder:hover .img-cover.hover {
            opacity: 1;
        }
        .img-holder:hover .img-cover.default {
            opacity: 0;
        }
    </style>
</head>
<body>  

<style>
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
            margin-bottom: 20px;
        }
        
        .back:hover {
            background-color: #c82333; /* Cor mais escura no hover */
        }
</style>

    <button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>

<section class="section product" id="shop" aria-label="product">
    <div class="container">

        <h2 class="h2 section-title">
            <span class="span">Produtos</span> para cachorros
        </h2>

        <ul class="grid-list">

            <?php
            if ($result->num_rows > 0) {
                // Exibe os produtos encontrados
                while($row = $result->fetch_assoc()) {
                    echo '<li>';
                    echo '<div class="product-card">';
                    // O link envolve a div que contém ambas as imagens
                    echo '<a href="../Produtos/Produto.php?id=' . $row["id"] . '">';
                    echo '<div class="card-banner img-holder" style="--width: 360; --height: 360;">';
                    // Primeira imagem (default)
                    echo '<img src="' . $row["url_imagem"] . '" width="360" height="360" loading="lazy" alt="' . $row["nome"] . '" class="img-cover default">';
                    // Segunda imagem (hover)
                    echo '<img src="' . $row["url_imagem2"] . '" width="360" height="360" loading="lazy" alt="' . $row["nome"] . '" class="img-cover hover">';
                    echo '</div>';
                    echo '</a>';
                    echo '<button class="card-action-btn" aria-label="add to cart" title="Adicionar ao carrinho">';
                    echo '<ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>';
                    echo '</button>';
                    echo '<div class="card-content">';
                    // O link no nome do produto também redireciona para a página do produto
                    echo '<h3 class="h3"><a href="../Produtos/Produto.php?id=' . $row["id"] . '" class="card-title">' . $row["nome"] . '</a></h3>';
                    echo '<data class="card-price" value="15">R$' . $row["preco"] . '</data>';
                    echo '</div>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo "<p>Nenhum produto encontrado para gatos.</p>";
            }

            // Fecha a conexão
            $conn->close();
            ?>

        </ul>

    </div>
</section>

</body>
</html>