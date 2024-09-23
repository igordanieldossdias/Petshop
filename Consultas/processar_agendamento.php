<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber dados do formulário
$nome_usuario = $_POST['nome_usuario'];
$data_consulta = $_POST['data_consulta'];
$tipo_consulta = $_POST['tipo_consulta'];

// Inserir dados na tabela agendamentos
$sql = "INSERT INTO agendamentos (nome_usuario, data_consulta, tipo_consulta)
        VALUES ('$nome_usuario', '$data_consulta', '$tipo_consulta')";

if ($conn->query($sql) === TRUE) {
    $message = "Novo agendamento criado com sucesso!";
} else {
    $message = "Erro ao criar o agendamento: " . $conn->error;
}

// Fechar conexão
$conn->close();

// Redirecionar de volta para a página de formulário com um alerta
echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = 'consultas.php';
      </script>";
?>
