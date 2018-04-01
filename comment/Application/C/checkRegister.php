<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';

$conn = connect3();
$username=$_POST["rg-username"];//取得用户输入的用户名
$password=$_POST["rg-userpass1"];//取得用户输入的密码
$password1=$_POST["rg-userpass2"];//取得用户输入的确认密码
$useremail=$_POST["rg-useremail"];//取得用户输入的邮箱
if ($password==$password1){
    $sql="select*from db_user where user_name='{$username}'";
    $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
    if (mysqli_num_rows($query)>0){
        echo "<script>alert('此用户名已被注册！');window.location.href='../../index.php';</script>";
    }
    else{
        $sql="insert db_user(user_name,user_password,user_email) VALUES('{$username}','{$password}','{$useremail}')";
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        if($query){
            echo "<script>alert('注册成功！');window.location.href='../../index.php';</script>";
        }
        else {
            echo "<script>alert('注册失败1！');window.location.href='../../index.php';</script>";
        }
    }      
}
else if($password!=$password1){
    echo "<script>alert('注册失败2！');window.location.href='../../index.php';</script>";
}

?>
