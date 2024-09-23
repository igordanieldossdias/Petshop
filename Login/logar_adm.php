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

        $sql = "SELECT * FROM administradores WHERE email_adm='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $linha = $result->fetch_assoc();
            $senha_db = $linha['senha_adm'];

            if (($senha === $senha_db)) {
                $_SESSION['username'] = $linha['nome_adm'];
                $_SESSION['id_adm'] = $linha['id_adm'];
                $_SESSION['autenticado_adm'] = true;
                header("Location: ../principal/index.php");
                exit(); // Garante que o script pare aqui
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>