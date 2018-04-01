<?php
require_once 'Header.php';
?>
<body>
    <?php
    session_start();
    $role_tag=$_SESSION["role"]; 
    if ($role_tag==1){
        require_once 'user_Navbar.php';
    }
    elseif ($role_tag==2){
        require_once 'admin_Navbar.php';
    }
    ?>
    
    <!-- Setting -->
    <div id="userSetting">
        <div class="container">
        <div id="modifylable"><h3>修改密码</h3></div>
        <form class="form-horizontal" action="../C/modifypass.php" method="post" name="form4" id="form4" accept-charset="utf-8">
            <div class="form-group">
                <label for="inputPass" class="col-sm-offset-2 col-sm-2 control-label">旧密码</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputPass" name="Password" placeholder="请输入旧密码" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNewPass1" class="col-sm-offset-2 col-sm-2 control-label">新密码</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputNewPass1" name="NewPass1" placeholder="请输入新密码" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNewPass2" class="col-sm-offset-2 col-sm-2 control-label">确认密码</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputNewPass2" name="NewPass2" placeholder="请再输入一遍新密码" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-custom" id="Send">提交</button>
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