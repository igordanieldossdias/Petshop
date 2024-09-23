<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reclame Aqui</title>
<link rel="stylesheet" href="reclame.css">
</head>
<body>

<nav class="navbar" data-navbar>
  <ul class="navbar-list">

    <li class="navbar-item">
      <a href="PetShop\index.php" class="navbar-link" data-nav-link>Início</a>
    </li>

    <li class="navbar-item">
      <a href="#" class="navbar-link" data-nav-link>Catálogo de Produtos</a>
    </li>

    <li class="navbar-item">
      <a href="perguntas.php" class="navbar-link" data-nav-link>FAQ</a>
    </li>

    <li class="navbar-item">
      <a href="consultas.html" class="navbar-link" data-nav-link>Consultas</a>
    </li>

   </ul>
   </nav>

<div class="container">
    <h1>Nos conte o que não gostou!</h1>
    <form class="form" action="#" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>
