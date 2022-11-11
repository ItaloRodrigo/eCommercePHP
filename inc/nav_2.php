<?php
require_once 'functions/functions.php';
$categories = getNavCategories();

// var_dump($categories);

if ((isset($_GET['id_prod'])) && (isset($_GET['qdt']))) {
    $id_prod = mysqli_real_escape_string($con, $_GET['id_prod']);
    $qdt = mysqli_real_escape_string($con, $_GET['qdt']);
    //---
    updateProdutoCarrinho($id_prod, $qdt);
}

$cont_produtos = count(getProdutoCarrinho());
$price_total = priceTotal();

$produtos = getProdutoCarrinho();

?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Chipmatica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CLato%7CKalam:300,400,700">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .ie-panel {
            display: none;
            background: #212121;
            padding: 10px 0;
            box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
            clear: both;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        html.ie-10 .ie-panel,
        html.lt-ie-10 .ie-panel {
            display: block;
        }
    </style>
</head>

<body>

    <script>
        function teste(id_prod, obj) {
            var id = obj.getAttribute("id");
            var price = document.getElementById("p" + id).value;
            var prices = null;
            var ls = null;
            var total = 0;
            //---
            var numbers = document.querySelectorAll(".numb" + id);
            //---
            for (var i = 0; i < numbers.length; i++) {
                numbers[i].value = obj.value;
            }
            //---
            ls = document.querySelector("#cart-price #l" + id);
            if (ls !== null) {
                ls.innerHTML = (price * obj.value).toFixed(2);
            }
            ls = document.querySelector("#table-price #l" + id);
            if (ls !== null) {
                ls.innerHTML = (price * obj.value).toFixed(2);
            }
            //---
            this.addCarrinho(id_prod, obj.value);
            //---
            prices = document.querySelectorAll("#cart-price .l-price");
            //---
            if (prices.length > 0) {
                total = calcTotal(prices);
                document.getElementById("nav-total").innerHTML = total.toFixed(2);
            }
            //---
            prices = document.querySelectorAll("#table-price .l-price");
            //---
            if (prices.length > 0) {
                total = calcTotal(prices);
                document.getElementById("total").innerHTML = total.toFixed(2);
            }
        }

        function calcTotal(prices) {
            var total = 0;
            for (i = 0; i < prices.length; i++) {
                total = (Number(total) + Number(prices[i].innerHTML));
            }
            return total;
        }

        function addCarrinho(id_prod, qdt) {
            var xhttp = new XMLHttpRequest();
            var url = window.location.origin + window.location.pathname;
            console.log(url + "?id_prod=" + id_prod + "&qdt=" + qdt);
            xhttp.open("GET", url + "?id_prod=" + id_prod + "&qdt=" + qdt);
            // xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Response
                    console.log("result ok!");
                }
            };
            xhttp.send();
            //---
            if (qdt == 0) {
                window.location.href = url + "?id_prod=" + id_prod + "&qdt=" + qdt;
                window.location.href = url;
                // document.location.reload(true);
            }
        }
    </script>

    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="assets/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
        <div class="preloader-body">
            <div class="cssload-bell">
                <div class="cssload-circle">
                    <div class="cssload-inner0"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner0"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner0"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner0"></div>
                </div>
                <div class="cssload-circle">
                    <div class="cssload-inner0"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <!-- Page Header-->
        <header class="section page-header">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="100px" data-xl-stick-up-offset="100px" data-xxl-stick-up-offset="100px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-main-outer">
                        <div class="rd-navbar-main">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!-- RD Navbar Brand-->
                                <div class="rd-navbar-brand">
                                    <!--Brand--><a class="brand" href="index.php"><img class="brand-logo-dark" src="assets/images/logo-default-1-242x53.png" alt="" width="242" height="53" /><img class="brand-logo-light" src="assets/images/logo-inverse-1-242x53.png" alt="" width="242" height="53" /></a>
                                </div>
                            </div>
                            <div class="rd-navbar-nav-wrap">
                                <ul class="rd-navbar-nav">
                                    <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="rd-nav-item"><a class="rd-nav-link" href="category.php?value-1=0&value-2=999">Categorias</a>
                                        <ul class="rd-menu rd-navbar-megamenu">

                                            <?php
                                            if (count($categories) > 0) {
                                                foreach ($categories as $key => $categorie) {
                                                    echo '<li class="rd-megamenu-item rd-megamenu-item-1">';
                                                    echo '  <h6 class="rd-megamenu-title"><span class="rd-megamenu-icon mdi mdi-apps"></span><span class="rd-megamenu-text">' . $categorie['type'] . '</span></h6>';
                                                    echo '  <ul class="rd-megamenu-list">';
                                                    foreach ($categorie['categories'] as $value) {
                                                        echo '<li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="category.php?id=' . $value['id'] . '">' . $value['cat_name'] . '</a></li>';
                                                    }
                                                    echo '  </ul>';
                                                    echo '</li>';
                                                }
                                            }
                                            ?>
                                            <!-- <li class="rd-megamenu-item rd-megamenu-item-4">
                                                <h6 class="rd-megamenu-title"><span class="rd-megamenu-icon mdi mdi-layers"></span><span class="rd-megamenu-text">Informática</span></h6>
                                                <ul class="rd-megamenu-list">
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="404-page.php">Caixas e Fontes</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="coming-soon.php">Cooling</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="privacy-policy.php">Discos</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="search-results.php">Memórias</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="search-results.php">Motherboard</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="search-results.php">Processadores</a></li>
                                                    <li class="rd-megamenu-list-item"><a class="rd-megamenu-list-link" href="search-results.php">Placas Gráficas</a></li>
                                                </ul>
                                            </li> -->

                                            <!-- <li class="rd-megamenu-item rd-megamenu-item-1">
                                                <h6 class="rd-megamenu-title"><span class="rd-megamenu-icon mdi mdi-apps"></span><span class="rd-megamenu-text">Elétronica</span></h6>
                                                <ul class="rd-megamenu-list">

                                                    
                                                </ul>
                                            </li>
                                            
                                            <li class="rd-megamenu-item rd-megamenu-banner">
                                                <div class="rd-megamenu-title"><span class="rd-megamenu-icon mdi mdi-laptop-mac"></span><span class="rd-megamenu-text">Serviços de Reparação</span></div><a class="banner-classic" href="grid-shop.php"><img src="assets/images/banner-1-300x202.jpg" alt="" width="300" height="202" /></a>
                                            </li> -->
                                        </ul>
                                    </li>
                                    <li class="rd-nav-item"><a class="rd-nav-link" href="#">Mais Vendidos</a>
                                        <ul class="rd-menu rd-navbar-dropdown">
                                            <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="about-us.php">Elétronica</a>
                                            </li>
                                            <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="our-team.php">Informática</a>
                                            </li>
                                            <li class="rd-dropdown-item"><a class="rd-dropdown-link" href="testimonials.php">Ferramentas</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="rd-nav-item"><a class="rd-nav-link" href="masonry-fullwidth-gallery.php">Novidades</a>
                                    </li>

                                    <li class="rd-nav-item"><a class="rd-nav-link" href="grid-blog.php">Blog</a>
                                    </li>
                                    <li class="rd-nav-item"><a class="rd-nav-link" href="contact-us.php">Contactos</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="rd-navbar-main-element">
                                <!-- RD Navbar Search-->
                                <div class="rd-navbar-search rd-navbar-search-2">
                                    <button class="rd-navbar-search-toggle rd-navbar-fixed-element-3" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                                    <form class="rd-search" action="search-results.php" data-search-live="rd-search-results-live" method="GET">
                                        <div class="form-wrap">
                                            <input class="rd-navbar-search-form-input form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off" />
                                            <label class="form-label" for="rd-navbar-search-form-input">Pesquisar...</label>
                                            <div class="rd-search-results-live" id="rd-search-results-live"></div>
                                            <button class="rd-search-form-submit fl-bigmug-line-search74" type="submit"></button>
                                        </div>
                                    </form>
                                </div>
                                <!-- RD Navbar Basket-->
                                <div class="rd-navbar-basket-wrap">
                                    <button class="rd-navbar-basket fl-bigmug-line-shopping202" data-rd-navbar-toggle="#carrinho"><span><?php echo $cont_produtos; ?></span></button>
                                    <div class="cart-inline" id="carrinho">
                                        <div class="cart-inline-header">
                                            <h5 class="cart-inline-title">No carrinho:<span> <?php echo $cont_produtos; ?></span> Produtos</h5>
                                            <h6 class="cart-inline-title">Valor Total:<span id="nav-total"> $ <?php echo $price_total; ?></span></h6>
                                        </div>
                                        <div class="cart-inline-body" id="cart-price">

                                            <?php
                                            foreach ($produtos as $key => $produto) {
                                                echo '<div class="cart-inline-item">';
                                                echo '  <div class="unit unit-spacing-sm align-items-center">';
                                                echo '      <div class="unit-left"><a class="cart-inline-figure" href="single-product.php"><img src="assets/images/product-mini-6-100x90.png" alt="" width="100" height="90" /></a></div>';
                                                // echo '      <div class="unit-left"><a class="cart-inline-figure" href="single-product.php?p_id=' . $produto[1]['p_id'] . '"><img src="Admin/img/' . $produto[1]['img'] . '" alt="" width="100" height="90" /></a></div>';
                                                echo '          <div class="unit-body">';
                                                echo '              <h6 class="cart-inline-name"><a href="single-product.php">' . $produto[1]['product_name'] . '</a></h6>';
                                                echo '              <div>';
                                                echo '                  <div class="group-xs group-middle">';
                                                echo '                      <div class="table-cart-stepper">';
                                                echo '                          <input class="form-input numb' . $key . '" type="number" data-zeros="true" value="' . $produto[2] . '" min="0" id="' . $key . '" max="1000" onchange="teste(' . $produto[1]['p_id'] . ',this)">';
                                                echo '                      </div>';
                                                echo '                      <input type="hidden" id="p' . $key . '" value="' . $produto[1]['price'] . '" >';
                                                echo '                      <h6 class="cart-inline-title" >$<label class="l-price" id="l' . $key . '">' . ($produto[1]['price'] * $produto[2]) . '</label></h6>';
                                                echo '                  </div>';
                                                echo '              </div>';
                                                echo '          </div>';
                                                echo '  </div>';
                                                echo '</div>';
                                            }

                                            ?>
                                        </div>
                                        <div class="cart-inline-footer">
                                            <div class="group-sm">
                                                <a class="button button-default-outline-2 button-zakaria" href="cart-page.php">Carrinho</a>
                                                <a class="button button-primary button-zakaria" href="checkout.php">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <a class="rd-navbar-basket rd-navbar-basket-mobile fl-bigmug-line-shopping202 rd-navbar-fixed-element-2" href="cart-page.php"><span>2</span></a> -->
                                <button class="rd-navbar-project-hamburger rd-navbar-project-hamburger-open rd-navbar-fixed-element-1" type="button" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate"><span class="project-hamburger"><span class="project-hamburger-line"></span><span class="project-hamburger-line"></span><span class="project-hamburger-line"></span><span class="project-hamburger-line"></span></span></button>
                                <!-- Login/Registo-->
                                <div class="rd-navbar-basket-wrap">
                                    <button class="rd-navbar-basket fl-bigmug-line-user144" data-rd-navbar-toggle="#login"></button>
                                    <div class="cart-inline" id="login">
                                        <div class="cart-inline-body">
                                            <div class="cart-inline-item">
                                                <form>
                                                    <div class="form-group">
                                                        <h6 for="exampleInputEmail1">Email</h6>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <h6 for="exampleInputPassword1" class="form-text">Senha</h6>
                                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label for="exampleCheck1">
                                                            <small class="form-text text-muted">Check me out</small>
                                                        </label>

                                                        <!-- <label class="cart-inline-title" for="exampleCheck1">Check me out</label> -->
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rd-navbar-project">
                                <div class="rd-navbar-project-header">
                                    <button class="rd-navbar-project-hamburger rd-navbar-project-hamburger-close" type="button" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate><span class="project-close"><span></span><span></span></span></button>
                                    <h5 class="rd-navbar-project-title">Our Contacts</h5>
                                </div>
                                <div class="rd-navbar-project-content">
                                    <div>
                                        <div>
                                            <!-- Owl Carousel-->
                                            <div class="owl-carousel" data-items="1" data-dots="true" data-autoplay="true"><img src="assets/images/about-5-350x269.jpg" alt="" width="350" height="269" /><img src="assets/images/about-6-350x269.jpg" alt="" width="350" height="269" /><img src="assets/images/about-7-350x269.jpg" alt="" width="350" height="269" />
                                            </div>
                                            <ul class="contacts-modern">
                                                <li><a href="#">523 Sylvan Ave, 5th Floor<br>Mountain View, CA 94041 USA</a></li>
                                                <li><a href="tel:#">+1 (844) 123 456 78</a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="list-inline list-social list-inline-xl">
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
                    </div>
                </nav>
            </div>
        </header>