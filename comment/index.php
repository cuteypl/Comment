<?php 
require_once 'indexHeader.php';
//require 'Application/C/check.php';
?>
<body id="page-top" class="index">
    <div class="mc"></div>
    <div id="register">
        <form action="Application/C/checkRegister.php" method="post" name="from1" id="form1" accept-charset="utf-8">
            <div class="form-group" class="notice"></div>
            <div class="form-group">
                <input type="text" name="rg-username" id="rg-username" placeholder="用户名" class="form-control" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="rg-userpass1" id="rg-userpass1" placeholder="密码" class="form-control" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="rg-userpass2" id="rg-userpass2" placeholder="确认密码" class="form-control" required="required">
            </div>
            <div class="form-group">
                <input type="email" name="rg-useremail" id="rg-useremail" placeholder="用户邮箱" class="form-control" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-group-lg btn-block" value="确认注册">
            </div>
        </form>
    </div>
    <div class="mc"></div>
    <div id="login">
        <form action="Application/C/checkLogin.php" method="post" name="from2" id="form2" accept-charset="utf-8">
            <div class="form-group" class="notice"></div>
            <div class="form-group">
                <input type="text" name="lg-username" id="lg-username" placeholder="用户名" class="form-control" required="required" />
            </div>
            <div class="form-group">
                <input type="password" name="lg-userpass" id="lg-userpass" placeholder="密码" class="form-control" required="required" />
            </div>
            <div class="form-group">
                <input type="text" name="lg-checkCode" id="lg-checkCode" placeholder="验证码" class="form-control" required="required" />
                <img src="Application/M/Functions/validationCode.php" id="lg-checkImg" onclick="RefreshImage('lg-checkImg')" />
                <a id="lg-a" title="看不清" href="#" onclick="RefreshImage('lg-checkImg')">看不清？</a>
                <a href="#" id="fgp">忘记密码？</a>    
            </div>
            <div class="form-group radio">
                <label class="radio-inline">
                    <input type="radio" name="optionsRadiosinline" id="optionsRadios1" value="option1" checked> 用户
                </label>
                <label class="radio-inline">
                    <input type="radio" name="optionsRadiosinline" id="optionsRadios2" value="option2"> 管理员
                </label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-group-lg btn-block" value="登录">
            </div>
        </form>
    </div>
    <div class="mc"></div>
    <div id="forgetpass">
        <form action="Application/C/sendemail.php" method="post" name="from0" id="form0" accept-charset="utf-8"> 
            <div class="form-group" class="notice" id="chkmsg"></div>
            <div class="form-group">
                <span>输入您注册的电子邮箱，找回密码</span>
            </div>
            <div class="form-group">
                <input type="email" name="fgp-email" id="fgp-email" placeholder="用户邮箱" class="form-control" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-group-lg btn-block" value="提交" id="sub_btn">
            </div>
        </form>
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">留言簿</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li class="hidden">
                        <a href="#page-top"></a>
                    </li>-->
                    <li class="page-scroll">
                        <a href="#" id="Msg">我要留言</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#" id="Rpl">我要回复</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#" id="log">登录</a>
                    </li>
					<li class="page-scroll">
                        <a href="#" id="reg">注册</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- About Section -->
    <header class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>欢迎留言</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-lg-4 col-lg-offset-2">
                    <p>欢迎留言</p>
                    <p>欢迎吐槽</p>
                </div>
                <div class="col-lg-4">
                    <p>您的留言是我们进步的动力</p>
                    <p>吐槽是社会进步的一大因素</p>
                </div>-->
                <div class="col-lg-6 col-lg-offset-3">
                    <p>欢迎使用留言簿！若您还没有注册！请先注册！</p>
                    <p>若您还没有登录，请先登录！即可向我们留言哦！</p>                  
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a href="#" class="btn btn-lg btn-outline" id="QMsg" title="您还没有登录！">
                        <i class="fa"></i> 快去留言吧
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>我们的位置</h3>
                        <p>宣城市<br>合肥工业大学</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>您要分享给</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>关于留言簿</h3>
                        <p>留下你的足迹.</p>
                        <p>见证我们的改变.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; 留言簿 2014
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php 
require_once 'indexFooter.php';
?>
</body>
</html>
