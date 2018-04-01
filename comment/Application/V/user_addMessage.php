<?php 
require_once 'Header.php';
?>
<body>
    <?php 
    require_once 'user_Navbar.php';
    ?>
    
    <!-- Add Message -->
    <div id="userAddMsg">
        <div class="container">
        <form class="form-horizontal" action="../C/addMessage.php" method="post" name="form3" id="form3" accept-charset="utf-8">
            <div class="form-group">
                <label for="inputTitle" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTitle" name="itemTitle" placeholder="请输入留言标题" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContent" class="col-sm-2 control-label">正文</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="15" id="inputContent" name="itemMsg" placeholder="请输入正文" required="required"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-custom" id="userSend">提交</button>
                </div>
            </div>
        </form>
        </div>
    </div>
     
<?php 
require_once 'Footer.php';
?>
</body>
</html>
