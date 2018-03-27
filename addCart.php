<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<div align="center">
<?php
require 'menu.php';
require 'dbconfig.php';
$link=@mysql_connect(HOST,USER,PASS);
mysql_select_db('test',$link);
mysql_query('set names utf8');
$id=$_REQUEST['id'];
$sql="select * from goods where id='$id'";
$result=mysql_query($sql);
if (empty($result) || mysql_num_rows($result)==0){
    die("没有该商品");
}else{
    $shop=mysql_fetch_assoc($result);
    echo '添加商品到购物车成功';
}
$shop["num"]=1;
session_start();
if (isset($_SESSION['shoplist'][$shop['id']])){
    $_SESSION['shoplist'][$shop['id']]['num']++;
}else {
    $_SESSION['shoplist'][$shop['id']]=$shop;
}
//var_dump($_SESSION['shoplist']);

?>
</div>
</body>
</html>