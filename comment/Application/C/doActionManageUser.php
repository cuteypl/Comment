<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';
require 'check.php';

$conn = connect3();
$user_id=$_GET["id"];
$action=$_GET["action"];

if ($action==3){
    $sql="select * from db_user where user_id='{$user_id}' ";
    $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    if ($query){
        $row=mysqli_fetch_assoc($query);
        $sql="insert db_admin (admin_name,admin_password,admin_email) VALUES('{$row["user_name"]}','{$row["user_password"]}','{$row["user_email"]}')";
        $result=mysqli_query($conn, $sql);
        if ($result){
            $sql="update db_user set tag=2 where user_id='{$row["user_id"]}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if ($query){
                echo "<script>alert('已设为管理员！');window.location.href='../V/ManageUser.php';</script>";
            }
            else {
                echo "<script>alert('设置失败！');window.location.href='../V/ManageUser.php';</script>";
            }
        }
        else {
            echo "<script>alert('设置失败！');window.location.href='../V/ManageUser.php';</script>";
        }
        //已设为了管理员，但并不从用户表里删除与其相关的一切信息
    }
    else {
        echo "<script>alert('设置失败！');window.location.href='../V/ManageUser.php';</script>";
    }
}
elseif ($action==4){
    //删除回复区的数据（db_reply中有关的数据）
    $sql="select item_id from db_usercomment where user_id='{$user_id}'";
    $query1=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    while (($row=mysqli_fetch_array($query1,MYSQLI_ASSOC))>0){
        $sql="delete from db_reply where item_id='{$row["item_id"]}'";
        $result=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    }
    //删除留言区的数据（db_usercomment中有关的数据）
    $sql="delete from db_usercomment where user_id='{$user_id}'";
    $query2=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    //删除用户表中相关的数据（db_user中有关的数据）  
    $sql="delete from db_user where user_id='{$user_id}'";
    $query3=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));

    echo "<script>alert('成功删除！');window.location.href='../V/ManageUser.php';</script>";
}
?>
