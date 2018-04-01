<?php
function synsendmail($email,$emailsubject,$emailbody,$emailtype){
    require_once 'Smtp.class.php';
    $smtpserver = "smtp.163.com"; //SMTP服务器，如smtp.163.com
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = "CuteyPL@163.com"; //SMTP服务器的用户邮箱
    $smtpuser = "CuteyPL"; //SMTP服务器的用户帐号
    $smtppass = "112500///"; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//实例化一个SMTP服务器
    
    $smtpemailfrom = $smtpusermail;
    $smtpemailto = $email;
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);    
    return $rs;
}