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
    $user_name=$_SESSION["username"];
    $sql="select user_id from db_user where user_name='{$user_name}'";
    $query=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);//$row["user_id"]
    $user_id=$row["user_id"];  //取得用户的ID
  ?>
  
  <?php 
  require_once 'user_Navbar.php';
  ?>
    
    <!-- userContent  Section -->    
    <div id="user-Msg">
        <div class="container">
        <?php   
        //分页
        $sql="select count(*) as total from db_usercomment where user_id='{$user_id}'";   
        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
        $total=mysqli_fetch_assoc($query);        
        $total["total"];
        $url=$_SERVER['PHP_SELF'];
        $Page=new Page($total["total"],10,$url); 
        
        $sql="SELECT * FROM db_usercomment where user_id='{$user_id}' ORDER BY item_id DESC {$Page->limit}";
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)<=0){
        ?>
        <p style="font-size: 26px; margin-top:196px; text-align:center; ">你暂时还没有留言哦！快去留下你的小脚丫吧！</p>
        <?php }
        else{        
        // 数字数组
        while(($row=mysqli_fetch_array($result,MYSQLI_NUM))>0){
            $row[]=$row;
            $totallen=strlen($row[2]);//计算留言的总长度
            $content=substr($row[2], 0,512);//只读取留言的前171个字
            $sql="select count(*) as totalNum from db_reply where item_id='{$row[0]}' and replyer_tag=2";
            $query=mysqli_query($conn, $sql);
            $count = mysqli_fetch_assoc ( $query );
            $count ['totalNum'];
        ?>
           <div class="row">
                <div class="col-md-offset-1 col-md-9">
                    <div class="article">
                        <div class="articleHeader">
                            <h4><a href="displayReply.php?id=<?php echo "{$row[0]}"?>"><?php echo "{$row[1]}"?></a></h4>
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
							    <li class="page-scroll"><i class="fa fa-calendar">&nbsp;&nbsp;</i><?php echo "{$row[3]}"?>&nbsp;&nbsp;</li>
							    <li class="page-scroll"><a href="displayReply.php?id=<?php echo "{$row[0]}"?>"><i class="fa fa-comments">&nbsp;&nbsp;</i>admin回复(<?php echo "{$count['totalNum']}"?>)&nbsp;&nbsp;</a></li>
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row[0]}"?> && action=1 && userid=<?php echo "{$row[4]}"?>"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除&nbsp;&nbsp;</a></li>
						    </ul>
						    <!-- <a href="#" class="btn btn-readmore btn-info btn-xs">阅读更多</a>-->
					    </div>
                    </div>
                </div>
            </div>
            <?php }}?>   
            
            <!-- 分页 -->
            <div class="showpage">
            <?php  
                if ($total["total"] > 10) {//总记录数大于每页显示数，显示分页                     
                  $Page->show();  
                 }  
            ?>
            </div>  
                           
        </div>
    </div>
 
<?php 
require_once 'Footer.php';
?>
</body>
</html>

