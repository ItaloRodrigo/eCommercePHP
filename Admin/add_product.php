<?php require_once ("inc/header.php"); ?>
<?php
    require_once ("inc/nav.php");

    $cat=view_cat();
    save_products();
?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Produtos</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Adicionar Produto</label>
                    </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select name="cat_id" id="" class="form-control">
                                    <option value="">Esolher uma Categoria</option>
                                    <?php

                                        while($row = mysqli_fetch_assoc($cat))
                                        {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                                    <?php
                                        }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="product_name" placeholder="Nome do Produto" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="mrp" placeholder="MRP" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="price" placeholder="Preço" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="qty" placeholder="Quantidade" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="file" class="form-control" type="text" name="img" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                               <textarea id="" name="desc" cols="30" rows="10" class="form-control" placeholder="Descrição do Produto" required></textarea>
                            </div>
                        </div>
                    </div>
            <button class="btn btn-info my-4 mx-4" type="submit" name="pro_btn">Criar Produto</button>
                </form>
            </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php
                    display_message();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2022 © <b>ChipMatica</b> - Todos os Direitos Reservados.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>
<?php require_once ("inc/footer.php"); ?>
