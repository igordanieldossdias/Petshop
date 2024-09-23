<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_petshop2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}


$nome_completo = $_POST['nome_completo'];
$endereco = $_POST['endereco'];
$descricao = $_POST['descricao'];
$localizacao = $_POST['localizacao'];
$url_foto = $_POST['url_foto'];


$sql = "INSERT INTO profissionais (nome_completo, endereco, descricao, localizacao, url_foto)
VALUES ('$nome_completo', '$endereco', '$descricao', '$localizacao', '$url_foto')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>
