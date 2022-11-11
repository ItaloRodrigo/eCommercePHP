<?php require_once("inc/header.php"); ?>
<?php require_once("inc/nav.php"); ?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Categorias</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="category">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tipos de Categorias</label>
                        <div class="col-sm-10">
                            <select name="type_category" id="type_category" class="form-control">
                                <?php
                                $type_categories = getTypeCategories();
                                foreach ($type_categories as $value) {
                                    echo '<option value="' . $value['id'] . '">' . $value['cat_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <button class="btn btn-info" type="submit" name="cat_btn">Criar Categoria</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                add_category();
                display_message();
                ?>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2022 © <b>ChipMatica</b> - Todos os Direitos Reservados.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>
<?php require_once("inc/footer.php"); ?>