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
    $item_id=$_GET["id"];//取得留言的ID号
    $role_tag=$_SESSION["role"];
    
    $sql="select replyer_id from db_reply where item_id='{$item_id}' and replyer_tag=1";
    $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);
    $sql="select user_name from db_user where user_id='{$row["replyer_id"]}'";
    $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
    $row=mysqli_fetch_assoc($query);
    $user_name=$row["user_name"];
  ?>
  <?php 
    if ($role_tag==1){
        require_once 'user_Navbar.php';
    }
    elseif ($role_tag==2){
        require_once 'admin_Navbar.php';
    }
    ?>
  <?php   
        $sql="SELECT * FROM db_usercomment where item_id='{$item_id}'";
        $result=mysqli_query($conn,$sql);
        // 数字数组
        $row=mysqli_fetch_array($result,MYSQLI_NUM);
        $row[]=$row;
        $sql="select count(*) as totalNum from db_reply where item_id='{$row[0]}' and replyer_tag=2";
        $query=mysqli_query($conn, $sql);
        $count = mysqli_fetch_assoc ( $query );
        $count ['totalNum'];
  ?>

    <div id="displayReplycontent">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-1 col-md-10">
                <div class="article">
                    <div class="title">
                        <h2><?php echo "{$row[1]}"?></h2>
                    </div>
                    <div class="secTitleBar">
                        <ul class="list-unstyled list-inline">
                            <li class="page-scroll"><i class="fa fa-calendar">&nbsp;&nbsp;</i><?php echo"{$row[3]}"?>&nbsp;&nbsp;&nbsp;&nbsp;</li>
							<li class="page-scroll"><i class="fa fa-comments">&nbsp;&nbsp;</i>admin回复(<?php echo"{$count['totalNum']}"?>)&nbsp;&nbsp;</li>
                        </ul>
                    </div>
                    <div class="articleContent">
                        <p class="text-left"><?php echo"{$row[2]}"?></p>
                    </div>
                <?php            
                    $sql="SELECT * FROM db_reply where item_id='{$item_id}' ORDER BY reply_id DESC";
                    $result=mysqli_query($conn,$sql);
                    // 数字数组
                    while(($row=mysqli_fetch_array($result,MYSQLI_NUM))>0){
                        $row[]=$row;                      
                ?>
                    <?php 
                        if ($row[2]==2){
                    ?>
                    <div class="admin-replys"> 
                        <em class="adminLable">admin:</em> 
                        <div class="dividerline"></div>                                    
                        <p class="text-left"><?php echo "{$row[4]}"?></p>              
                        <div class="replyContentFooter clearfix" align="right">
						    <ul class="articleStatu list-unstyled list-inline">
							    <li class="page-scroll"><i class="fa fa-calendar">&nbsp;&nbsp;</i><?php echo "{$row[5]}"?>&nbsp;&nbsp;</li>
							    <?php 
							       if ($role_tag==1){
							    ?>
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row[0]}"?> && action=2 && tag=<?php echo "{$row[2]}"?> && replyerid=<?php echo "{$row[3]}"?>" title="您没有权限删除！"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除</a>&nbsp;&nbsp;</li>
							     <?php }  							     
							       elseif ($role_tag==2){				        							  
							    ?>
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row[0]}"?> && action=2 && tag=<?php echo "{$row[2]}"?> && replyerid=<?php echo "{$row[3]}"?>"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除</a>&nbsp;&nbsp;</li>
							    <?php }?>
							    <!-- <li class="page-scroll"><a href="#"><i class="fa fa-mail-reply">&nbsp;&nbsp;</i>回复&nbsp;&nbsp;</a></li> -->					    
						    </ul>
					    </div>
				    </div>
				    <?php }?>
				    <?php 
                       if ($row[2]=="1"){                     
                    ?>
				    <div class="user-replys"> 
                        <em class="userLable"><?php echo "{$user_name}"?>：</em> 
                        <!-- <div class="dividerline"></div>-->                                    
                        <p class="text-left"><?php echo "{$row[4]}"?></p>              
                        <div class="replyContentFooter clearfix" align="right">
						    <ul class="articleStatu list-unstyled list-inline">
							    <li class="page-scroll"><i class="fa fa-calendar">&nbsp;&nbsp;</i><?php echo "{$row[5]}"?>&nbsp;&nbsp;</li>
							    <li class="page-scroll"><a href="../C/delMessage.php?id=<?php echo "{$row[0]}"?> && action=2 && tag=<?php echo "{$row[2]}"?> && replyerid=<?php echo "{$row[3]}"?>"><i class="fa fa-trash-o">&nbsp;&nbsp;</i>删除</a>&nbsp;&nbsp;</li>
							    <!-- <li class="page-scroll"><a href="#"><i class="fa fa-mail-reply">&nbsp;&nbsp;</i>回复&nbsp;&nbsp;</a></li>-->					    
						    </ul>
					    </div>
				    </div>
				    <?php }?> 
                <?php }?><!-- while --> 
                <?php if (mysqli_num_rows($result)==0)  {?>
                    <div id="noReply">
                        <p> 共0条回复！<p>
                    </div>
                <?php }?>
				    <form class="form-horizontal" action="../C/doReply.php" method="post" name="form5" id="form5" accept-charset="utf-8">
                        <div class="form-group">
                            <!-- <label for="inputReplys" class="col-sm-2 control-label">回复</label> -->
                            <div class="col-sm-12">
                                <input type="hidden" name="item_id"   value="<?php echo $item_id?>"><!-- 隐藏传值 -->
                                <textarea class="form-control" rows="4" id="inputReplys" name="replyMsg" placeholder="回复：" required="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default btn-custom" id="replySend">提交</button>
                            </div>
                        </div>
                    </form>                                                                                          
                    
                </div>           
            </div>
        
        </div>
    </div>
    </div>
    
  <?php 
    require_once 'Footer.php';
  ?>
</body>
</html>