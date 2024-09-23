<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastrar.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="box">
        <div class="img-box">
            <img src="fundocadastro.png">
        </div>
        <div class="form-box">
            <h2>Cadastro</h2>
            <p>Já possui uma conta? <a href="Login/login.html">Faça login</a></p>
            <form action="cadastrar.php" method="post">
                <div class="input-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="name" placeholder="Digite o seu nome completo" required>
                </div>

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                </div>

                <div class="input-group">
                    <label for="telefone">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Digite o seu CPF" required>
                </div>

                <div class="input-group w50">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <div class="input-group">
                    <button type="submit">Criar conta</button>
                </div>
            </form>
           
    </div>
</body>
</html>
