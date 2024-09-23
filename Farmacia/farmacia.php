<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="farma.css">
    <title>Página de Farmácia</title>
</head>
<body>

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
        }
        
        .back:hover {
            background-color: #c82333; /* Cor mais escura no hover */
        }
</style>

    <button class="back" onclick="window.location.href='../principal/index.php'">Voltar para a Página Inicial</button>
    
    
    <section class="section product" id="shop" aria-label="product">
        <div class="container">

          <h2 class="h2 section-title">
            <span class="span">Produtos</span> de Farmácia
          </h2>

          <!-- Categoria: Remédios -->
          <h3 class="h3 category-title">Remédios</h3>
          <ul class="grid-list">

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedionatuflin.webp" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Remédio Natuflin</a>
                  </h3>
                  <data class="card-price" value="15">R$10,99</data>
                </div>
              </div>
            </li>

            <!-- Adicione mais produtos de remédios aqui -->
            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedioprofigado.webp" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio2-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Remédio pró-Fígado</a>
                  </h3>
                  <data class="card-price" value="15">R$90,85</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio3.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio3-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Remédio 3</a>
                  </h3>
                  <data class="card-price" value="15">R$11,99</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio4.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio4-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Remédio 4</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

          </ul>

          <!-- Categoria: Produtos de Higiene -->
          <h3 class="h3 category-title">Produtos de Higiene</h3>
          <ul class="grid-list">

          <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="higienelagrimas.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Limpar lágrimas</a>
                  </h3>
                  <data class="card-price" value="15">R$22,90</data>
                </div>
              </div>
            </li>

            <!-- Adicione mais produtos de remédios aqui -->
            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="higienepet.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio2-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Escova</a>
                  </h3>
                  <data class="card-price" value="15">R$14,75</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio3.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio3-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Produto 3</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio4.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio4-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Produto 4</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

          </ul>

          <!-- Categoria: Materiais Esterilizados -->
          <h3 class="h3 category-title">Materiais Esterilizados</h3>
          <ul class="grid-list">

          <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="esterializados.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Tesoura esterializada para corte de pelos em áreas sensíveis</a>
                  </h3>
                  <data class="card-price" value="15">R$24,50</data>
                </div>
              </div>
            </li>

            <!-- Adicione mais produtos de remédios aqui -->
            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio2.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio2-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Material 2</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio3.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio3-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Material 3</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio4.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio4-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Material 4</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

          </ul>

          <!-- Categoria: Outros -->
          <h3 class="h3 category-title">Perfumes e Colônias</h3>
          <ul class="grid-list">

          <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio1.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Perfume 1</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <!-- Adicione mais produtos de remédios aqui -->
            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio2.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio2-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Perfume 2</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio3.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio3-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Perfume 3</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio4.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio4-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Perfume 4</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

          </ul>

          <h3 class="h3 category-title">shampoo's, condicionadores e hidratação</h3>
          <ul class="grid-list">

          <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="shampooecondicionador.webp" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title"> Shampoo e Condicionador 2 em 1</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="shampoo2.webp" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Shampoo 1</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio1.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Shampoo e Condicionador tal</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

            <li>
              <div class="product-card">
                <div class="card-banner img-holder" style="--width: 360; --height: 360;">
                  <img src="remedio1.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover default">
                  <img src="remedio1-hover.jpg" width="360" height="360" loading="lazy" alt="Remédios" class="img-cover hover">
                  <button class="card-action-btn" aria-label="add to card" title="Adicionar ao carrinho">
                    <ion-icon name="bag-add-outline" aria-hidden="true"></ion-icon>
                  </button>
                </div>
                <div class="card-content">
                  <h3 class="h3">
                    <a href="#" class="card-title">Creme de hidratação</a>
                  </h3>
                  <data class="card-price" value="15">R$XX,XX</data>
                </div>
              </div>
            </li>

        </div>
      </section>

</body>
</html>
