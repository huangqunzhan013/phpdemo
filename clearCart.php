<?php
session_start();
if (isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    unset($_SESSION['shoplist'][$id]);
}else{
    unset($_SESSION['shoplist']);
}
header("location:myCart.php");
