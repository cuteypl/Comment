<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';
require 'check.php';

$conn = connect3();
$user_name=$_SESSION["username"]; 
$item_name=$_POST["itemTitle"];  //取得用户输入的留言标题
$item_content=$_POST["itemMsg"];  //取得用户输入的留言内容

date_default_timezone_set("PRC"); // 
$item_date=date('Y-m-d H:i:s');  //取得服务器系统的当前时间

$sql="select user_id from db_user where user_name='{$user_name}'";
$query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
$row=mysqli_fetch_assoc($query);//$row["user_id"]
$user_id=$row["user_id"];  //取得用户的ID

$sql="insert db_usercomment(item_name,item_content,item_date,user_id) values('{$item_name}','{$item_content}','{$item_date}','{$user_id}')";
$query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
if($query){
    echo "<script>alert('发送成功！');window.location.href='../V/user_index.php';</script>";
}
else{
    echo"<script>alert('发送失败');window.location.href='../V/user_addMessage.php';</script>";
}



