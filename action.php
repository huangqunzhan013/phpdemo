<?php
/*
 * 执行商品信息添加和修改及删除等操作处理
 * */
require 'dbconfig.php';
require 'functions.php';

$link=@mysql_connect(HOST,USER,PASS) or die("数据库连接失败");
mysql_select_db(DBNAME,$link);
mysql_query('set names utf8');

switch ($_REQUEST['action']){
    case "add":
        $name=$_POST['name'];
        $typeid=$_POST['typeid'];
        $price=$_POST['price'];
        $total=$_POST['total'];
        $note=$_POST['note'];
        $addtime=time();
        if (empty($name)){
            die("商品名称必须有值");
        }
        //执行图片上传
        $upinfo=uploadFile("pic", "./uploads/");
        if ($upinfo["error"]==false){
            die("图片信息上传失败：".$upinfo["info"]);
        }else {
            //上传成功
            $pic=$upinfo["info"];//获取上传成功的图片名
        }
        //执行图片缩放
        //imageUpdateSize('./uploads/'.$pic,100,100,"s_");
        imageUpdateSize('./uploads/'.$pic,100,100);
        //imageUpdateSize($pic,"./uploads/",100,100,"s_");
        
        $sql="INSERT INTO goods(id, name, typeid, price, total, pic, note, addtime) VALUES (null,'$name','$typeid','$price','$total','$pic','$note','$addtime')";
        //echo $sql;
        mysql_query($sql,$link);
        if (mysql_insert_id($link)>0){
            echo '商品发布成功';
        }else {
            echo '商品发布失败'.mysql_error()."<br>".mysql_errno();
        }
        echo "<br><a href='index.php'>查看商品信息</a>";
        break;
    case "del":
        $id=$_REQUEST['id'];
        $sql="delete from goods where id='$id'";
        mysql_query($sql,$link);
        //执行图片删除
        if (mysql_affected_rows($link)>0){
            unlink("./uploads/".$_REQUEST['picname']);//删除文件
        }
        header("Location:index.php");
        break;
    case "modify":
        $name=$_POST['name'];
        $typeid=$_POST['typeid'];
        $price=$_POST['price'];
        $total=$_POST['total'];
        $note=$_POST['note'];
        $id=$_POST['id'];
        $pic=$_POST['oldpic'];
        //判断有无文件上传
        if ($_FILES['pic']['error']!=4){
            $upinfo=uploadFile("pic", "./uploads/");
            if ($upinfo["error"]==false){
                die("图片信息上传失败：".$upinfo["info"]);
            }else {
                //上传成功
                $pic=$upinfo["info"];//获取上传成功的图片名
                //图片缩放
                imageUpdateSize('./uploads/'.$pic,100,100);
            }
        }
        $sql="UPDATE goods SET name='$name',typeid='$typeid',price='$price',total='$total',pic='$pic',note='$note' WHERE id='$id'";
        $result=mysql_query($sql);
        if (mysql_affected_rows($link)>0){
            if ($_FILES['pic']['error']!=4){
                //删除文件
                unlink("./uploads/{$_REQUEST['oldpic']}");
            }
            echo '修改成功';
            echo "<a href='index.php'>返回查看商品信息</a>";
        }else {
            echo '修改失败';
            echo "<a href='index.php'>返回查看商品信息</a>";
        }
        break;
}