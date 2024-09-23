<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verifica se o usuário está autenticado e possui um e-mail
if (isset($_SESSION['email_cliente']) && !empty($_SESSION['email_cliente'])) {
    $email = $_SESSION['email_cliente'];
} else {
    $email = ''; // Define um valor padrão se o e-mail não estiver definido
}

// Mensagem de sucesso
if (isset($_GET['status']) && $_GET['status'] === 'enviado') {
    echo "<script>alert('Sua pergunta foi enviada com sucesso!');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PontoPet</title>
    <link rel="stylesheet" href="FAQ.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">
</head>

<body>

    <header>
        <h1>PontoPet - Perguntas Frequentes</h1>
    </header>

    <style>
        .back {
            background-color: #dc3545;
            /* Vermelho para voltar */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            width: 250px;
            top: 10px;
            position: absolute;
        }

        .back:hover {
            background-color: #c82333;
            /* Cor mais escura no hover */
        }
    </style>

    <script>
        // Seleciona o formulário pelo ID
        const form = document.getElementById('faq-form');

        // Adiciona um evento de escuta para a submissão do formulário
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Cria um objeto FormData com os dados do formulário
            const formData = new FormData(form);

            // Faz uma requisição AJAX para enviar os dados
            fetch('enviarpergunta.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    // Exibe o alerta após o envio
                    alert('Sua pergunta foi enviada com sucesso!');
                    // Limpa os campos do formulário
                    form.reset();
                })
                .catch(error => {
                    console.error('Erro ao enviar a pergunta:', error);
                });
        });
    </script>

    <button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>

    <div class="main-container">
        <div class="faq-container">
            <h2>Perguntas Frequentes</h2>

            <?php if (!isset($_SESSION['autenticado_adm']) || !$_SESSION['autenticado_adm']): ?>
                <!-- Exibir Perguntas Pré-definidas para Usuários Comuns -->
                <div class="faq-item">
                    <div class="faq-question">
                        <ion-icon name="paw" aria-hidden="true"></ion-icon>
                        Como devo alimentar meu pet?
                    </div>
                    <div class="faq-answer">
                        A alimentação do seu pet deve ser adequada ao seu porte, idade e necessidades nutricionais. Consulte
                        um veterinário para recomendações específicas e escolha rações de qualidade.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <ion-icon name="medkit" aria-hidden="true"></ion-icon>
                        Com que frequência devo levar meu pet ao veterinário?
                    </div>
                    <div class="faq-answer">
                        É recomendado levar seu pet ao veterinário para check-ups regulares a cada 6 a 12 meses. Além disso,
                        siga o calendário de vacinas e faça exames de rotina conforme recomendado pelo veterinário.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <ion-icon name="water" aria-hidden="true"></ion-icon>
                        Como posso garantir que meu pet se mantenha hidratado?
                    </div>
                    <div class="faq-answer">
                        Certifique-se de que seu pet tenha sempre acesso a água limpa e fresca. A água deve ser trocada
                        diariamente e o recipiente deve ser limpo regularmente.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <ion-icon name="paw" aria-hidden="true"></ion-icon>
                        Quais são os sinais de que meu pet pode estar doente?
                    </div>
                    <div class="faq-answer">
                        Fique atento a sinais como mudanças no apetite, comportamento letárgico, dificuldade para respirar,
                        vômitos, diarreia ou alterações na pele e pelagem. Se notar algum desses sintomas, consulte um
                        veterinário.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <ion-icon name="medkit" aria-hidden="true"></ion-icon>
                        Como posso manter o pelo do meu pet saudável?
                    </div>
                    <div class="faq-answer">
                        Escove o pelo do seu pet regularmente para evitar nós e remoção de pelos mortos. Também é importante
                        banhar o pet conforme necessário e utilizar produtos adequados para o tipo de pelo e pele dele.
                    </div>
                </div>

                <!-- Exibir Perguntas Respondidas do Usuário Atual -->
                <h2>Suas Perguntas Respondidas</h2>
                <?php
                if (isset($_SESSION['email_cliente'])) {
                    $email_usuario = $_SESSION['email_cliente']; // Pega o e-mail do usuário logado
                    $query = "SELECT pergunta, resposta, data_envio FROM FAQ WHERE email = '$email_usuario' AND resposta IS NOT NULL AND resposta != ''";
                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        echo "Erro na consulta: " . mysqli_error($conn);  // Adicione essa linha para depuração
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="faq-item">';
                        echo '<div class="faq-question">';
                        echo htmlspecialchars($row['pergunta']);
                        echo '</div>';
                        echo '<div class="faq-answer">';
                        echo htmlspecialchars($row['resposta']);
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Não há perguntas respondidas para exibir.";
                }
                ?>
            <?php endif; ?>

            <!-- Exibir perguntas não respondidas armazenadas no banco de dados para Administradores -->
            <?php
            if (isset($_SESSION['autenticado_adm']) && $_SESSION['autenticado_adm']) {
                $query = "SELECT id, email, pergunta, data_envio FROM FAQ WHERE resposta = '' OR resposta IS NULL";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    echo "Erro na consulta: " . mysqli_error($conn);  // Adicione essa linha para depuração
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="faq-item">';
                    echo '<div class="faq-question">';
                    echo '<ion-icon name="help-circle" aria-hidden="true"></ion-icon>';
                    echo htmlspecialchars($row['pergunta']);
                    echo '</div>';
                    echo '<div class="faq-answer">';
                    // Exibe a informação correta do email
                    echo 'Enviado por: ' . htmlspecialchars($row['email']) . ' em ' . date('d/m/Y', strtotime($row['data_envio']));

                    echo '</div>';

                    // Exibe o formulário de resposta
                    echo '<form action="responder_pergunta.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<label for="resposta">Resposta:</label>';
                    echo '<textarea name="resposta" style="width: 475px; height: 120px;" required></textarea>';
                    echo '<button type="submit">Enviar Resposta</button>';
                    echo '</form>';
                }
            }
            ?>
        </div>

        <!-- Exibir o formulário de envio de perguntas apenas para usuários comuns -->
        <?php if (!isset($_SESSION['autenticado_adm']) || !$_SESSION['autenticado_adm']): ?>
            <div class="contact-form">
                <h2>Envie sua pergunta</h2>
                <form id="faq-form" action="enviarpergunta.php" method="post">
                    <input type="hidden" id="email" name="email" value="<?php echo $email; ?>"> <!-- Email pela sessão -->
                    
                    <label for="question">Sua Pergunta:</label>
                    <textarea id="question" name="question" rows="4" required></textarea>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="FAQ.js"></script>
</body>

</html>