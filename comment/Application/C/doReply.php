<?php 
    session_start();
    header("content-type:text/html;charset=utf-8");
    require_once '../M/config/config.php';
    require_once '../M/Functions/mysql.func.php';
    require_once '../M/Functions/synsendmail.php';
    require '../C/check.php';
    
    $conn = connect3();
    $item_id=$_POST["item_id"];
    $replyer_tag=$_SESSION["role"];
    $reply_content=$_POST["replyMsg"];
    
    date_default_timezone_set("PRC"); // 设置默认时区
    $reply_date=date('Y-m-d H:i:s');  //取得服务器系统的当前时间

    $time = date('Y-m-d H:i');//给用户的通知邮件信息
    $sql="select user_name,user_email from db_user where user_id=(select user_id from db_usercomment where item_id='{$item_id}')";
    $query=mysqli_query($conn, $sql)or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);
    $user_name=$row["user_name"];
    $email=$row["user_email"];//将管理员的回复同时发送到用户的邮箱
    $emailtype="HTML";
    $emailsubject="管理员回复了您在留言簿上的一条留言";
    $emailbody= "亲爱的".$user_name.":<br /><p style='text-indent:2em'>".$reply_content.".</p><p style='text-align:right;'>回复人:admin</p><p style='text-align:right'>".$time."</p>";  

    $user_name=$_SESSION["username"];
    if($replyer_tag==1){
        $sql="select user_id from db_user where user_name='{$user_name}'";
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        $row=mysqli_fetch_assoc($query);
        $replyer_id=$row["user_id"];
    }
    elseif ($replyer_tag==2){
        $sql="select admin_id from db_admin where admin_name='{$user_name}'";
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        $row=mysqli_fetch_assoc($query);
        $replyer_id=$row["admin_id"];       
    }
    
    $sql="insert db_reply (item_id,replyer_tag,replyer_id,reply_content,reply_date) values('{$item_id}','{$replyer_tag}','{$replyer_id}','{$reply_content}','{$reply_date}')";
    $query=mysqli_query($conn, $sql)or die("Invalid query:".mysqli_error($conn));
    if($query){
        if($replyer_tag==2){
            $result = synsendmail($email,$emailsubject,$emailbody,$emailtype);
            if ($result==2){
                echo "<script>alert('提交成功！');window.location.href='../V/displayReply.php?id=$item_id';</script>";
            }
            else {
                echo"<script>alert('发送失败');window.location.href='../V/displayReply.php?id=$item_id'</script>";
            }
        }
        elseif ($replyer_tag==1){
            echo "<script>alert('提交成功！');window.location.href='../V/displayReply.php?id=$item_id';</script>";
        }
    }
    else{
        echo"<script>alert('发送失败');window.location.href='../V/displayReply.php?id=$item_id'</script>";
    }
    
 ?> 
 
 
    
    