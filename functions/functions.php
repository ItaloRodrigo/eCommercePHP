<?php

    Require_once 'db.php';

    session_start();

    //--------- Mostrar Categorias no Menu ----------\\
    function getNavCategories()
    {
        global $con;
        $links_categories = [];
        $query="select * from type_categories where status=1";
        $type_categories = mysqli_query($con,$query);
        //---
        foreach($type_categories as $key => $type){
            $query="select * from categories where id_type_categorie = ".$type['id']." and status=1";
            $categories = mysqli_query($con,$query);
            //---
            $links_categories[$key]['type']       = $type['cat_name'];
            $links_categories[$key]['categories'] = $categories;
        }
        return $links_categories;
    }

    //--------- Mostrar Produtos ----------\\
    function get_products($cat_id='', $product_id='',$vmin=0,$vmax=999)
    {
        global $con;
        $query = "select * from products where status=1 and (price >= $vmin and price <= $vmax) order by p_id desc";

        if($cat_id!='')
        {
            $query = "select * from products where category_name=$cat_id and (price >= $vmin and price <= $vmax)" ;
        }
        if($product_id!='')
        {
            $query = "select * from products where p_id=$product_id and (price >= $vmin and price <= $vmax)";
        }
        // return [];
        return $result = mysqli_query($con,$query);

        
    }

    //--------- Mostrar todos as categorias ----------\\

    function all_categories(){
        global $con;
        $query = "SELECT c.id, c.cat_name as nome,( select count(*) from products where category_name = c.id ) as qdt FROM categories as c";
        return $result = mysqli_query($con,$query);
    }

    //--------- Produtos no Carrinho ----------\\

    function getProdutoCarrinho(){
        // $_SESSION["produtos"] = [];
        if(isset($_SESSION["produtos"])){
            return $_SESSION["produtos"];
        }else{
            $_SESSION["produtos"] = [];
            return $_SESSION["produtos"];
        }
    }

    function isProdutoCarrinho($id_prod){
        if(isset($_SESSION["produtos"]) && count($_SESSION["produtos"]) > 0){
            foreach($_SESSION["produtos"] as $produto){
                if($produto[1]['p_id'] == $id_prod){
                    return true;
                }
            }
        }
        return false;
    }

    function addProdutoCarrinho($id_prod,$qdt){
        global $con;
        if(!isset($_SESSION["produtos"])){
            $_SESSION["produtos"] = [];
        }
        //---
        $query = "select * from products where p_id=$id_prod";
        $result = mysqli_fetch_assoc(mysqli_query($con,$query));
        //---
        array_push($_SESSION["produtos"],[$id_prod,$result,$qdt]);
    }

    function updateProdutoCarrinho($id_prod,$qdt){
        if(isset($_SESSION["produtos"]) && count($_SESSION["produtos"]) > 0){        
            foreach($_SESSION["produtos"] as $key => $produto){
                if($produto[1]['p_id'] == $id_prod){
                    if($qdt > 0){
                        $_SESSION["produtos"][$key][2] = $qdt;                    
                        return true;
                    }else{
                        unset($_SESSION["produtos"][$key]);
                    }                    
                }
            }
        }
        return false;
    }

    function priceTotal(){
        $price_total = 0;
        if(isset($_SESSION["produtos"]) && count($_SESSION["produtos"]) > 0){            
            foreach($_SESSION["produtos"] as $key => $produto){
                $price_total = $price_total + ($produto[1]['price'] * $produto[2]);
            }
        }
        return $price_total;
    }


    //--------- Mostrar Categorias links ----------\\
    function display_cat_links($category_id="")
    {
        global $con;
        $query = "select products.p_id, products.category_name, categories.cat_name FROM products INNER JOIN categories on products.category_name=categories.id where products.category_name='$category_id'";
        return $result = mysqli_query($con,$query);
    }


?>