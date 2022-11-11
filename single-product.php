<!-- Nav -->
<?php require_once "inc/nav_2.php" ?>

<!-- Produtos -->

<?php

$product_id = "";
if (isset($_GET['p_id'])) {
  $product_id = $_GET['p_id'];
}

$products = get_products('', $product_id);
$result = mysqli_fetch_assoc($products);
// var_dump($result);
?>

<script>
  function updateQdt(obj){
    document.getElementById("qdt").setAttribute('value',obj.value);
    console.log(document.getElementById("qdt").value);
  }

</script>


<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="assets/images/bg-shop.jpg">
    <div class="breadcrumbs-custom-body parallax-content context-dark">
      <div class="container">
        <h2 class="breadcrumbs-custom-title">Single Product</h2>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php">Produtos</a></li>
        <li class="active"><?php echo $result['product_name'] ?></li>
      </ul>
    </div>
  </div>
</section>
<!-- Single Product-->
<section class="section section-sm section-first bg-default">
  <div class="container">
    <div class="row row-30">
      <div class="col-lg-6">
        <div class="slick-vertical slick-product">
          <!-- Slick Carousel-->
          <div class="slick-slider carousel-parent" id="carousel-parent" data-items="1" data-swipe="true" data-child="#child-carousel" data-for="#child-carousel">
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
          </div>
          <div class="slick-slider child-carousel slick-nav-1" id="child-carousel" data-arrows="true" data-items="3" data-sm-items="3" data-md-items="3" data-lg-items="3" data-xl-items="3" data-xxl-items="3" data-md-vertical="true" data-for="#carousel-parent">
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
            <div class="item">
              <div class="slick-product-figure"><img src="Admin/img/<?php echo $result['img'] ?>" alt="" width="530" height="480" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="single-product">
          <h3 class="text-transform-none font-weight-medium"><?php echo $result['product_name'] ?></h3>
          <div class="group-md group-middle">
            <div class="single-product-price"><?php echo $result['price'] ?> € </div>
          </div>
          <p> <?php echo $result['description'] ?> </p>
          <hr class="hr-gray-100">
          <ul class="list list-description">
            <li><span>Categoria:</span><span><?php echo $result['category_name'] ?></span></li>
            <li><span>SKU:</span><span><?php echo $result['MRP'] ?></span></li>
            <li><span>Ref Int:</span><span><?php echo $result['category_name'] ?></span></li>
          </ul>
          <div class="group-xs group-middle">
            <div class="product-stepper">
              <input class="form-input" type="number" id="number" data-zeros="true" value="1" min="1" max="1000" onchange="updateQdt(this)">
            </div>
            <!-- <div><a class="button button-lg button-secondary button-zakaria" href="cart-page.php">ADICIONAR AO CARRINHO</a></div> -->
            <form action="cart-page.php" method="post">
              <input type="hidden" name="p_id" value="<?php echo $product_id; ?>">
              <input type="hidden" name="qdt" id="qdt" value="1">
              <div><button class="button button-lg button-secondary button-zakaria" type="submit">ADICIONAR AO CARRINHO</button></div>
            </form>
          </div>
          <hr class="hr-gray-100">
          <div class="group-xs group-middle"><span class="list-social-title">Partilhar</span>
            <div>
              <ul class="list-inline list-social list-inline-sm">
                <li><a class="icon mdi mdi-facebook" href="#"></a></li>
                <li><a class="icon mdi mdi-twitter" href="#"></a></li>
                <li><a class="icon mdi mdi-instagram" href="#"></a></li>
                <li><a class="icon mdi mdi-google-plus" href="#"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap tabs-->
    <div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
      <!-- Nav tabs-->
      <div class="nav-tabs-wrap">
        <ul class="nav nav-tabs nav-tabs-1">
          <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-2" data-toggle="tab">Descrição do Produto</a></li>
          <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab">Envio e Transporte</a></li>
        </ul>
      </div>
      <!-- Tab panes-->
    </div>
    <div class="tab-pane fade show active" id="tabs-1-2">
      <div class="single-product-info">
        <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
          <div class="unit-left"><span class="icon icon-80 mdi mdi-information-outline"></span></div>
          <div class="unit-body">
            <p> <?php echo $result['description'] ?> </p>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="tabs-1-3">
      <div class="single-product-info">
        <div class="unit unit-spacing-md flex-column flex-sm-row align-items-sm-center">
          <div class="unit-left"><span class="icon icon-80 mdi mdi-truck-delivery"></span></div>
          <div class="unit-body">
            <p>Não espere eternidades pela sua encomenda! A ChipMatica vem aprimorando o seu processo de tratamento e envio de encomendas, tudo graças a uma organização perfeita entre a transação do armazém e/ou fornecedor até aos nossos clientes. Realize a sua encomenda até as 17h de um dia útil e no dia útil seguinte poderá já ter a encomenda nas suas mãos, dependendo da disponibilidade do(s) produto(s).</p>
            <p> 1- Todas as encomendas são enviadas através das transportadoras CTT ou DHL.&nbsp; </p>
            <p> 2- As encomendas são processadas em dias úteis até às 17 horas. Após a confirmação do pagamento, as encomendas são enviadas para o endereço indicado pelo cliente. As pré-encomendas, ao contrário das encomendas normais e atrás mencionadas, só serão processadas quando o produto estiver disponível por parte do fornecedor, para distribuição oficial e para cliente final.&nbsp; </p>
            <p> 3- Os custos de envio das encomendas ficam a cargo do cliente e acrescem ao valor total dos produtos selecionados. O cliente será informado destes encargos antes de confirmar o seu pedido e concluir o processo de compra, assim como da diferença de valor dependendo do meio de expedição escolhido.&nbsp; </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
<!-- Related Products-->
<section class="section section-sm section-last bg-default">
  <div class="container">
    <h4 class="font-weight-sbold">Não se esqueça de levar também</h4>
    <div class="row row-lg row-30 row-lg-50 justify-content-center">
      <div class="col-sm-6 col-md-5 col-lg-3">

        <!-- Product-->
        <?php

        while ($row = mysqli_fetch_assoc($products)) {
        ?>
          <article class="product">
            <div class="product-body">
              <div class="product-figure"><img src="Admin/img/<?php echo $row['img'] ?>" alt="" width="220" height="160" />
              </div>
              <h5 class="transform-none product-title"><a href="single-product.php?p_id=<?php echo $row['p_id'] ?>"><?php echo $row['product_name'] ?></a></h5>
              <div class="product-price-wrap">
                <div class="product-price"><?php echo $row['price'] ?> € </div>
              </div>
            </div><span </span>
              <div class="product-button-wrap">
                <div class="product-button"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a></div>
                <div class="product-button"><a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.php"></a></div>
              </div>
          </article>
      </div>
      <div class="col-sm-6 col-md-5 col-lg-3">
      <?php
        }
      ?>
      </div>
    </div>
  </div>
</section>
<!-- Page Footer-->
<?php require_once "inc/footer_2.php" ?>