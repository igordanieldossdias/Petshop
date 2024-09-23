<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber dados do formulário
$nome_usuario = $_POST['name'];
$email_cliente = $_POST['email'];
$telefone_cliente = $_POST['phone'];
$tipo_consulta = $_POST['consultation_type'];
$tipo_animal = $_POST['animal'];
$nome_animal = $_POST['animal_name'];
$data_agendamento = $_POST['appointment_date'];

// Inserir dados na tabela consultas
$sql = "INSERT INTO consultas (nome_cliente, email_cliente, telefone_cliente, tipo_consulta, tipo_animal, nome_animal, data_agendamento)
        VALUES ('$nome_usuario', '$email_cliente', '$telefone_cliente', '$tipo_consulta', '$tipo_animal', '$nome_animal', '$data_agendamento')";

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
