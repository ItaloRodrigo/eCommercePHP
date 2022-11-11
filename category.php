<!-- Nav -->
<?php require_once "inc/nav_2.php"; ?>

<?php
//--- variáveis

$cat_id = "";
$vmin = 0;
$vmax = 999;

if (isset($_GET['id'])) {
  $cat_id = mysqli_real_escape_string($con, $_GET['id']);
}

if(isset($_GET['value-1'])&& isset($_GET['value-2'])){
  $vmin = mysqli_real_escape_string($con, $_GET['value-1']);
  $vmax = mysqli_real_escape_string($con, $_GET['value-2']);
}

$categories = all_categories();
//---
$particular_product = get_products($cat_id,'',$vmin,$vmax);
$display_cat_links = display_cat_links($cat_id);
$cont = mysqli_num_rows($particular_product);
//---

$result = mysqli_fetch_assoc($display_cat_links);
?>

<script type="text/javascript">
  function filtro_preco() {
    var vmin = document.getElementById("value-1").value;
    var vmax = document.getElementById("value-2").value;
    //---
    var produtos = document.getElementsByClassName("product");
    for (var i = 0; i < produtos.length; i++) {
      var price = produtos[i].querySelector(".price").value;
      if ((price >= vmin) && (price <= vmax)) {
        produtos[i].style.visibility = "";
      } else {
        produtos[i].style.visibility = "hidden";
      }
    }
  }
</script>

<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="assets/images/bg-shop.jpg">
    <div class="breadcrumbs-custom-body parallax-content context-dark">
      <div class="container">
        <h2 class="breadcrumbs-custom-title">Produtos</h2>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="index.php">Home</a></li>
        <li class="active"> Produtos </li>
      </ul>
    </div>
  </div>
