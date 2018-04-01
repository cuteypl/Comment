<?php 
require_once '../M/Functions/common.func.php';
//用来检测网络异常情况或服务器异常的情况（如断网了）
if(!(isset($_SESSION["username"]))||!(isset($_SESSION["password"]))){
    $mes="您没有正常登录，请重新登录本系统!{$_SESSION['username']}";
    $url="../../index.php";
    alertMes($mes,$url);
}//isset()检测变量是否设置
?>
