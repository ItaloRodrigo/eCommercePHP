<?php
//Set Session Message
function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION["MESSAGE"] = $msg;
    } else {
        $msg = "";
    }
}

// Display Message
function display_message()
{
    if (isset($_SESSION["MESSAGE"])) {
        echo $_SESSION["MESSAGE"];
        unset($_SESSION["MESSAGE"]);
    }
}

//Mensagem de Erro
function display_error($error)
{
    return "<span class= 'alert alert-danger text-center'>$error</span>";
}

// Sucess Message
function display_sucess($success)
{
    return "<span class= 'alert alert-sucess text-center'>$success</span>";
}

// get safe value
function safe_value($con, $value)
{
    return mysqli_real_escape_string($con, $value);
}


//Sistema Verificação de Login
function login_system()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_login'])) {
        global $con;
        $username = safe_value($con, $_POST['username']);
        $password = safe_value($con, $_POST['password']);

        if (empty($username) || empty($password)) {
            set_message(display_error("Por Favor Preencha os Campos"));
        } else {
            // query
            $query = "SELECT * FROM users where username='$username' or email='$username' AND password = '$password'";
            $result = mysqli_query($con, $query);

            if (mysqli_fetch_assoc($result)) {
                $_SESSION['ADMIN'] = $username;
                header("location: ./dashboard.php");
            } else {
                set_message(display_error("Password ou Username Incorreto"));
            }
        }
    }
}

// Adicionar Categorias
function add_category()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_btn'])) {
        global $con;
        $category = safe_value($con, $_POST['category']);
        $type_category = safe_value($con, $_POST['type_category']);

        if (empty($category)) {
            set_message(display_error("Por favor escreva um nome para a Categoria"));
        } else {
            $sql = "SELECT * FROM categories where cat_name='$category'";
            $check = mysqli_query($con, $sql);

            if (mysqli_fetch_assoc($check)) {
                set_message(display_sucess("A Categoria já existe :) "));
            } else {

                $query = "insert into categories(id_type_categorie,cat_name,status) values($type_category,'$category','1')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    set_message(display_sucess("Categoria adicionado com Sucesso"));
                    echo "<a href='manage_category.php'> Ver Categorias</a>";
                }
            }
        }
    }
}

function getTypeCategories(){
    global $con;
    $sql = "SELECT * FROM type_categories where status=1";
    $result = mysqli_query($con, $sql);
    return $result;
}

// Ver Categorias
function view_cat()
{
    global $con;
    $sql = "SELECT * FROM categories";
    return mysqli_query($con, $sql);
}


//Activar e Desativar Artigos

function active_status()
{
    global $con;
    if (isset($_GET['opr']) && $_GET['opr'] != "") {
        $operation = safe_value($con, $_GET['opr']);
        $id = safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $query = "update categories set status='$status' where id='$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("Location:manage_category.php");
        }
    }
}


// Update Categorias
function update_cat()
{
    global $con;
    if (isset($_POST['cat_btn_up'])) {
        $category_name = safe_value($con, $_POST['category_up']);
        $id = safe_value($con, $_POST['cat_id']);

        if (!empty($category_name)) {
            $sql = "update categories set cat_name='$category_name' where id='$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("location:manage_category.php");
            }
        }
    }
}

//--------------------------------------Pagina Produtos------------------------------------------------//

