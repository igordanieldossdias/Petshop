<?php
// Conectar ao banco de dados
$servername = "localhost"; // Substitua pelo seu servidor
$username = "root"; // Substitua pelo seu nome de usuário do banco
$password = ""; // Substitua pela sua senha do banco
$dbname = "db_petshop2"; // Substitua pelo nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Pegando os dados do formulário
  $nome = $_POST['nome'];
  $url_imagem = $_POST['url_imagem'];
  $url_imagem2 = $_POST['url_imagem2'];
  $preco = $_POST['preco'];
  $descricao = $_POST['descricao'];
  $categoria = $_POST['categoria'];

  // Montar a SQL para inserir os dados
  $sql = "INSERT INTO produtos (nome, url_imagem, url_imagem2, preco, descricao, categoria) 
          VALUES ('$nome', '$url_imagem', '$url_imagem2', '$preco', '$descricao', '$categoria')";

  // Executar a consulta e verificar se foi inserido corretamente
  if ($conn->query($sql) === TRUE) {
    // Se a inserção foi bem-sucedida, redirecionar para a página com o parâmetro de sucesso
    header("Location: Criarcao_produtos.php?status=sucesso");
    exit();
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

}

// Fechar a conexão
$conn->close();
?>
