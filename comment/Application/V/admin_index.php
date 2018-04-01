<?php 
require_once 'Header.php';
?>
<body>
  <?php 
    session_start();
    header("content-type:text/html;charset=utf-8");
    require_once '../M/config/config.php';
    require_once '../M/Functions/mysql.func.php';
    require_once '../M/Functions/Page.Class.php';
    require '../C/check.php';
    $conn = connect3();
    $admin_name=$_SESSION["username"];
  ?>
 
  <?php 
  require_once 'admin_Navbar.php';
  ?>
    
    <!-- adminContent  Section -->    
    <div id="user-Msg">
        <div class="container"> 
        <?php
        //分页
        $sql="select count(*) as total from db_usercomment";   
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        $total=mysqli_fetch_assoc($query);        
        $total["total"];
        $url=$_SERVER['PHP_SELF'];
        $Page=new Page($total["total"],10,$url); 
        
            
        $sql="SELECT * FROM db_usercomment ORDER BY item_id DESC {$Page->limit}";//limit {$Page->offset},10
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
            $sql="select user_name from db_user where user_id='{$row["user_id"]}'";
            $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
            $username = mysqli_fetch_assoc($query);
            $username["user_name"];
        ?>
           <div class="row">
                <div class="col-md-offset-1 col-md-9">
                    <div class="article">
                        <div class="articleHeader">
                            <h4><a href="displayReply.php?id=<?php echo "{$row["item_id"]}"?>" target="_blank"><?php echo "{$row["item_name"]}"?></a></h4>
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
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row["item_id"]}"?> && action=1 &&userid=<?php echo "{$row["user_id"]}"?>"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除&nbsp;&nbsp;</a></li>
						    </ul>
						    <!-- <a href="#" class="btn btn-readmore btn-info btn-xs">阅读更多</a>-->
					    </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="categories" title="点击跳转到分类浏览"><a href="Categories.php"><i class="fa fa-bars">&nbsp;&nbsp;</i>分类</a></div>
            <?php }?>  
            
            <!-- 分页 -->
            <div class="showpage">
            <?php  
                if ($total["total"] > 10) {//总记录数大于每页显示数，显示分页                     
                  $Page->show();  
                 }  
            ?>
            </div>  
                        
            <div style="clear: both;"></div>                
        </div>
    </div>
    
<?php 
require_once 'Footer.php';
?>
</body>
</html>


