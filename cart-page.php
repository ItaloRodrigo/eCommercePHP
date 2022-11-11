
<?php
require_once 'functions/functions.php';

if (isset($_POST['p_id'])) {
  if(isset($_POST['qdt'])){
    $qdt = mysqli_real_escape_string($con, $_POST['qdt']);
  }else{
    $qdt = 1;
  }
  $id_prod = mysqli_real_escape_string($con, $_POST['p_id']);
  //---
  if (!isProdutoCarrinho($id_prod)) {
    addProdutoCarrinho($id_prod, $qdt);
  }
}

// if((isset($_GET['id_prod'])) && (isset($_GET['qdt']))){
//   $id_prod = mysqli_real_escape_string($con, $_GET['id_prod']);
//   $qdt = mysqli_real_escape_string($con, $_GET['qdt']);
//   //---
//   updateProdutoCarrinho($id_prod,$qdt);
// }

// $produtos = getProdutoCarrinho();


?>

<!-- Nav -->

<?php require_once "inc/nav_2.php" ?>



<script>
  // function teste(id_prod,obj) {
  //   var id = obj.getAttribute("id");
  //   var price = document.getElementById("p" + id).innerHTML;
  //   var prices = null;
  //   var total = 0;
  //   //---
  //   document.getElementById("l" + id).innerHTML = (price * obj.value).toFixed(2);
  //   //---
  //   prices = document.querySelectorAll("#table-price .l-price");
  //   //---
  //   for (i = 0; i < prices.length; i++) {
  //     total = (Number(total) + Number(prices[i].innerHTML));
  //   }
  //   //---
  //   this.addCarrinho(id_prod,obj.value);
  //   //---
  //   document.getElementById("total").innerHTML = total.toFixed(2);
  //   document.getElementById("nav-total").innerHTML = total.toFixed(2);
  // }

  // function addCarrinho(id_prod,qdt) {
  //   var xhttp = new XMLHttpRequest();
  //   xhttp.open("GET", "cart-page.php?id_prod="+id_prod+"&qdt="+qdt);
  //   // xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  //   xhttp.onreadystatechange = function() {
  //     if (this.readyState == 4 && this.status == 200) {
  //       // Response
  //       // var response = this.responseText;

  //     }
  //   };
  //   xhttp.send();
  // }
</script>

<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="assets/images/bg-shop.jpg">
    <div class="breadcrumbs-custom-body parallax-content context-dark">
      <div class="container">
        <h2 class="breadcrumbs-custom-title">Cart Page</h2>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php">Shop</a></li>
        <li class="active">Cart Page</li>
      </ul>
    </div>
  </div>
</section>
<!-- Shopping Cart-->
<section class="section section-xl bg-default">
  <div class="container">
    <!-- shopping-cart-->
    <div class="table-custom-responsive">
      <table class="table-custom table-cart" id="table-price">
        <thead>
          <tr>
            <th>Produtos</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          foreach ($produtos as $key => $produto) {
            echo '<tr>';
            echo '<td><a class="table-cart-figure" href="single-product.php?p_id=' . $produto[1]['p_id'] . '"><img src="Admin/img/' . $produto[1]['img'] . '" alt="" width="146" height="132" /></a><a class="table-cart-link" href="single-product.php?p_id=' . $produto[1]['p_id'] . '">' . $produto[1]['product_name'] . '</a></td>';
            echo '<td>$<label id="p' . $key . '">' . $produto[1]['price'] . '</label></td>';
            echo '
                    <td>
                      <div class="table-cart-stepper">
                        <input class="form-input numb'.$key.'" type="number" data-zeros="true" value="'.$produto[2].'" min="0" id="' . $key . '" max="1000" onchange="teste('.$produto[1]['p_id'].',this)">
                      </div>
                    </td>              
              ';
            echo '<td>$<label class="l-price" id="l' . $key . '">' . ($produto[1]['price'] * $produto[2]) . '</label></td>';
            echo '</tr>';

            $total = $total + ($produto[1]['price'] * $produto[2]);
          }

          ?>
        </tbody>
      </table>
    </div>
    <div class="group-xl group-justify justify-content-center justify-content-md-between">
      <div>
        <form class="rd-form rd-mailform rd-form-inline rd-form-coupon">
          <div class="form-wrap">
            <input class="form-input form-input-inverse" id="coupon-code" type="text" name="code">
            <label class="form-label" for="coupon-code">Cupam de Desconto</label>
          </div>
          <div class="form-button">
            <button class="button button-lg button-secondary button-zakaria" type="submit">Aplicar</button>
          </div>
        </form>
      </div>
      <div>
        <div class="group-xl group-middle">
          <div>
            <div class="group-md group-middle">
              <div class="heading-5 font-weight-medium text-gray-500">Total</div>
              <div class="heading-3 font-weight-normal">$<label id="total"><?php echo $total; ?></label></div>
            </div>
          </div><a class="button button-lg button-primary button-zakaria" href="checkout.php">Comprar</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Footer-->
<?php require_once "inc/footer_2.php" ?>