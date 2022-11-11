<?php
require_once "inc/header.php";

?>
<?php require_once "inc/nav.php"; ?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Editar Categorias</div>
            </div>
            <div class="ibox-body">
                <div class="card mb-2 border-0">
                    <div class="card-body rounded-3">
                        <div class="row">
                            <div class="col-4">
                                <h6 class="card-text m-0 p-0">Nome</h6>
                            </div>
                            <div class="col-1">
                                <h6 class="card-text m-0 p-0">Fone</h6>
                            </div>
                            <div class="col-1">
                                <h6 class="card-text m-0 p-0 text-center">Data de envio</h6>
                            </div>
                            <div class="col-4">
                                <h6 class="card-text m-0 p-0 text-center">Mensagem</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="card-text m-0 p-0 text-center">Ação</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="m-0 p-0">
                    <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page=1;
                    }
                    //---
                    $count = contactAll();
                    var_dump($count);
                    $contatos = contact($page);
                    $totalrows = $count['qdt'];
                    $pages = $totalrows/6;
                    //---
                    foreach ($contatos as $key => $contato) {
                    ?>
                        <li class="card mb-2 bg-light border-0">
                            <div class="card-body rounded-3">
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class="card-text m-0 p-0"><?php echo $contato['first_name'] . " " . $contato['last_name']; ?></h6>
                                        <span class="card-subtitle m-0 p-0 text-muted"><?php echo $contato['email']; ?></span>
                                    </div>
                                    <div class="col-1">
                                        <p class="card-text"><?php echo $contato['contato']; ?></p>
                                    </div>
                                    <div class="col-1">
                                        <p class="card-text text-center"><?php echo $contato['created']; ?></p>
                                    </div>
                                    <div class="col-4">
                                        <p class="card-text text-center"><?php echo $contato['text']; ?></p>
                                    </div>
                                    <div class="col-2 text-center">
                                        <a href='del_contact.php?id=<?php echo $contato['contact_id']; ?> ' class="btn btn-danger rounded-circle ">Apagar</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php  
                            for($i = 0; $i < $pages; $i++){
                                if($page == $i){
                                    echo '<li class="page-item"><a class="page-link active" href="contact.php?page='.$i.'">'.($i+1).'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a class="page-link" href="contact.php?page='.$i.'">'.($i+1).'</a></li>';
                                }                                
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2022 © <b>ChipMatica</b> - Todos os Direitos Reservados.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>

<?php require_once "inc/footer.php"; ?>