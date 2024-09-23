<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do MySQL
$password = ""; // Substitua pela sua senha do MySQL
$dbname = "db_petshop2";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);


// Obtém os dados do formulário
$nome_cliente = $conn->real_escape_string($_POST['name']);
$email_cliente = $conn->real_escape_string($_POST['email']);
$telefone_cliente = $conn->real_escape_string($_POST['phone']);
$tipo_consulta = $conn->real_escape_string($_POST['consultation_type']);
$tipo_animal = $conn->real_escape_string($_POST['animal']);
$nome_animal = $conn->real_escape_string($_POST['animal_name']);

// Prepara a query SQL para inserção
$sql = "INSERT INTO consultas (nome_cliente, email_cliente, telefone_cliente, tipo_consulta, tipo_animal, nome_animal)
VALUES ('$nome_cliente', '$email_cliente', '$telefone_cliente', '$tipo_consulta', '$tipo_animal', '$nome_animal')";

// Executa a query e verifica se a inserção foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    echo "Consulta agendada com sucesso!";
    header("location: consultas.php"); }
 else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
