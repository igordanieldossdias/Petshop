<?php
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres não numéricos
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false; // Verifica se o CPF tem 11 dígitos ou se todos os números são iguais
    }
    
    // Validação do primeiro dígito verificador
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

$conn = new mysqli("localhost", "root", "", "db_petshop2");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CPF = $_POST["cpf"];
    $nome = $_POST["name"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (!validarCPF($CPF)) {
        echo "CPF inválido.";
        exit;
    }

    // Criptografar a senha usando password_hash
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cliente (cpf_cliente, nome_cliente, senha_cliente, email_cliente) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $CPF, $nome, $senha_hash, $email);
    $stmt->execute();
    
    header("Location: Login/Login.html");
}

$conn->close();
?>
