<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';

$conn = connect3();
$username=$_POST["lg-username"];//取得用户输入的用户名
$password=$_POST["lg-userpass"];//取得用户输入的密码
$validateCode=$_POST["lg-checkCode"];//取得用户输入的验证码
$option=$_POST["optionsRadiosinline"];
if(strtoupper($validateCode)==strtoupper($_SESSION['checkCode'])){
    if ($option=="option1"){
        $sql="select*from db_user where user_name='{$username}' and user_password='{$password}'";
        $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
        if(mysqli_num_rows($query)>0){
            $_SESSION["username"]=$username;
            $_SESSION["password"]=$password; 
            $_SESSION["role"]=1;   //代表登录者为用户                            
            echo "<script>alert('登录成功!');window.location.href='../V/user_index.php';</script>";
        }
        else{
             echo"<script>alert('您输入的用户名或密码不正确!');window.location.href='../../index.php';</script>";
        }
    }
    elseif ($option=="option2"){
        $sql="select*from db_admin where admin_name='{$username}' and admin_password='{$password}'";
        $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
        if(mysqli_num_rows($query)>0){
            $_SESSION["username"]=$username;
            $_SESSION["password"]=$password; 
            $_SESSION["role"]=2;//代表登录者为管理员
            echo "<script>alert('登录成功!');window.location.href='../V/admin_index.php';</script>";
        }
        else {
            echo"<script>alert('您输入的用户名或密码不正确');window.location.href='../../index.php';</script>";
        }
   }
}
else if(strtoupper($validateCode)!= strtoupper($_SESSION['checkCode'])){
    echo"<script>alert('输入的验证码错误！');window.location.href='../../index.php';</script>";
}
