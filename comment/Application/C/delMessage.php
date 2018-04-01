<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../M/config/config.php';
require_once '../M/Functions/mysql.func.php';
require 'check.php';

$conn = connect3();
$user_name=$_SESSION["username"];
$role=$_SESSION["role"];
$id=$_GET["id"];//若是删除整个留言，则此处传来的id为此条留言的id;若是删除某一条评论，则此处传来的是此条评论的id
$action=$_GET["action"];//action为1删除整个留言，action为2删除此条评论

if ($action==1){
    $userid=$_GET["userid"];
    if ($role==1){
        $sql="select user_id from db_user where user_name='{$user_name}'";
        $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
        $row=mysqli_fetch_assoc($query);//$row["user_id"]
        $user_id=$row["user_id"];  //取得当前用户的ID
        if ($user_id==$userid) {
            $sql="delete from db_reply where item_id='{$id}'";//先删除这条留言下的评论
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if($query){
                $sql="delete from db_usercomment where item_id='{$id}'";//后删除整个留言
                $result=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
                if($result){
                    echo "<script>alert('成功删除！');window.location.href='../V/user_index.php';</script>";
                }
                else{
                    echo "<script>alert('删除失败！');window.location.href='../V/user_index.php';</script>";
                }
            }
            else{
                echo "<script>alert('删除失败！');window.location.href='../V/user_index.php';</script>";
            }
        }    
    }
    elseif ($role==2){
        $sql="delete from db_reply where item_id='{$id}'";//先删除这条留言下的评论
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        if($query){
            $sql="delete from db_usercomment where item_id='{$id}'";//后删除整个留言
            $result=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if($result){
                echo "<script>alert('成功删除！');window.location.href='../V/admin_index.php';</script>";
            }
            else{
                echo "<script>alert('删除失败！');window.location.href='../V/admin_index.php';</script>";
            }
        }
        else{
            echo "<script>alert('删除失败！');window.location.href='../V/admin_index.php';</script>";
        }
    }
}
elseif ($action==2){
    $replyer_tag=$_GET["tag"];
    $replyer_id=$_GET["replyerid"]; //获得此条评论的评论者id
    //用户,用户只能删除自己的评论
    $sql="select item_id from db_reply where reply_id='{$id}'";
    $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
    $result=mysqli_fetch_assoc($query);
    if ($role==1){
        $sql="select user_id from db_user where user_name='{$user_name}'";
        $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
        $row=mysqli_fetch_assoc($query);//$row["user_id"]
        $user_id=$row["user_id"];  //取得当前用户的ID      
        if (($role==$replyer_tag)&&($user_id==$replyer_id)){
            $sql="delete from db_reply where reply_id='{$id}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            if($query){
                echo "<script>alert('成功删除！');window.location.href='../V/displayReply.php?id={$result["item_id"]}';</script>";
            }
            else {
                echo "<script>alert('删除失败！');window.location.href='../V/displayReply.php?id={$result["item_id"]}';</script>";
            }
        }
        elseif ($role!=$replyer_tag){
            echo "<script>alert('您没有权限删除此评论！');window.location.href='../V/displayReply.php?id={$result["item_id"]}';</script>";
        }       
    }
    //管理员
    elseif($role==2){
        $sql="delete from db_reply where reply_id='{$id}'";
        $query=mysqli_query($conn, $sql)or die("Invalid query:".mysqli_error($conn));
        if($query){
            echo "<script>alert('成功删除！');window.location.href='../V/displayReply.php?id={$result["item_id"]}';</script>";
        }
        else {
            echo "<script>alert('删除失败！');window.location.href='../V/displayReply.php?id={$result["item_id"]}';</script>";
        }
    }
}



