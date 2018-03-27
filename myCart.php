<?php
session_start();
?>
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
    ?>
        <table border="1" style="border-collapse:collapse;" width="1200" >
            <tr align="center">
                <td>商品编号</td>
                <td>商品名称</td>
                <td>商品价格</td>
                <td>数量</td>
                <td>商品图片</td>
                <td>小计</td>
                <td>操作</td>
            </tr>
                <?php 
                if(isset($_SESSION['shoplist'])){
                    $num=0;
                    foreach ($_SESSION['shoplist'] as $v){
                        echo "<tr align='center'>";
                        echo "<td>".$v['id']."</td>";
                        echo "<td>".$v['name']."</td>";
                        echo "<td>".$v['price']."</td>";
                        echo "<td><button onclick='window.location.href=\"updateCart.php?id={$v['id']}&num=1\"'>+</button> 
                        ".$v['num'].
                        " <button onclick='window.location.href=\"updateCart.php?num=-1&id={$v['id']}\"'>-</button></td>";
                        echo "<td><img src='./uploads/{$v['pic']}'</td>";
                        echo "<td>".$v['price']*$v['num']."元</td>";
                        echo "<td><a href='clearCart.php?id={$v['id']}'>删除</a></td>";
                        echo "</tr>";
                        $num+=$v['price']*$v['num'];                        
                    }
                    echo "<tr><td colspan='7' style='text-align:right'>总计：".$num."元</td></tr>";
                }else{ 
                    echo "<h4>没有添加商品进购物车</h4>";                
                }
                ?>
         </table>
         
    </div>
</body>
</html>