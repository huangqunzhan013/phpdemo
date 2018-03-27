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
        //$sql="select * from goods";
        //$result=mysql_query($sql);
        //==========================
        //分页处理代码
        $page=isset($_GET["page"])?$_GET["page"]:1;    //当前页数
        $pageSize=2;//页大小
        $maxRows;   //最大数据条
        $maxPages;  //最大页数
        
        //获取最大数据条
        $sql="select * from goods";
        $result=mysql_query($sql,$link);
        $maxRows=mysql_num_rows($result);
        
        //计算出最大页数取整
        $maxPages=ceil($maxRows/$pageSize);
        //效验当前页数
        if ($page>$maxPages){
            $page=$maxPages;
        }
        if ($page<1){
            $page=1;
        }
        
        //拼装分页sql语句片段
        $limit=" limit ".(($page-1)*$pageSize).",{$pageSize}";//limit 1，2 1代表从第几条开始，2代表2条数据
        
        $sql="select * from goods order by addtime desc {$limit}";
        $result=mysql_query($sql,$link);
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
            echo "<td><a href='edit.php?id={$row['id']}'>编辑</a>  <a href='action.php?action=del&id={$row['id']}&picname={$row['pic']}'>删除</a>  <a href='addCart.php?id={$row['id']}'>放入购物车</a></td>";
            echo '</tr>';
        }
        
        //释放结果集
        mysql_free_result($result);
        mysql_close($link);
        
        ?>
        </table>
        <?php
            echo "<br/><br/>";
            echo "当前{$page}/{$maxPages}页    ;共计{$maxRows}条数据";
            echo "<a href='index.php?page=1'>首页</a>";
            echo "<a href='index.php?page=".($page-1)."'>  上一页   </a>";
            echo "<a href='index.php?page=".($page+1)."'>  下一页    </a>";
            echo "<a href='index.php?page=".($maxPages)."'>  末页   </a>";
        ?>
        
        
        

</div> 
</body>
</html> 