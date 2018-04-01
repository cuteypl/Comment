<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';
require 'check.php';

$conn = connect3();
$user_name=$_SESSION["username"];
$user_pass=$_SESSION["password"];
$role_tag=$_SESSION["role"];
$pass=$_POST["Password"];
$newpass1=$_POST["NewPass1"];
$newpass2=$_POST["NewPass2"];

if ($role_tag==1){
    $sql="select user_password from db_user where user_name='{$user_name}'";
    $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);
    if($pass==$row["user_password"]){
        if($newpass1==$newpass2){
            $sql="update db_user set user_password='{$newpass1}' where user_name='{$user_name}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if($query){
                echo"<script>alert('修改成功!');window.location.href='../V/user_index.php';</script>";
            }
        }
        else{       
            echo"<script>alert('密码和确认密码不一样!');window.location.href='../V/Setting.php';</script>";
        }
    }
    else{
        echo"<script>alert('您输入的密码错误!');window.location.href='../V/Setting.php';</script>";
    }
}
elseif ($role_tag==2){
    $sql="select admin_password from db_admin where admin_name='{$user_name}'";
    $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);
    if ($pass==$row["admin_password"]){
        if($newpass1==$newpass2){
            $sql="update db_admin set admin_password='{$newpass1}' where admin_name='{$user_name}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if($query){
                echo"<script>alert('修改成功!');window.location.href='../V/admin_index.php';</script>";
            }
        }
        else{
            echo"<script>alert('密码和确认密码不一样!');window.location.href='modifypass.php';</script>";
        }
    }
    else{
         echo"<script>alert('您输入的密码错误!');window.location.href='../V/Setting.php';</script>";
    }
}



