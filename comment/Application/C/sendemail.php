<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';
require_once '../M/Functions/Smtp.class.php';

$conn = connect3();

$email = stripslashes(trim($_POST['fgp-email']));
$sql = "select * from db_user where user_email='{$email}'";
$query = mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
$num = mysqli_num_rows($query);
if($num==0){//该邮箱尚未注册！
    echo "<div class='container' style='text-align:center;position:relative;top:196px;'>此邮箱还没有注册！<br />
          <a href='http://www.localhost:8080/Demo/comment/index.php'>返回首页</a></div>";
    exit;
}else{
    $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
    $uid = $row['user_id'];
    $token = md5($uid.$row['user_name'].$row['user_password']);//组合验证码
    $time = date('Y-m-d H:i');
    $url = "http://www.localhost:8080/Demo/comment/index.php?email=".$email."&token=".$token;//构造URL 
    //产生随机密码并更新用户密码
    $string="";
    $code="0123456789abcdefghijklmnopqrstuvwxzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for($i=0;$i<6;$i++){
        $char=$code{rand(0,strlen($code)-1)};//rand()产生一个随机数,$code(随机数)取上面$code字符串中的一个字符
        $string.=$char;//连接成6位的密码
    }
    $query=mysqli_query($conn,"update db_user set user_password='{$string}' where user_id='{$uid}'") or die("Invalid query:".mysqli_error($conn));
    if ($query){
        $result = sendmail($time,$email,$url,$string);
        if($result==1){//邮件发送成功
            $msg = '系统已随机生成一个密码并向您的邮箱发送了一封邮件<br/>请登录到您的邮箱查看密码后及时登录网站修改您的密码！';
        }else{
            $msg = $result;
        }
    }
    else {
        $msg = '密码更新失败！';
    }
    echo "<div class='container' style='text-align:center;position:relative;top:196px;'>$msg<br />
          <a href='http://www.localhost:8080/Demo/comment/index.php'>返回首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;
          <a href='http://www.mail.qq.com'>转到邮箱</a></div>";
}

//发送邮件
function sendmail($time,$email,$url,$string){
    //include_once("smtp.class.php");
    $smtpserver = "smtp.163.com"; //SMTP服务器，如smtp.163.com
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "CuteyPL@163.com"; //SMTP服务器的用户邮箱
    $smtpuser = "CuteyPL"; //SMTP服务器的用户帐号
    $smtppass = "112500///"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
    //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "找回密码";
    /*$emailbody = "亲爱的".$email."：<br/>您在".$time."提交了找回密码请求。请点击下面的链接重置密码
（链接24小时内有效）。<br/><a href='".$url."'target='_blank'>".$url."</a>";*/
    $emailbody = "亲爱的".$email.":<br />您在".$time."提交了找回密码请求。<br />系统随机产生的密码为:".$string."&nbsp;&nbsp;请登录网站后及时修改您的密码！";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);

    return $rs;
}

