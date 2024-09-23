<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "db_petshop2");

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o usuário está logado
$user_logged_in = isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true;
$user_id = $user_logged_in ? $_SESSION["user_id"] : null;

// Adiciona uma nova pergunta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar_pergunta"])) {
    if ($user_logged_in && $user_id !== null) {
        $pergunta = $conn->real_escape_string($_POST['pergunta']);
        $stmt = $conn->prepare("INSERT INTO perguntas (pergunta, usuario_id) VALUES (?, ?)");
        $stmt->bind_param("si", $pergunta, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Pergunta adicionada com sucesso.');</script>";
        } else {
            echo "<script>alert('Erro ao adicionar pergunta: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Você precisa estar logado para enviar uma pergunta.');</script>";
    }
}

// Adiciona uma nova resposta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar_resposta"])) {
    if ($user_logged_in && $user_id !== null) {
        $resposta = $conn->real_escape_string($_POST['resposta']);
        $pergunta_id = $conn->real_escape_string($_POST['pergunta_id']);
        $stmt = $conn->prepare("INSERT INTO respostas (pergunta_id, resposta, usuario_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $pergunta_id, $resposta, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Resposta adicionada com sucesso.');</script>";
        } else {
            echo "<script>alert('Erro ao adicionar resposta: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Você precisa estar logado para enviar uma resposta.');</script>";
    }
}

// Edita uma pergunta existente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_pergunta"])) {
    if ($user_logged_in && $user_id !== null) {
        $pergunta_id = $conn->real_escape_string($_POST['pergunta_id']);
        $pergunta_editada = $conn->real_escape_string($_POST['pergunta_editada']);
        $stmt = $conn->prepare("UPDATE perguntas SET pergunta = ? WHERE id = ? AND usuario_id = ?");
        $stmt->bind_param("sii", $pergunta_editada, $pergunta_id, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('Pergunta editada com sucesso.');</script>";
        } else {
            echo "<script>alert('Erro ao editar pergunta: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Você precisa estar logado para editar uma pergunta.');</script>";
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Frequentes</title>
    <style>
        body {
            background-image: url('fundifaq.png');
            background-repeat: repeat; /* Faz o fundo se repetir */
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.8); /* Fundo branco com transparência */
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-height: 90vh;
            overflow-y: auto; /* Habilita a rolagem vertical */
        }

        .form {
            margin-bottom: 20px;
        }

        .form label {
            display: block;
            margin-bottom: 5px;
        }

        .form input[type="text"], .form textarea {
            width: calc(100% - 100px);
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px; /* Adiciona bordas arredondadas */
        }

        .form button {
            width: auto;
            padding: 12px;
            margin-left: 10px;
            background-color: #28a745; /* Verde para confirmar perguntas e respostas */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            font-size: 16px;
            white-space: nowrap;
        }

        .form button:hover {
            background-color: #218838; /* Cor mais escura no hover */
        }

        .pergunta {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .pergunta .edit-button {
            margin-left: 10px;
            background-color: #ffc107; /* Amarelo para editar */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            font-size: 16px;
            white-space: nowrap;
        }

        .pergunta .edit-button:hover {
            background-color: #e0a800; /* Cor mais escura no hover */
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #dc3545; /* Vermelho para voltar */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-button:hover {
            background-color: #c82333; /* Cor mais escura no hover */
        }
    </style>
    <script>
        function checkLogin() {
            <?php if (!$user_logged_in): ?>
            alert("Você precisa estar logado para enviar perguntas ou respostas.");
            window.location.href = 'index.php';
            return false;
            <?php endif; ?>
            return true;
        }

        function showEditForm(perguntaId, perguntaText) {
            document.getElementById('edit-form-' + perguntaId).style.display = 'block';
            document.getElementById('pergunta-edit-' + perguntaId).value = perguntaText;
        }

        function hideEditForm(perguntaId) {
            document.getElementById('edit-form-' + perguntaId).style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <a href="../index.php" class="back-button">Voltar</a>
        <h1>Perguntas Frequentes</h1>

        <!-- Formulário para adicionar uma nova pergunta -->
        <?php if ($user_logged_in): ?>
        <form method="post" action="" onsubmit="return checkLogin();" class="form">
            <label for="pergunta">Pergunta:</label>
            <input type="text" id="pergunta" name="pergunta" required>
            <button type="submit" name="enviar_pergunta">Enviar Pergunta</button>
        </form>
        <?php endif; ?>

        <!-- Listagem das perguntas e respostas -->
        <?php
        // Reabre a conexão com o banco de dados
        $conn = new mysqli("localhost", "root", "", "db_petshop2");

        // Verifica se houve algum erro na conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Consulta todas as perguntas
        $result = $conn->query("SELECT p.id, p.pergunta, c.email_cliente, p.usuario_id FROM perguntas p JOIN cliente c ON p.usuario_id = c.id_cliente");

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <div class="faq-item">
            <p class="pergunta"><?php echo htmlspecialchars($row['pergunta']); ?></p>
            <p>Por: <?php echo htmlspecialchars($row['email_cliente']); ?></p>

            <!-- Formulário para editar uma pergunta -->
            <?php if ($user_logged_in && $row['usuario_id'] == $user_id): ?>
            <button class="edit-button" onclick="showEditForm(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['pergunta']); ?>')">Editar</button>
            <form id="edit-form-<?php echo $row['id']; ?>" method="post" action="" style="display: none;" class="form">
                <input type="hidden" name="pergunta_id" value="<?php echo $row['id']; ?>">
                <label for="pergunta_edit">Editar Pergunta:</label>
                <textarea id="pergunta-edit-<?php echo $row['id']; ?>" name="pergunta_editada" required></textarea>
                <button type="submit" name="editar_pergunta">Salvar</button>
                <button type="button" class="edit-button" onclick="hideEditForm(<?php echo $row['id']; ?>)">Cancelar</button>
            </form>
            <?php endif; ?>

            <!-- Lista as respostas -->
            <?php
            $pergunta_id = $row['id'];
            $answers_result = $conn->query("SELECT r.resposta, c.email_cliente, r.usuario_id FROM respostas r JOIN cliente c ON r.usuario_id = c.id_cliente WHERE r.pergunta_id = $pergunta_id");

            if ($answers_result->num_rows > 0):
                while ($answer_row = $answers_result->fetch_assoc()):
            ?>
            <div class="faq-item">
                <p><?php echo htmlspecialchars($answer_row['resposta']); ?></p>
                <p>Respondido por: <?php echo htmlspecialchars($answer_row['email_cliente']); ?></p>
            </div>
            <?php endwhile; endif; ?>

            <!-- Formulário para adicionar uma nova resposta -->
            <?php if ($user_logged_in): ?>
            <form method="post" action="" onsubmit="return checkLogin();" class="form">
                <input type="hidden" name="pergunta_id" value="<?php echo $row['id']; ?>">
                <label for="resposta">Resposta:</label>
                <textarea id="resposta" name="resposta" required></textarea>
                <button type="submit" name="enviar_resposta">Enviar Resposta</button>
            </form>
            <?php endif; ?>
        </div>
        <?php endwhile; endif; ?>

        <?php $conn->close(); ?>
    </div>
</body>
</html>
