<?php require_once ("inc/header.php"); ?>
<?php
require_once ("inc/nav.php");

$cat=view_cat();
$edit_product = edit_record();

while($row=mysqli_fetch_assoc($edit_product))
{
    $product_id = $row['p_id'];
    $category_id = $row['category_name'];
    $product_name = $row['product_name'];
    $mrp = $row['MRP'];
    $price = $row['price'];
    $qty = $row['qty'];
    $img = $row['img'];
    $description = $row['description'];



}
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
                        <label class="col-sm-2 col-form-label">Editar Produto</label>
                        <?php
                        update_record();
                        ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <select name="cat_id" id="" class="form-control">
                                <option value="">Esolher uma Categoria</option>
                                <?php

                                while($row = mysqli_fetch_assoc($cat))
                                {
                                    if($category_id==$row['id'])
                                    {
                                    ?>
                                    <option selected value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="hidden" name="product_id" placeholder="Nome do Produto" value="<?php echo $product_id ?>">
                            <input class="form-control" type="text" name="product_name" placeholder="Nome do Produto" value="<?php echo $product_name ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="mrp" placeholder="MRP" value="<?php echo $mrp ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="price" placeholder="Preço" value="<?php echo $price ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="qty" placeholder="Quantidade" value="<?php echo $qty ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="file" class="form-control" type="text" name="img" value="<?php echo $img ?>">
                            <img src="img/<?php echo $img ?>" width="50px" height="50px" class="image-circle">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <textarea id="" name="desc" cols="30" rows="10" class="form-control" placeholder="Descrição do Produto" required><?php echo $description ?></textarea>
                        </div>
                    </div>
            </div>
            <button class="btn btn-info my-4 mx-4" type="submit" name="pro_btn_edit">Guardar Alterações</button>
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
