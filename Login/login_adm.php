<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_adm.css">
    <title>Login ADM</title>
</head>
<body>
    <div class="box">
        <div class="form-box">
            <h2>Login de administrador</h2>
            <a href="login.html">Entrar como cliente</a>
            <form id="form-login-adm" action="logar_adm.php" method="post">
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                </div>

                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <div class="input-group">
                    <label for="confirmar-senha">Confirmar Senha</label>
                    <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Confirme sua senha" required>
                </div>

                <div class="input-group">
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
        <div class="img-box">
            <img src="fundo_adm.png" alt="Imagem de Cadastro">
        </div>
    </div>

    <script>
        // Função para validar as senhas
        document.getElementById("form-login-adm").addEventListener("submit", function(event) {
            const senha = document.getElementById("senha").value;
            const confirmarSenha = document.getElementById("confirmar-senha").value;

            // Verifica se as senhas são iguais
            if (senha !== confirmarSenha) {
                alert("As senhas não coincidem. Por favor, confirme sua senha corretamente.");
                event.preventDefault(); // Impede o envio do formulário
            }
        });
    </script>
</body>
</html>
