<?php
session_start();

// Ativa a exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "db_petshop2");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM cliente WHERE email_cliente='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $linha = $result->fetch_assoc();
            $senha_db = $linha['senha_cliente'];

            if ($senha === $senha_db) {
                // Redireciona se a senha estiver correta
                $_SESSION['username'] = $linha['nome_cliente'];
                $_SESSION['id_cliente'] = $linha['id_cliente'];
                $_SESSION['email_cliente'] = $linha['email_cliente'];
                $_SESSION['autenticado'] = true;
                header("Location: ../principal/index.php");
                exit(); 
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    }
}
?>
