<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agende sua Consulta - PontoPet</title>
    <link rel="stylesheet" href="consultas.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">
    <style>
        .back {
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
            width: 250px;
            top: 10px;
            position: absolute;
        }

        .back:hover {
            background-color: #c82333; /* Cor mais escura no hover */
        }

        .main-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px auto;
            max-width: 1200px; /* Ajuste a largura máxima se necessário */
        }

        .contact-form {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-form h2 {
            text-align: center;
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .contact-form input, .contact-form select, .contact-form button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        .contact-form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        .consultation-card {
            background-color: #fff;
            border: 2px solid #e9ecef;
            width: 500px; /* Ajuste o tamanho conforme necessário */
            border-radius: 8px;
            padding: 15px;
            margin: 10px; /* Espaço entre os cards */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .consultation-card h3 {
            margin-top: 0;
        }

        .consultation-card button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .consultation-card button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <header>
        <h1>PontoPet - Agende sua Consulta</h1>
    </header>

    <button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>  

    <div class="main-container">

        <?php
        session_start();

        // Conectar ao banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_petshop2";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        if (isset($_SESSION['autenticado_adm']) && $_SESSION['autenticado_adm'] === true) {
            // Exibir consultas se for admin
            $sql = "SELECT * FROM consultas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="consultation-card">';
                    echo '<h3>Consulta para: ' . htmlspecialchars($row['nome_cliente']) . '</h3>';
                    echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email_cliente']) . '</p>';
                    echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telefone_cliente']) . '</p>';
                    echo '<p><strong>Tipo de Consulta:</strong> ' . htmlspecialchars($row['tipo_consulta']) . '</p>';
                    echo '<p><strong>Tipo de Animal:</strong> ' . htmlspecialchars($row['tipo_animal']) . '</p>';
                    echo '<p><strong>Nome do Animal:</strong> ' . htmlspecialchars($row['nome_animal']) . '</p>';
                    echo '<p><strong>Data da consulta:</strong> ' . htmlspecialchars($row['data_agendamento']) . '</p>';
                    echo '<a href="excluir.php?id=' . $row['id'] . '" onclick="return confirmDelete()"><button>Excluir Consulta</button></a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Nenhuma consulta agendada.</p>';
            }
        } else {
            // Formulário de agendamento
            echo '
            <div class="contact-form">
                <h2>Formulário de Agendamento</h2>
                <form id="appointment-form" action="enviarconsulta.php" method="post">
                    <label for="name">Seu Nome:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email">Seu E-mail:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="phone">Seu Telefone:</label>
                    <input type="tel" id="phone" name="phone" required>
                    
                    <label for="consultation-type">Tipo de Consulta:</label>
                    <select id="consultation-type" name="consultation_type" required>
                        <option value="">Selecione</option>
                        <option value="checkup">Check-up</option>
                        <option value="vacination">Vacinação</option>
                        <option value="emergency">Emergência</option>
                        <option value="grooming">Tosa</option>
                    </select>
                    
                    <label for="animal">Tipo de Animal:</label>
                    <select id="animal" name="animal" required>
                        <option value="">Selecione</option>
                        <option value="Cachorro">Cachorro</option>
                        <option value="Gato">Gato</option>
                        <option value="Pássaros">Pássaros</option>
                        <option value="Tartarugas">Tartarugas</option>
                        <option value="Hamsters">Hamsters</option>
                        <option value="Aquáticos">Aquáticos</option>
                    </select>
                    
                    <label for="animal-name">Nome do Animal:</label>
                    <input type="text" id="animal-name" name="animal_name" required>
                    
                    <button type="submit">Enviar</button>
                </form>
                <div id="form-response"></div>
            </div>
            ';
        }

        // Fechar a conexão
        $conn->close();
        ?>

    </div>

    <script>
        function confirmDelete() {
            return confirm("Você tem certeza que deseja excluir esta consulta?");
        }
    </script>

</body>
</html>
