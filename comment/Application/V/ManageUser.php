<?php 
require_once 'Header.php';
?>
<body>
  <?php 
    session_start();
    header("content-type:text/html;charset=utf-8");
    require_once '../M/config/config.php';
    require_once '../M/Functions/mysql.func.php';
    require '../C/check.php';
    $conn = connect3();
    $admin_name=$_SESSION["username"];
  ?>
 
  <?php 
  require_once 'admin_Navbar.php';
  ?>
    <!-- adminManageUser  Section -->    
    <div id="manageUser">
        <div class="container">
           <table class="table table-hover" id="userlist">
                <tr>
                    <th>user_id</th>
                    <th>user_name</th>
                    <th>查看其留言</th>
                    <th>最新留言时间</th>
                    <th>设为管理员</th>
                    <th>删除</th>
               </tr>
               <?php   
               $sql="SELECT * FROM db_user ORDER BY user_id asc";
               $result=mysqli_query($conn,$sql)  or die("Invalid query:".mysqli_error($conn));
               // 数字数组
               while(($row=mysqli_fetch_array($result,MYSQLI_ASSOC))>0){
                   $row[]=$row;
                   $sql="select item_id,item_date from db_usercomment where user_id='{$row["user_id"]}' order by item_id desc";
                   $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));                          
               ?>
               <tr>
                    <td><?php echo "{$row["user_id"]}"?></td>
                    <td><?php echo "{$row["user_name"]}"?></td>
                    <td><a href="categoriesUser.php?id=<?php echo "{$row["user_id"]}"?>" target="view_window"><i>查看</i></a></td>
                    <?php 
                    if (mysqli_num_rows($query)>0){
                        $count = mysqli_fetch_array($query,MYSQLI_ASSOC);
                    ?>
                    <td><a href="displayReply.php?id=<?php echo "{$count["item_id"]}"?>" target="view_window"><i><?php echo "{$count["item_date"]}"?></i></a></td><!-- 最新留言时间 -->
                    <?php 
                    }
                    else{
                    ?>
                    <td><a href="#"><i>----------------</i></a></td>
                    <?php }?>
                    <?php if ($row["tag"]==2){?>
                        <td id="disabled"><a href="#" title="已设为了管理员"><i>已设为管理员</i></a></td>
                    <?php } elseif ($row["tag"]==1){?>
                        <td><a href="../C/doActionManageUser.php?id=<?php echo "{$row["user_id"]}"?> && action=3"><i>设为管理员</i></a></td>
                    <?php }?>
                    <td><a href="../C/doActionManageUser.php?id=<?php echo "{$row["user_id"]}"?> && action=4"><i>删除</i></a></td>
               </tr>
               <?php }?>  
           </table>    
        </div>
    </div>
    

<?php 
require_once 'Footer.php';
?>
</body>
</html>
    