
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<div align="center">
        <?php include 'menu.php';
        ?>
        <h3>商品信息</h3>
        <form action="searchInfo.php" method="post">
             <span>名称搜索:</span><input type="text" size="8" name="name"/>
             <span>价格搜索:</span><input type="text" size="8" name="price"/>
             <span>描述搜索:</span><input type="text" size="8" name="note"/>
             <input type="submit" value="搜索">
             <input type="button" value="全部信息" onclick='window.location.href="index.php"'/>
        </form>
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
            $con=array();
            if (!empty($_POST['name'])){
                $con[]="name like '%{$_POST['name']}%'";
            }
            if (!empty($_POST['price'])){
                $con[]="price like '{$_POST['price']}'";
            }
            if (!empty($_POST['note'])){
                $con[]="note like '%{$_POST['note']}%'";
            }
            //var_dump($con);
            //echo count($con);
            //exit();
            if (count($con)>0){
                $where="where ".implode(' and ', $con);
            }else {
                echo '请输入关键词';
                exit();
            }
            //$where="where ".implode(' and ', $con);
            //echo $where;
            $sql="select * from goods ".$where;
            //echo $sql;
            $result=mysql_query($sql);
            //echo $result;
            //$row=mysql_fetch_assoc($result);
            //echo print_r($row);
            //var_dump($row);
            if (mysql_num_rows($result)>0){
                while ($row=mysql_fetch_assoc($result)){
                    echo '<tr align="center">';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['typeid'].'</td>';
                    echo '<td>'.$row['price'].'</td>';
                    echo '<td>'.$row['total'].'</td>';
                    echo '<td><img src="./uploads/'.$row['pic'].'"></td>';
                    echo '<td>'.$row['note'].'</td>';
                    echo '<td>'.date('Y-m-d H:i:s',$row['addtime']).'</td>';
                    echo "<td><a href='edit.php?id={$row['id']}'>编辑</a>  <a href='action.php?action=del&id={$row['id']}&picname={$row['pic']}'>删除</a>  <a href='addCart.php?id={$row['id']}'>放入购物车</a></td>";
                    echo '</tr>';
                    //echo print_r($row);
                }
            }else {
                echo '没有搜索到商品';
            }
        ?>
        </table>

</div> 
</body>
</html>