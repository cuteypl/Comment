<?php
session_start();
ob_clean();//清除输出缓冲区中的内容，如果你的网站有许多生成的图片类文件，那么想要访问正确，就要经常清除缓冲区，亦即清空先前输出的。
header("Content-Type: image/jpeg");//告诉浏览器输出的是图片
$code="0123456789abcdefghijklmnopqrstuvwxzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$checkCode="";
$string="";
for($i=0;$i<4;$i++){
    $char=$code{rand(0,strlen($code)-1)};//rand()产生一个随机数,$code(随机数)取上面$code字符串中的一个字符
    $string.=$char;//连接成4位的验证码
}
$im = imagecreatetruecolor(60, 30);//新建一个真彩色图片
$bg = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,120));//为一幅图像分配颜色，作为背景色
$co = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,120));//为一幅图像分配颜色，作为字体的颜色
$color=imagecolorallocate($im, rand(100,200),rand(100,200),rand(100,200));//为一幅图像分配颜色，作为干扰线的颜色
imagefill($im, 0, 0, $bg);//区域填充，填充背景色
$lineNum=rand(2,4);
for($i=0;$i<$lineNum;$i++){
    $x1=rand(0,60/2);
    $y1=rand(0,30/2);
    $x2=rand(60/2,60);
    $y2=rand(30/2,30);
    imageline($im,$x1,$y1,$x2,$y2,$color);//画一线段，（x1,y10），（x2,y2）线段的起终点
}
$_SESSION['checkCode']=$string;//将产生的验证码存入session，一个超全局变量（数组）
imagestring($im, 8, 10, 8, $string, $co);//水平地画一行字符串，其中8为字体的大小，（10,8）为从图像的哪开始写起
imagejpeg($im);//以jpeg的格式输出图像到浏览器
imagedestroy($im);//销毁图像
?>