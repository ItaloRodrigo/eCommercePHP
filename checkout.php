<!-- Nav -->
<?php
require_once "inc/nav_2.php";

if (isset($_POST['p_id'])) {
  if (isset($_POST['qdt'])) {
    $qdt = mysqli_real_escape_string($con, $_POST['qdt']);
  } else {
    $qdt = 1;
  }
  $id_prod = mysqli_real_escape_string($con, $_POST['p_id']);
  //---
  if (!isProdutoCarrinho($id_prod)) {
    addProdutoCarrinho($id_prod, $qdt);
  }
}

?>

<section class="breadcrumbs-custom">
  <div class="parallax-container" data-parallax-img="images/bg-shop.jpg">
    <div class="breadcrumbs-custom-body parallax-content context-dark">
      <div class="container">
        <h2 class="breadcrumbs-custom-title">Checkout</h2>
      </div>
    </div>
  </div>
  <div class="breadcrumbs-custom-footer">
    <div class="container">
      <ul class="breadcrumbs-custom-path">
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php">Shop</a></li>
        <li class="active">Checkout</li>
      </ul>
    </div>
  </div>
</section>
<!-- Section checkout form-->
<section class="section section-sm section-first bg-default text-md-left">
  <div class="container text-center">
    <div class="row row-50 justify-content-center">
      <div class="col-md-10 col-lg-6">
        <h3 class="font-weight-medium">Endereço de Entrega</h3>
        <form class="rd-form rd-mailform form-checkout">
          <div class="row row-30">
            <div class="col-sm-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-first-name-1" type="text" name="first-name" data-constraints="@Required" />
                <label class="form-label" for="checkout-first-name-1">Primeiro Nome</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-last-name-1" type="text" name="last-name" data-constraints="@Required" />
                <label class="form-label" for="checkout-last-name-1">Último Nome</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-wrap">
                <input class="form-input" id="checkout-address-1" type="text" name="address" data-constraints="@Required" />
                <label class="form-label" for="checkout-address-1">Morada 1</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-wrap">
                <input class="form-input" id="checkout-address-2" type="text" name="address" />
                <label class="form-label" for="checkout-address-2">Morada 2</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-zip-1" type="text" name="zip" data-constraints="@Required" />
                <label class="form-label" for="checkout-zip-1">Código Postal</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-city-1" type="text" name="city" data-constraints="@Required" />
                <label class="form-label" for="checkout-city-1">Região/Cidade</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-email-1" type="email" name="email" data-constraints="@Email @Required" />
                <label class="form-label" for="checkout-email-1">E-Mail</label>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-wrap">
                <input class="form-input" id="checkout-phone-1" type="text" name="phone" data-constraints="@Numeric" />
                <label class="form-label" for="checkout-phone-1">Contacto</label>
              </div>
            </div>
          </div>
          <label class="checkbox-inline text-transform-capitalize">
            <input name="input-checkbox" value="checkbox-1" type="checkbox" />Endereço de Envio e Faturação é o mesmo
          </label>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Shopping Cart-->
<section class="section section-sm bg-default text-md-left">
  <div class="container">
    <h3 class="font-weight-medium">Carrinho de Compras</h3>
    <div class="table-custom-responsive">
      <table class="table-custom table-cart">
        <thead>
          <tr>
            <th>Produto</th>
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
                        <input class="form-input numb' . $key . '" type="number" data-zeros="true" value="' . $produto[2] . '" min="0" id="' . $key . '" max="1000" onchange="teste(' . $produto[1]['p_id'] . ',this)">
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
  </div>
</section>
<!-- Section Payment-->
<section class="section section-sm section-last bg-default text-md-left">
  <div class="container">
    <div class="row row-50 justify-content-center">
      <div class="col-md-10 col-lg-6">
        <h3 class="font-weight-medium">Métodos de Pagamento</h3>
        <div class="box-radio">
          <div class="radio-panel">
            <label class="radio-inline active">
              <input name="input-group-radio" value="checkbox-1" type="radio" checked>Transferência Bancária SEPA
            </label>
            <div class="radio-panel-content">
              <p>Faça o Pagamento por Transferência Bancária. Por favor use o ID da Encomenda na Referência da transferência, para que seja possível identificar e registar o seu Pagamento. <br> * Esta forma de Pagamento pode levar até 48H úteis a ser processada; <br> * Para um Processamento mais célere envie o Comprovativo por E-mail acompanhado do ID da Encomenda</p>
            </div>
          </div>
          <div class="radio-panel">
            <label class="radio-inline">
              <input name="input-group-radio" value="checkbox-1" type="radio">Referência Bancária
            </label>
            <div class="radio-panel-content">
              <p>Pague através do Multibanco ou HomeBanking.<br> * Esta Forma de Pagamento é processada de forma Instântanea.</p>
            </div>
          </div>
          <div class="radio-panel">
            <label class="radio-inline">
              <input name="input-group-radio" value="checkbox-1" type="radio">MBWAY
            </label>
            <div class="radio-panel-content">
              <p>Pague através do seu Smartphonede com apenas 1 Click.<br> * Esta Forma de Pagamento é processada de forma Instântanea.</p>
            </div>
          </div>
          <div class="radio-panel">
            <label class="radio-inline">
              <input name="input-group-radio" value="checkbox-1" type="radio">Cartão de Crédito/Débito
            </label>
            <div class="radio-panel-content">
              <p>Pague através do seu Smartphonede com apenas 1 Click.<br> * Esta Forma de Pagamento é processada de forma Instântanea.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-10 col-lg-6">
        <h3 class="font-weight-medium">Cart total</h3>
        <div class="table-custom-responsive">
          <table class="table-custom table-custom-primary table-checkout">
            <tbody>
              <tr>
                <td>Cart Subtotal</td>
                <td>$43</td>
              </tr>
              <tr>
                <td>Shipping</td>
                <td>Free</td>
              </tr>
              <tr>
                <td>Total</td>
                <td>$43</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Page Footer-->
<?php require_once "inc/footer_2.php" ?>