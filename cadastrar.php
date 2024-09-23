<?php
        $conn = new mySqli ("localhost", "root", "", "db_petshop2");;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $CPF = $_POST["cpf"];
        $nome = $_POST ["name"];
        $email = $_POST ["email"];
        $senha = $_POST["senha"];


        $sql = "INSERT INTO cliente (cpf_cliente, nome_cliente, senha_cliente, email_cliente) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param ("isss",$CPF, $nome, $senha, $email);
        $stmt->execute();
        
        header("Location: Login/Login.html");


    }


$conn->close();
?>