function save_products()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn'])) {
        $cat_id = safe_value($con, $_POST['cat_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $mrp = safe_value($con, $_POST['mrp']);
        $price = safe_value($con, $_POST['price']);
        $qty = safe_value($con, $_POST['qty']);
        $desc = safe_value($con, $_POST['desc']);

        $img = $_FILES['img']['name'];
        $type = $_FILES['img']['type'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $size = $_FILES['img']['size'];

        $img_Ext = explode('.', $img);
        $img_correct_ext = strtolower(end($img_Ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/" . $img;

        if (empty($product_name) || empty($mrp) || empty($price) || empty($qty) || empty($desc) || empty($img)) {
            set_message(display_error("Por favor Preencha todos os Campos"));
        } else {
            if (in_array($img_correct_ext, $allow)) {
                if ($size < 500000) {

                    if ($cat_id == 0) {
                        set_message(display_error("Por favor selecione uma Categoria"));
                    } else {
                        $exit = "select * from products where product_name= '$product_name'";
                        $sql = mysqli_query($con, $exit);

                        if (mysqli_fetch_assoc($sql)) {
                            set_message(display_error("O Poduto já Existe :) "));
                        } else {
                            $query = "insert into products (category_name,product_name,MRP,price,qty,img,description,status) values('$cat_id','$product_name','$mrp','$price','$qty','$img','$desc','1')";
                            $result = mysqli_query($con, $query);

                            if ($result) {
                                set_message(display_sucess("Produto Criado com Sucesso"));
                                move_uploaded_file($tmp_name, $path);
                            }
                        }
                    }
                } else {
                    set_message(display_error("Tamanho da Imagem Superior ao Permitido"));
                }
            } else {
                set_message(display_error("Não Pode Anexar este Tipo de Ficheiro"));
            }
        }
    }
}

/// Ver Produtos ///
function view_products()
{
    global $con;
    $query = "SELECT products.p_id, categories.cat_name, products.product_name, products.MRP, products.price, products.qty, products.img, products.description, products.status from products INNER JOIN categories on products.category_name = categories.id";
    return $result = mysqli_query($con, $query);
}




//--------------Ativar e Desativar Produtos--------------------//


//Activar e Desativar Artigos

function active_status_product()
{
    global $con;
    if (isset($_GET['opr']) && $_GET['opr'] != "") {
        $operation = safe_value($con, $_GET['opr']);
        $id = safe_value($con, $_GET['id']);

        if ($operation == 'active') {
            $status = 1;
        } else {
            $status = 0;
        }

        $query = "update products set status='$status' where p_id='$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("Location:manage_product.php");
        }
    }
}


//----Editar Produtos---//

function edit_record()
{
    global $con;
    if (isset($_GET['id'])) {
        $edit_id = safe_value($con, $_GET['id']);
        $sql = "select * from products where p_id='$edit_id'";
        $res = mysqli_query($con, $sql);
        return $res;
    }
}

//----Editar Produtos---//
function update_record()
{
    global $con;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pro_btn_edit'])) {

        $cat_id = safe_value($con, $_POST['cat_id']);
        $product_id = safe_value($con, $_POST['product_id']);
        $product_name = safe_value($con, $_POST['product_name']);
        $mrp = safe_value($con, $_POST['mrp']);
        $price = safe_value($con, $_POST['price']);
        $qty = safe_value($con, $_POST['qty']);
        $desc = safe_value($con, $_POST['desc']);

        $img = $_FILES['img']['name'];
        $type = $_FILES['img']['type'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $size = $_FILES['img']['size'];

        $img_Ext = explode('.', $img);
        $img_correct_ext = strtolower(end($img_Ext));
        $allow = array('jpg', 'png', 'jpeg');
        $path = "img/" . $img;



        if (empty($product_name) || empty($mrp) || empty($price) || empty($qty) || empty($desc)) {
            set_message(display_error("Por favor Preencha todos os Campos"));
        } else {
            if (empty($img)) {
                if ($cat_id == 0) {
                    set_message(display_error("Por favor selecione uma Categoria"));
                } else {
                    $query = "update products set category_name='$cat_id', product_name='$product_name', MRP='$mrp', price='$price', qty='$qty', description='$desc' where p_id='$product_id'";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        set_message(display_sucess("Produto Editado com Sucesso ! "));
                        move_uploaded_file($tmp_name, $path);
                    }
                }
            } else {

                if ($size < 500000) {
                    if (in_array($img_correct_ext, $allow)) {
                        $query = "update products set category_name '$cat_id', product_name='$product_name', MRP='$mrp', price='$price', qty='$qty', img='$img', description='$desc' where p_id='$product_id'";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            set_message(display_sucess("Produto Editado com Sucesso ! "));
                            move_uploaded_file($tmp_name, $path);
                        }
                    } else {
                        set_message(display_error("Não Pode Anexar este Tipo de Ficheiro"));
                    }
                } else {
                    set_message(display_error("Tamanho da Imagem Superior ao Permitido"));
                }
            }
        }
    }
}


///////////////////////////---Contactos---//////////////////////////
function contact($page = 1)
{
    global $con;
    $min= ($page*6)-6;
    $max= 6;
    //---
    $sql = "select * from contact limit $min,$max";
    $query = mysqli_query($con, $sql);
    return $query;
}

function contactAll(){
    global $con;
    $sql = "select count(*) as qdt from contact";
    $query = mysqli_query($con, $sql);
    return $query;
}
