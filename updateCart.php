<?php
session_start();
$id=$_REQUEST['id'];
$num=$_REQUEST['num'];
$_SESSION['shoplist'][$id]["num"]+=$num;
if (($_SESSION['shoplist'][$id]["num"])<1){ 
    $_SESSION['shoplist'][$id]["num"]=1;
}
header("location:myCart.php");