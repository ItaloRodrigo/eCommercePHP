<?php
require_once "inc/header.php";
$value = view_products();
active_status_product();

?>
<?php require_once "inc/nav.php";?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Editar Produtos</div>
            </div>
            <div class="ibox-body">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">ID do Produto</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center"> Nome do Produto</th>
                        <th class="text-center"> Imagem</th>
                        <th class="text-center"> MRP</th>
                        <th class="text-center"> Preço</th>
                        <th class="text-center"> Quantidade</th>
                        <th class="text-center"> Descrição</th>
                        <th class="text-center"> Estado</th>
                        <th class="text-center" colspan="3">Operações</th>
                    </tr>

                    <tr>
                        <?php


                        while($row = mysqli_fetch_assoc($value))
                        {
                        ?>

                        <td><?php echo $row['p_id']; ?></td>
                        <td><?php echo $row['cat_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><img src="img/<?php echo $row['img'] ?>" width="50px" height="50px" class="image-circle"></td>
                        <td><?php echo $row['MRP']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $row['description']; ?></td>

                        <td>
                            <?php

                            if($row['status']=='1')
                            {
                                echo "Ativo";
                            }
                            else
                            {
                                echo "Desativo";
                            }
                            ?>
                        </td>
                        <td class="text-center">

                            <?php

                            if($row['status']=='1')
                            {
                                echo "<a href='manage_product.php?opr=deactive&id=".$row['p_id']."'class='btn btn-success'>Desativar</a>";
                            }
                            else
                            {
                                echo "<a href='manage_product.php?opr=active&id=".$row['p_id']."'class='btn btn-success'>Ativar</a>";
                            }
                            ?>



                            <a href="edit_product.php?id=<?php echo $row['p_id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="del_product.php?id=<?php echo $row['p_id'] ?>" class="btn btn-danger">Apagar</a>
                        </td>

                    </tr>

                    <?php
                    }
                    ?>




                    </tr>




                    <?php
                    while($row=mysqli_fetch_assoc($value))
                    {
                        echo $row['cat_name'];
                    }
                    ?>

                    </thead>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2022 © <b>ChipMatica</b> - Todos os Direitos Reservados.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>

<?php require_once "inc/footer.php";?>