</section>
<!-- Section Shop-->
<section class="section section-xxl bg-default text-md-left">
  <div class="container">
    <div class="row row-50">
      <div class="col-lg-4 col-xl-3">
        <div class="aside row row-30 row-md-50 justify-content-md-between">
          <div class="aside-item col-12">
            <h6 class="aside-title">Filtrar por preço</h6>
            <!-- RD Range-->
            <?php
              if(isset($_GET['value-1']) && isset($_GET['value-2'])){
                echo '<div class="rd-range" data-min="0" data-max="999" data-min-diff="5" id="range" data-start="['.$vmin.', '.$vmax.']" data-step="1" data-tooltip="false" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>';
              }else{
                echo '<div class="rd-range" data-min="0" data-max="999" data-min-diff="5" id="range" data-start="[0, 999]" data-step="1" data-tooltip="false" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>';
              }
            ?>
            <form>
              <div class="group-xs group-justify">
                <div>
                  <input type="hidden" name="id" value="<?php echo $cat_id; ?>" >
                  <button class="button button-sm button-secondary button-zakaria" type="submit">Filtrar</button>
                </div>
                <div>
                  <div class="rd-range-wrap">
                    <div class="rd-range-title">Preço:</div>
                    <div class="rd-range-form-wrap"><span>$</span>
                      <input class="rd-range-input rd-range-input-value-1" type="text" id="value-1" name="value-1">
                    </div>
                    <div class="rd-range-divider"></div>
                    <div class="rd-range-form-wrap"><span>$</span>
                      <input class="rd-range-input rd-range-input-value-2" type="text" id="value-2" name="value-2">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="aside-item col-sm-6 col-md-5 col-lg-12">
            <h6 class="aside-title">Categorias</h6>
            <ul class="list-shop-filter">
              <?php
              while ($categoria = mysqli_fetch_assoc($categories)) {
                echo "<li>";
                echo '<label class="checkbox-inline">';
                echo '<a href="category.php?id=' . $categoria['id'] . '&value-1=0&value-2=999">';
                if ($categoria['id'] == $cat_id) {
                  echo '<input name="input-group-radio" value="checkbox-1" checked="true" type="checkbox">' . $categoria['nome'];
                } else {
                  echo '<input name="input-group-radio" value="checkbox-1" type="checkbox">' . $categoria['nome'];
                }
                echo '</a>';
                echo '</label><span class="list-shop-filter-number">' . $categoria['qdt'] . '</span>';
              }
              ?>
            </ul>
            <!-- RD Search Form-->
            <form class="rd-search form-search" action="search-results.php" method="GET">
              <div class="form-wrap">
                <input class="form-input" id="search-form" type="text" name="s" autocomplete="off">
                <label class="form-label" for="search-form">Buscar na loja...</label>
                <button class="button-search fl-bigmug-line-search74" type="submit"></button>
              </div>
            </form>
          </div>
          <div class="aside-item col-sm-6 col-lg-12">
            <h6 class="aside-title">Produtos populares</h6>
            <div class="row row-10 row-lg-20 gutters-10">
              <div class="col-4 col-sm-6 col-md-12">
                <!-- Product Minimal-->
                <article class="product-minimal">
                  <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                    <div class="unit-left"><a class="product-minimal-figure" href="single-product.php"><img src="assets/images/product-mini-1-106x104.png" alt="" width="106" height="104" /></a></div>
                    <div class="unit-body">
                      <p class="product-minimal-title"><a href="single-product.php">Grex T2 Headphones</a></p>
                      <p class="product-minimal-price">$25.00</p>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-4 col-sm-6 col-md-12">
                <!-- Product Minimal-->
                <article class="product-minimal">
                  <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                    <div class="unit-left"><a class="product-minimal-figure" href="single-product.php"><img src="assets/images/product-mini-2-106x104.png" alt="" width="106" height="104" /></a></div>
                    <div class="unit-body">
                      <p class="product-minimal-title"><a href="single-product.php">Smartex GR8</a></p>
                      <p class="product-minimal-price">$30.00</p>
                    </div>
                  </div>
                </article>
              </div>
              <div class="col-4 col-sm-6 col-md-12">
                <!-- Product Minimal-->
                <article class="product-minimal">
                  <div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
                    <div class="unit-left"><a class="product-minimal-figure" href="single-product.php"><img src="assets/images/product-mini-3-106x104.png" alt="" width="106" height="104" /></a></div>
                    <div class="unit-body">
                      <p class="product-minimal-title"><a href="single-product.php">MITO SX8 Tablet</a></p>
                      <p class="product-minimal-price">$20.00</p>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-xl-9">
        <div class="product-top-panel group-md">
          <p class="product-top-panel-title">Mostrando <?php echo $cont; ?> resultado (s) </p>
          <div>
            <div class="group-sm group-middle">
              <div class="product-top-panel-sorting">
                <select>
                  <option value="1">Sort by newness</option>
                  <option value="2">Sort by popularity</option>
                  <option value="3">Sort by alphabet</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row row-30 row-lg-50">
          <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
            <!-- Product-->
            <?php

            if (mysqli_num_rows($particular_product)) {

              while ($row = mysqli_fetch_assoc($particular_product)) {
            ?>
                <article class="product">
                  <div class="product-body">
                    <div class="product-figure"><img src="Admin/img/<?php echo $row['img'] ?>" alt="" width="220" height="160" />
                    </div>
                    <h5 class="transform-none product-title"><a href="single-product.php?p_id=<?php echo $row['p_id'] ?>"><?php echo $row['product_name'] ?></a></h5>
                    <div class="product-price-wrap">
                      <div class="product-price">
                        <input type="hidden" class="price" value="<?php echo $row['price'] ?>">
                        <?php echo $row['price'] ?> €
                      </div>
                    </div>
                  </div>
                  <span></span>
                  <div class="product-button-wrap">
                    <div class="product-button px-2"><a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.php?p_id=<?php echo $row['p_id'] ?>"></a></div>
                    <form action="cart-page.php" method="post">
                      <input type="hidden" name="p_id" value="<?php echo $row['p_id'] ?>">
                      <div class="product-button px-2"><button class="button button-primary button-zakaria fl-bigmug-line-shopping202" type="submit"></button></div>                  
                    </form>
                    
                  </div>
                </article>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4">
        <?php
              }
            } else {
              echo "Não foram Encontrados Resultados";
            }
        ?>
          </div>
        </div>
        <div class="pagination-wrap">
          <!-- Bootstrap Pagination-->
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <li class="page-item page-item-control disabled"><a class="page-link" href="#" aria-label="Previous"><span class="icon" aria-hidden="true"></span></a></li>
              <li class="page-item active"><span class="page-link">1</span></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item page-item-control"><a class="page-link" href="#" aria-label="Next"><span class="icon" aria-hidden="true"></span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Footer-->
<?php require_once "inc/footer_2.php" ?>