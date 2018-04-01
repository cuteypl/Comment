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
    $role_tag=$_SESSION["role"]; 
    if ($role_tag==1){
        require_once 'user_Navbar.php';
    }
    elseif ($role_tag==2){
        require_once 'admin_Navbar.php';
    }
    ?>   
    <div id="user-Msg">
        <div class="container"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#datecategories" aria-controls="datecategories" role="tab" data-toggle="tab">按时间分</a></li>
                <li role="presentation"><a href="#authorcategories" aria-controls="authorcategories" role="tab" data-toggle="tab">按留言者</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- 按时间分 -->
                <div role="tabpanel" class="tab-pane active" id="datecategories">
                    <?php
                    $i=0;   
                    $sql="SELECT distinct item_date FROM db_usercomment";
                    $result1=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
                    if (mysqli_num_rows($result1)<=0){
                    ?>
                    <p style="font-size: 26px; margin-top:196px; text-align:center; ">暂时还没有留言哦！</p>
                    <?php } 
                    else{
                    //关联数组
                    while (($dategroup=mysqli_fetch_array($result1, MYSQLI_ASSOC))>0){
                        $dategroup[]=$dategroup;
                        $sql="select *from db_usercomment where item_date='{$dategroup["item_date"]}'";
                        $result2=mysqli_query($conn, $sql)or die("Invalid query:".mysqli_error($conn));
                     ?> 
                     <a href="#" class="cateathor"><span class="catelable"><?php echo "{$dategroup["item_date"]}"?></span></a>                          
                     <?php
                        while(($row=mysqli_fetch_array($result2,MYSQLI_ASSOC))>0){
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
                            <div class="col-md-offset-2 col-md-9">                             
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
                    <?php }}}?>    
                </div>
                
               <!--  按留言者分 -->
                <div role="tabpanel" class="tab-pane" id="authorcategories">
                    <?php   
                    $sql="select distinct user_id from db_usercomment";
                    $result1=mysqli_query($conn,$sql) or die("Invalid query:".mysqli_error($conn));
                    if (mysqli_num_rows($result1)<=0){
                    ?>
                    <p style="font-size: 26px; margin-top:196px; text-align:center; ">暂时还没有留言哦！</p>
                    <?php } 
                    else{                          
                       while (($usergroup=mysqli_fetch_array($result1, MYSQLI_ASSOC))>0){
                           $usergroup[]=$usergroup;
                           $sql="select user_name from db_user where user_id='{$usergroup["user_id"]}'";
                           $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
                           $username=mysqli_fetch_assoc($query);
                           $username["user_name"];
                           $sql="select *from db_usercomment where user_id='{$usergroup["user_id"]}'";//按用户id分类
                           $result2=mysqli_query($conn, $sql)or die("Invalid query:".mysqli_error($conn));
                    ?>
                    <a href="#" class="cateathor"><span class="catelable"><?php echo "{$username["user_name"]}"?></span></a>
                    <?php 
                    //关联数组
                    while(($row=mysqli_fetch_array($result2,MYSQLI_ASSOC))>0){
                        $row[]=$row;
                        $totallen=strlen($row["item_content"]);
                        $content=substr($row["item_content"], 0,512);//读取留言的前171个字
                        $sql="select count(*) as totalNum from db_reply where item_id='{$row["item_id"]}' and replyer_tag=2";
                        $query=mysqli_query($conn, $sql) or die("Invalid query:".mysqli_error($conn));
                        $count = mysqli_fetch_assoc ( $query );
                        $count ["totalNum"];                      
                    ?>
                       <div class="row">
                            <div class="col-md-offset-2 col-md-9">
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
                        <?php }}}?>    
                </div>
            </div>
            <div style="clear: both;"></div>                
        </div>
    </div>
    
<?php 
require_once 'Footer.php';
?>
</body>
</html>