
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
        <form action="action.php?action=add" method="post" enctype="multipart/form-data">
        <table  width="350" border="1" style="border-collapse:collapse;">
        <tr>
        <td align="right">商品名称：</td>
        <td><input type="text" name="name"></td>
        </tr>
        <tr>
        <td align="right">商品类型：</td>
        <td>
        <select name="typeid">
            <?php
            include 'functions.php';
            foreach ($typelist as $k=>$v){
                echo "<option>$v</option>";
            }
            ?>
        </select>
        </td>
        </tr>
        <tr>
        <td align="right">商品价格：</td>
        <td><input type="text" name="price"></td>
        </tr>
        <tr>
        <td align="right">库存量：</td>
        <td><input type="text" name="total"></td>
        </tr>
        <tr>
        <td>商品图片：</td>
        <td><input type="file" name="pic" height="20px"/></td>
        </tr>
        <tr>
        <td align="right" valign="top">商品描述：</td>
        <td><textarea rows="3" cols="30" name="note"></textarea></td>
        </tr>
        <tr>
        <td align="center" colspan="2">
        <input type="submit" value="添加"/>
        <input type="reset" value="重置"/>
        </td>
        </tr>
        </table>
        </form>
     </div>
</body>
</html>