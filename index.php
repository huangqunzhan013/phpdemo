<?php 
/*
 * 商品信息浏览页
 * */
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
        <h3>商品信息</h3>
        <table border="1" style="border-collapse:collapse;" width="1200" >
        <tr align="center">
            <td>商品编号</td>
            <td>商品名称</td>
            <td>商品类型</td>
            <td>商品价格</td>
            <td>商品总量</td>
            <td>商品图片</td>
            <td>商品描述</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        <?php
        include 'dbconfig.php';
        $link=@mysql_connect(HOST,USER,PASS);
        mysql_select_db('test',$link);
        mysql_query('set names utf8');
        $sql="select * from goods";
        $result=mysql_query($sql);
        while ($row=mysql_fetch_array($result)){
            echo '<tr align="center">';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['typeid'].'</td>';
            echo '<td>'.$row['price'].'</td>';
            echo '<td>'.$row['total'].'</td>';
            echo '<td><img src="./uploads/'.$row['pic'].'"></td>';
            echo '<td>'.$row['note'].'</td>';
            echo '<td>'.date('Y-m-d H:i:s',$row['addtime']).'</td>';
            echo "<td><a href='edit.php?id={$row['id']}'>编辑</a>  <a href='action.php?action=del&id={$row['id']}&picname={$row['pic']}'>删除</a></td>";
            echo '</tr>';
        }
        ?>
        </table>

</div>
</body>
</html> 