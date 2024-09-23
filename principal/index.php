<?php
session_start();
if (isset($_GET['status']) && $_GET['status'] === 'sucesso') {
  echo "<script>alert('Produto excluído com sucesso.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PontoPet</title>
  <meta name="title" content="PontoPet">
  <link rel="shortcut icon" href="petfundo.png" type="image">
  <link rel="stylesheet" href="../assets/css/style.css">
  <!--Links de fontes da internet -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">
  <!-- Imagens -->
  <link rel="preload" as="image" href="petfundo.png">

</head>

<body id="top">

  <header class="header" data-header>
    <div class="container">

      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
        <ion-icon name="close-outline" aria-label="true" class="close-icon"></ion-icon>
      </button>

      <a href="#" class="logo">PontoPet</a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
          <li class="navbar-item"><a href="#home" class="navbar-link" data-nav-link>Início</a></li>
          <li class="navbar-item"><a href="#shop" class="navbar-link" data-nav-link>Catálogo de Produtos</a></li>
          <li class="navbar-item"><a href="../FAQ/FAQ.php" class="navbar-link" data-nav-link>FAQ</a></li>
          <li class="navbar-item"><a href="../Consultas/consultas.php" class="navbar-link" data-nav-link>Consultas</a></li>

          <?php
          // Exibe a opção "Criação de produtos" apenas para administradores
          if (isset($_SESSION['autenticado_adm']) && $_SESSION['autenticado_adm']) {
              echo '<li class="navbar-item"><a href="../Criarprodutos/Criarcao_produtos.php" class="navbar-link" data-nav-link>Criação de produtos</a></li>';
          }
          ?>
        </ul>
      </nav>

      <div class="header-actions">
        <?php
        if (isset($_SESSION['autenticado_adm']) && $_SESSION['autenticado_adm']) {
            // Exibe uma saudação especial para administradores e botão de logout
            $nome_administrador = $_SESSION['username'];
            echo '<div style="color: white; font-size: 18px; font-weight: bold;">Logado como administrador (' . $nome_administrador . ')</div>';
            echo '<form action="logout.php" method="POST" style="display:inline;">
                      <button type="submit" class="action-btn user" aria-label="Logout">Logout</button>
                   </form>';
        } elseif (isset($_SESSION['autenticado']) && $_SESSION['autenticado']) {
            // Exibe uma saudação para usuários comuns e botão de logout
            $nome_cliente = $_SESSION['username'];
            echo '<div style="color: white; font-size: 18px; font-weight: bold;">Olá, ' . $nome_cliente . '!</div>';
            echo '<form action="logout.php" method="POST" style="display:inline;">
                      <button type="submit" class="action-btn user" aria-label="Logout">Logout</button>
                   </form>';
          }
        ?>

        <script>
          document.getElementById("searchBtn").addEventListener("click", function() {
            window.location.href = "Cadastro/cadastro.html";
          });
          document.getElementById("userBtn").addEventListener("click", function() {
            window.location.href = "Login/login.php";
          });
        </script>

        <a href="../carrinho/carrinho.php" class="action-btn" aria-label="cart">
          <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
          <span class="btn-badge">0</span>
        </a>

      </div>

    </div>
  </header>

  <main>
    <article>







      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image" id="home" aria-label="home"
        style="background-image: url('fundonovoluana.png')"> <!--FUNDO DA HOMEEEEEEEE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
      </section>





      <!-- 
        - #CATEGORY
      -->

      <section class="section category" aria-label="category">
  <div class="container">

    <h2 class="h2 section-title">
      <span class="span">Categorias</span> Animais
    </h2>

    <ul class="has-scrollbar">

      <li class="scrollbar-item">
        <div class="category-card">
          <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
            <a href="../Gatos/gatos.php">
              <img src="../assets/images/category-1.jpg" width="330" height="300" loading="lazy" alt="Cat Food" class="img-cover">
            </a>
          </figure>
          <h3 class="h3">
            <a href="../Gatos/gatos.php" class="card-title">Gatos</a>
          </h3>
        </div>
      </li>

      <li class="scrollbar-item">
        <div class="category-card">
          <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
            <a href="../Cachorros/cachorros.php">
              <img src="../assets/images/category-2.jpg" width="330" height="300" loading="lazy" alt="Cat Toys" class="img-cover">
            </a>
          </figure>
          <h3 class="h3">
            <a href="../Cachorros/cachorros.php" class="card-title">Cachorros</a>
          </h3>
        </div>
      </li>

      <li class="scrollbar-item">
        <div class="category-card">
          <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
            <a href="../Passaros/passaros.php">
              <img src="../assets/images/category-3.jpg" width="330" height="300" loading="lazy" alt="Dog Food" class="img-cover">
            </a>
          </figure>
          <h3 class="h3">
            <a href="../Passaros/passaros.php" class="card-title">Passáros</a>
          </h3>
        </div>
      </li>

      <li class="scrollbar-item">
        <div class="category-card">
          <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
            <a href="../Aquáticos/aquaticos.php">
              <img src="../assets/images/category-4.jpg" width="330" height="300" loading="lazy" alt="Dog Toys" class="img-cover">
            </a>
          </figure>
          <h3 class="h3">
            <a href="../Aquáticos/aquaticos.php" class="card-title">Aquáticos</a>
          </h3>
        </div>
      </li>

      <li class="scrollbar-item">
        <div class="category-card">
          <figure class="card-banner img-holder" style="--width: 330; --height: 300;">
            <a href="../Roedores/roedores.php">
              <img src="../assets/images/category-5.jpg" width="330" height="300" loading="lazy" alt="Dog Sumpplements" class="img-cover">
            </a>
          </figure>
          <h3 class="h3">
            <a href="Roedores/roedores.php" class="card-title">Roedores</a>
          </h3>
        </div>
      </li>

    </ul>

  </div>
</section>

      





      <!-- 
        - #PRODUCT
      -->

      <?php  
      // Conexão com o banco de dados
      $conn = new mysqli("localhost", "root", "", "db_petshop2");
      
      // Verifica se houve algum erro na conexão
      if ($conn->connect_error) {
          die("Conexão falhou: " . $conn->connect_error);
      }
      
      // Consulta os produtos no banco de dados
      $sql = "SELECT id, nome, url_imagem, url_imagem2, preco, descricao FROM produtos";
      $result = $conn->query($sql);
    ?>
    
    <section class="section product" id="shop" aria-label="product">
      <div class="container">
    
        <h2 class="h2 section-title">
          <span class="span">Catálogo de</span> Produtos
        </h2>
    
        <ul class="grid-list">
    
          <?php
          if ($result->num_rows > 0) {
            // Loop através dos produtos retornados
            while($row = $result->fetch_assoc()) {
              echo '<li>';
              echo '<div class="product-card">';
              // O link envolve a div que contém ambas as imagens
              echo '<a href="../Produtos/Produto.php?id=' . $row["id"] . '">';
              echo '<div class="card-banner img-holder" style="--width: 360; --height: 360;">';
              // Primeira imagem (default)
              echo '<img src="' . $row["url_imagem"] . '" width="360" height="360" loading="lazy" alt="' . $row["nome"] . '" class="img-cover default">';
              // Segunda imagem (hover)
              echo '<img src="' . $row["url_imagem2"] . '" width="360" height="360" loading="lazy" alt="' . $row["nome"] . '" class="img-cover hover">';
              echo '</div>';
              echo '</a>';
              echo '<button class="card-action-btn" aria-label="add to cart" title="Adicionar ao carrinho">';
              echo '<ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>';
              echo '</button>';
              echo '<div class="card-content">';
              // O link no nome do produto também redireciona para a página do produto
              echo '<h3 class="h3"><a href="../Produtos/Produto.php?id=' . $row["id"] . '" class="card-title">' . $row["nome"] . '</a></h3>';
              echo '<data class="card-price" value="15">R$' . $row["preco"] . '</data>';
              echo '</div>';
              echo '</div>';
              echo '</li>';
            }
          } else {
            echo '<p>Nenhum produto encontrado.</p>';
          }
          ?>
    
        </ul>
    
      </div>
    </section>





      <!-- 
        - #SERVICE
      -->

      <section class="section service" aria-label="service">
        <div class="container">

          <img src="pata.png" width="300" height="300" loading="lazy" alt="" class="img">

          <h2 class="h2 section-title">
            <span class="span">O que o seu animal de estimação precisa,</span> quando precisar.
          </h2>

          <ul class="grid-list">

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="../assets/images/service-icon-1.png" width="70" height="70" loading="lazy"
                    alt="service icon">
                </figure>

                <h3 class="h3 card-title">Delivery amazon</h3>

                <p class="card-text">
                  Seu produto pode ser enviado em até dois dias úteis após você fazer o pedido.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="../assets/images/service-icon-2.png" width="70" height="70" loading="lazy"
                    alt="service icon">
                </figure>

                <h3 class="h3 card-title">Solicitação de devolução</h3>

                <p class="card-text">
                  Basta indicar quais produtos estão sendo devolvidos e o motivo da devolução.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="../assets/images/service-icon-3.png" width="70" height="70" loading="lazy"
                    alt="service icon">
                </figure>

                <h3 class="h3 card-title">Confiabilidade</h3>

                <p class="card-text">
                 Caso não receba algum item adquirido em nosso site, contate-nos.
                </p>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="../assets/images/service-icon-4.png" width="70" height="70" loading="lazy"
                    alt="service icon">
                </figure>

                <h3 class="h3 card-title">Suporte</h3>

                <p class="card-text">
                 Suporte para tirar dúvidas e comentar sobre algum erro de utilização
                </p>

              </div>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="cta has-bg-image" aria-label="cta" style="background-image: url('./assets/images/cta-bg.jpg')">
        <div class="container">

          <figure class="cta-banner">
            <img src="../assets/images/cta-banner.png" width="900" height="660" loading="lazy" alt="cat" class="w-100">
          </figure>

          <div class="cta-content">

            <img src="../assets/images/cta-icon.png" width="120" height="35" loading="lazy" alt="taste guarantee"
              class="img">

            <h2 class="h2 section-title">Você sabia?</h2>

            <p class="section-text">
              Segundo pesquisas, 86% dos brasileiros com acesso à internet utilizam a rede para buscar orientações sobre saúde, remédios e suas condições médicas.
            </p>

            <a href="#" class="btn">Abra para saber mais</a>

          </div>

        </div>
      </section>





      <!-- 
        - #BRAND
      -->

      <section class="section brand" aria-label="brand">
        <div class="container">

          <h2 class="h2 section-title">
            <span class="span">Converse com</span> Profissionais
          </h2>

          <ul class="has-scrollbar">

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/images/lu.jpg" width="150" height="150" loading="lazy" alt="brand logo"
                  class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/images/lu.jpg" width="150" height="150" loading="lazy" alt="brand logo"
                  class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/images/lu.jpg" width="150" height="150" loading="lazy" alt="brand logo"
                  class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/images/lu.jpg" width="150" height="150" loading="lazy" alt="brand logo"
                  class="img-cover">
              </div>
            </li>

            <li class="scrollbar-item">
              <div class="brand-card img-holder" style="--width: 150; --height: 150;">
                <img src="../assets/images/lu.jpg" width="150" height="150" loading="lazy" alt="brand logo"
                  class="img-cover">
              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer" style="background-image: url('./assets/images/footer-bg.jpg')">

    <div class="footer-top section">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">DevLink</a>

          <p class="footer-text">
            Dúvidas? Por favor entre em contato <a href="petponto@gmail.com"
              class="link">emaildanossaempresa@gmail.com</a>
          </p>

          <ul class="contact-list">

           
            
            <li class="contact-item">
              <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

              <a href="xx xxxxx-xxxx" class="contact-link">(12)xxxxx-xxxx</a>
            </li>

          </ul>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">PontoPet</p>
          </li>

          <li>
            <a href="Sobre\sobre.php" class="footer-link">Sobre nós</a>
          </li>

          <li>
            <a href="Reclame\reclame.php" class="footer-link">Reclame aqui!</a>
          </li>

          <li>
            <a href="PerguntasFrequentes\perguntas.php" class="footer-link">Perguntas Frequentes</a>
          </li>

          <li>
            <a href="Fornecedores\fornecedores.php" class="footer-link">Fornecedores</a>
          </li>

        </ul>

        <ul class="footer-list">

        <li>
            <p class="footer-list-title">Outras aplicações</p>
          </li>
          <li>
            <a href="#" class="footer-link">Termos e Diretrizes</a>
          </li>
          <li>
            <a href="#" class="footer-link">Políticas de Privacidade, Envios e Reembolsos</a>
          </li>
          <li>
            <a href="#" class="footer-link">Utilize o nosso APP </a>
          </li>

        </ul>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2024 alunos de desenvolvimento <a href="#" class="copyright-link"> PontoPet </a>
        </p>

        <img src="./assets/images/payment.png" width="397" height="32" loading="lazy" alt="payment method" class="img">

      </div>
    </div>

  </footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>