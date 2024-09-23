<?php
// Verificar se o parâmetro 'status' está presente na URL
if (isset($_GET['status']) && $_GET['status'] === 'sucesso') {
    echo "<script>alert('Produto adicionado com sucesso.');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Produto</title>
  <link rel="stylesheet" href="css.css">
  <style>
    /* Estilização global */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-image: url('fundo.png'); /* Substitua pelo caminho da sua imagem de fundo */
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 20px;
    }

    /* Estilização do botão de voltar */
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
            width: 250px;
            top: 10px;
            position: absolute;
            left: 20px;
        }
        
        .back:hover {
            background-color: #c82333; /* Cor mais escura no hover */
        }

    /* Estilização do formulário */
    form {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
      width: 400px;
      text-align: left;
    }

    label {
      font-weight: bold;
      color: #333;
      display: block;
      margin-bottom: 8px;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    textarea {
      height: 100px;
      resize: vertical;
    }

    .submit {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    .submit:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>

  <div>
    <h2>Adicionar Novo Produto</h2>
    <form action="criar.php" method="POST">
      <label for="nome">Nome do Produto:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="url_imagem">URL da Imagem 1:</label>
      <input type="text" id="url_imagem" name="url_imagem" required>

      <label for="url_imagem2">URL da Imagem 2:</label>
      <input type="text" id="url_imagem2" name="url_imagem2">

      <label for="preco">Preço:</label>
      <input type="number" step="0.01" id="preco" name="preco" required>

      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" required></textarea>

      <label for="categoria">Categoria:</label>
      <select id="categoria" name="categoria" required>
        <option value="Gatos">Gatos</option>
        <option value="Cães">cachorros</option>
        <option value="pássaros">pássaros</option>
        <option value="aquaticos">aquáticos</option>
        <option value="roedores">roedores</option>
      </select>

      <button class="submit" type="submit">Adicionar Produto</button>
    </form>
  </div>
</body>
</html>
