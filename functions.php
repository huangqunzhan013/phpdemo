<?php
/*
 * 公共函数库文件，图片信息的上传，等比缩放等处理函数
 * $filename要上传的文件表单项名
 * $path上传文件的保存路径
 * 
 * ["info"]存放失败原因或成功的文件名
 * */


$typelist=array(1=>"服装",2=>"数码",3=>"食品");

function uploadFile($filename,$path,$typelist=null){
    //获取上传文件的名字；
    $upfile=$_FILES[$filename];
    if (empty($typelist)){
        $typelist=array("image/gif","image/jpg","image/jpeg","image/png");
    }
    $res=array("error"=>false,"info"=>"");//存放返回的结果
    //过滤上传文件的错误号
    if ($upfile["error"]>0){
        switch ($upfile["error"]){
            case 1:
                $res["info"]="上传的文件超过了php.ini中upload_max_filesize选项限制";
                break;
            case 2:
                $res["info"]="上传的文件大小超过了HTML表单中MAX_FILE_SIZE选项";
                break;
            case 3:
                $res["info"]="文件只有部分被上传";
                break;
            case 4:
                $res["info"]="没有文件被上传";
                break;
            case 6:
                $res["info"]="找不到临时文件夹";
                break;
            case 7:
                $res["info"]="文件写入失败";
                break;
            default:
                $res["info"]="未知错误";
                break;
        }
        return $res;
    }
    
    //本次文件大小的限制
    if ($upfile["size"]>100000){
        $res["info"]="上传文件过大";
        return $res;
    }
    
    //过滤类型
    if (!in_array($upfile["type"], $typelist)){
        $res["info"]="上传类型不符！".$upfile["type"];
        return $res;
    }
    
    //初始化信息（为图片产生一个随机的名字）
    //$path_parts = pathinfo('/www/htdocs/inc/lib.inc.php');
    //echo $path_parts['extension']   输出php
    $fileinfo=pathinfo($upfile["name"]);
    do{
        $newfile=date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];
    }while (file_exists($newfile)) ;
        
        //执行上传处理
        //is_uploaded_file — 判断文件是否是通过 HTTP POST 上传的
        if (is_uploaded_file($upfile["tmp_name"])){
            //move_uploaded_file() 函数将上传的文件移动到新位置。
            if (move_uploaded_file($upfile["tmp_name"], $path."/".$newfile)){
                //将上传成功后的文件名赋值给返回数组
                $res["info"]=$newfile;
                $res["error"]=true;
                return $res;
            }else {
                $res["info"]="上传文件失败";
            }
        }else {
            $res["info"]="不上一个上传的文件";
        }
        return $res;
}  






/*
 * $picname被缩放的处理图片源
 * $maxx缩放后图片的最大宽度
 * $maxy缩放后图片的最大高度
 * $pre缩放后图片名的前缀名
 * 返回后的图片名称，带路径，如a.jpg=>s_a.jpg
 * return true 返回值，true表示图片成功
 * */
function imageUpdateSize($picname,$maxx=100,$maxy=100,$pre="s_"){
    //处理图片路径
    //$path=rtrim($path,"/")."/";
    $info=getimagesize($picname);//获取图片的基本信息
    $width=$info[0];//获取宽度
    $height=$info[1];//获取高度
    
    
    //获取图片的类型并为此创建对应的原图片资源
    switch ($info[2]){
        case 1://gif
            $im=imagecreatefromgif($picname);
            break;
        case 2://jpg
            $im=imagecreatefromjpeg($picname);
            break;
        case 3://png
            $im=imagecreatefrompng($picname);
            break;
        case 4:
            $im=imagecreatefromwbmp($picname);
            break;
        default:
            die("不认识图片类型");
            break;        
    }
    //计算缩放后图片的尺寸
    if ($maxx/$width < $maxy/$height){
        $w=$maxx;
        $h=($maxx/$width)*$height;
    }else {
        $w=($maxy/$height)*$width;
        $h=$maxy;
    }
    //创建缩放后的图片画布
    $resim=imagecreatetruecolor($w, $h);
    //执行缩放图片
    imagecopyresampled($resim, $im, 0, 0, 0, 0, $w, $h, $width, $height);
    //创建目标图片保存缩放图片
    $pathinfo=pathinfo($picname);
    $npathinfo=$pathinfo["dirname"]."/".$pre.$pathinfo["basename"];
    switch ($info[2]){
        case 1:
            imagegif($resim,$picname);
            break;
        case 2:
            imagejpeg($resim,$picname);
            break;
        case 3:
            imagepng($resim,$picname);
            break;
    }
    //释放资源
    imagedestroy($resim);
    imagedestroy($im);
    return true;
}


//图片添加水印
/*
 * $picname 图片名称
 * $wmpic 水印图片
 * */
function addImageWaterMark($picname,$wmpic,$pre="ss_"){
    $picnameinfo=getimagesize($picname);
    $wmpicinfo=getimagesize($wmpic);
    var_dump($wmpicinfo);

    $pw=$picnameinfo[0];
    $ph=$picnameinfo[1];
    $wmw=$wmpicinfo[0];
    $wmh=$wmpicinfo[1];

    switch ($picnameinfo[2]){
        case 1:
            $im=imagecreatefromgif($picname);
            break;
        case 2:
            $im=imagecreatefromjpeg($picname);
            break;
        case 3:
            $im=imagecreatefrompng($picname);
            break;
        default:
            die("图片类型错误");
    }
    switch ($wmpicinfo[2]){
        case 1:
            $wim=imagecreatefromgif($wmpic);
            break;
        case 2:
            $wim=imagecreatefromjpeg($wmpic);
            break;
        case 3:
            $wim=imagecreatefrompng($wmpic);
            break;
        default:
            die("水印图片类型错误");
    }

    //imagecopyresampled($im, $wim, $pw-$wmw, $ph-$wmh, 0, 0, $wmw, $wmh, $wmw, $wmh);
    imagecopy($im, $wim, $pw-$wmw, $ph-$wmh, 0, 0, $wmw, $wmh);

    $pathinfo=pathinfo($picname);
    $npathinfo=$pathinfo["dirname"]."/".$pre.$pathinfo["basename"];
    switch ($picnameinfo[2]){
        case 1:
            imagegif($im,$npathinfo);
            break;
        case 2:
            $a=imagejpeg($im,$npathinfo);
            break;
        case 3:
            imagepng($im,$npathinfo);
            break;
        default:
            die("创建图片类型错误");
    }
    //释放资源
    imagedestroy($im);
    imagedestroy($wim);

    return $npathinfo;

}