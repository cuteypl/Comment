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
    $user_id=$_GET["id"];
  ?>
 
  <?php 
  require_once 'admin_Navbar.php';
  ?>
    
    <!-- adminContent  Section -->    
    <div id="user-Msg">
        <div class="container">
        <?php   
        $sql="SELECT * FROM db_usercomment where user_id='{$user_id}' ORDER BY item_id DESC";
        $result=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
        if (mysqli_num_rows($result)<=0){
        ?>
        <p style="font-size: 26px; margin-top:196px; text-align:center; ">暂时还没有留言哦！</p>
        <?php } 
        else{
        // 数字数组
        while(($row=mysqli_fetch_array($result,MYSQLI_ASSOC))>0){
            $row[]=$row;
            $totallen=strlen($row["item_content"]);
            $content=substr($row["item_content"], 0,512);//读取留言的前171个字
            $sql="select count(*) as totalNum from db_reply where item_id='{$row["item_id"]}' and replyer_tag=2";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            $count = mysqli_fetch_assoc ( $query );
            $count ["totalNum"];
            $sql="select user_name from db_user where user_id='{$user_id}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            $username = mysqli_fetch_assoc($query);
            $username["user_name"];
        ?>
           <div class="row">
                <div class="col-md-offset-1 col-md-9">
                    <div class="article">
                        <div class="articleHeader">
                            <h4><a href="displayReply.php?id=<?php echo "{$row["item_id"]}"?>"><?php echo "{$row["item_name"]}"?></a></h4>
                        </div>
                        <div class="articleBody clearfix">
                            <!--摘要-->
						    <div class="articleFeed">
						    <?php if (strlen($content)==$totallen){?>
						        <p><?php echo "{$content}"?></p>
						    <?php }elseif (strlen($content)<$totallen){?>
						        <p><?php echo "{$content}"?>...</p>
						    <?php }?>
						    </div>
						</div>
						<div class="articleFooter clearfix" align="right">
						    <ul class="articleStatu">
						        <li class="page-scroll"><i class="fa fa-user">&nbsp;&nbsp;</i><?php echo "{$username["user_name"]}"?>&nbsp;&nbsp;</li>
							    <li class="page-scroll"><i class="fa fa-calendar">&nbsp;&nbsp;</i><?php echo "{$row["item_date"]}"?>&nbsp;&nbsp;</li>
							    <li class="page-scroll"><a href="displayReply.php?id=<?php echo "{$row["item_id"]}"?>"><i class="fa fa-comments">&nbsp;&nbsp;</i>admin回复(<?php echo "{$count["totalNum"]}"?>)&nbsp;&nbsp;</a></li>
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row["item_id"]}"?>"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除&nbsp;&nbsp;</a></li>
						    </ul>
						    <!-- <a href="#" class="btn btn-readmore btn-info btn-xs">阅读更多</a>-->
					    </div>
                    </div>
                </div>
            </div>
            <?php }}?>                  
        </div>
    </div>
    
<?php 
require_once 'Footer.php';
?>
</body>
</html>
