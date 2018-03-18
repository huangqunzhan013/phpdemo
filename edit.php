
<?php
/*
 * 商品信息编辑表单也
 * */
require 'dbconfig.php';
@mysql_connect(HOST,USER,PASS);
mysql_select_db(DBNAME);
mysql_query('set names utf8');
$id=$_REQUEST['id'];
$sql="select * from goods where id='$id'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
     <div align="center">
        <?php include 'menu.php';?>
        <h3>发布商品信息</h3>
        <form action="action.php?action=modify" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="oldpic" value="<?= $row['pic'] ?>">
        <table  width="450" border="1" style="border-collapse:collapse;">
        <tr>
        <td align="right">商品名称：</td>
        <td><input type="text" name="name" value="<?= $row['name']?>"></td>
        </tr>
        <tr>
        <td align="right">商品类型：</td>
        <td>
        <select name="typeid" value="<?= $row['typeid']?>">
            <?php
            include 'functions.php';
            foreach ($typelist as $k=>$v){
                $sd=($row['typeid']==$v)?"selected":"";//查看是否是当前类型
                echo "<option value='$k' {$sd}>$v</option>";
            }
            ?>
        </select>
        </td>
        </tr>
        <tr>
        <td align="right">商品价格：</td>
        <td><input type="text" name="price" value="<?= $row['price'] ?>"></td>
        </tr>
        <tr>
        <td align="right">库存量：</td>
        <td><input type="text" name="total" value="<?= $row['total'] ?>"></td>
        </tr>
        <tr>
        <td>商品图片：</td>
        <td><input type="file" name="pic" height="20px"/><img alt="" src="./uploads/<?= $row['pic']?>"></td>
        </tr>
        <tr>
        <td align="right" valign="top">商品描述：</td>
        <td><textarea rows="3" cols="30" name="note"><?= $row['note']?></textarea></td>
        </tr>
        <tr>
        <td align="center" colspan="2">
        <input type="submit" value="修改"/>
        <input type="reset" value="重置"/>
        </td>
        </tr>
        </table>
        </form>
     </div>
</body>
</html>