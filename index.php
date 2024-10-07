<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastrar.css">
    <title>Cadastro</title>
    <script>
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove todos os caracteres que não são números
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                return false; // Verifica se tem 11 dígitos ou todos os números são iguais
            }
            let soma = 0;
            let resto;

            // Validação do primeiro dígito verificador
            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;

            // Validação do segundo dígito verificador
            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        }

        function validarFormulario() {
            const cpf = document.getElementById('cpf').value;
            if (!validarCPF(cpf)) {
                alert("CPF inválido. Por favor, insira um CPF válido.");
                return false;
            }
            return true;
        }
    </script>
</head>
<!DOCTYPE html>
<html lang="pt-BR">
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
            <form id="form-cadastro" action="cadastrar.php" method="post">
                <div class="input-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="name" placeholder="Digite o seu nome completo" required>
                </div>

                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Digite o seu CPF" required>
                </div>

                <div class="input-group w50">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <div class="input-group w50">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>
                </div>

                <div class="input-group">
                    <button type="submit">Criar conta</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        
        document.getElementById("form-cadastro").addEventListener("submit", function(event) {
            const senha = document.getElementById("senha").value;
            const confirmarSenha = document.getElementById("confirmar_senha").value;

            
            if (senha !== confirmarSenha) {
                alert("As senhas não coincidem. Por favor, tente novamente.");
                event.preventDefault(); 
            }
        });
    </script>
</body>
</html>
