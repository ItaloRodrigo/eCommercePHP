<?php
        $con = mysqli_connect("localhost","root","","ecommerce");
        $con->set_charset("utf8");

    if(!$con)
    {
        echo "connection field";
        exit();
    }

?>