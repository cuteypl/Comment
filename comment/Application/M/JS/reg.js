function RefreshImage(id){
    document.getElementById(id).src="Application/M/Functions/validationCode.php?num="+Math.random();//Math.random()生成一个小于1的数，后面加  ？num="+Math.random()传入一个不同的参数，加载新的图片，若没有后面的则浏览器就直接读取缓存的图片，而不会更新
}
$(function() {
    $('#reg').click(function() {
        $('.mc').css('display', 'block');
        $('#register').css('display', 'block');
    });
    $('#log').click(function() {
        $('.mc').css('display', 'block');
        $('#login').css('display', 'block');
    });
    $('#Msg').click(function() {
        $('.mc').css('display', 'block');
        $('#login').css('display', 'block');
    });
    $('#Rpl').click(function() {
        $('.mc').css('display', 'block');
        $('#login').css('display', 'block');
    });
    $('#QMsg').click(function() {
        $('.mc').css('display', 'block');
        $('#login').css('display', 'block');
    });
    $('#fgp').click(function() {
        $('.mc').css('display', 'block');
        $('#forgetpass').css('display', 'block');
    });

    $('#form1').submit(function() {
        if ($("#rg-userpass1").val() != $('#rg-userpass2').val()) {
            $('.notice').html('密码和确认密码不一致！').css('color', 'red');
            return false;
        }
    });

    //检查在找回密码时输入的邮箱是否正确
     /*$("#sub_btn").click(function(){
    	 var email=$("#fgp-email").val();*/
    	 //var preg=/^w+([-+.])W+)*@W+([-.]w+)*.w+([-.]W+)*/;
    	 /*if(email==''||!preg.test(email)){
    		 $("#chkmsg").html("请填写正确的邮箱！");
    	 }
    	 else{
    		 $("#sub_btn").attr("disabled","disabled").val('提交中..').css("cursor","default");
    		 $.post("sendmail.php",{mail:email},function(msg){
    			 if(msg=="noreg"){
    				 $("#chkmsg").html("该邮箱尚未注册！");
    				 $("#sub_btn").removeAttr("disabled").val('提交').css("cursor","pointer");
    			 }
    			 else{
    				 $(".demo").html("<h3>"+msg+"</h3>");
    			 }
    		 });
    	 }
     });  */
       /* //验证用户名的为空性
        if ($('#rg-username').val() == '') {
            $('.notice').html('用户名不能为空！').css('color', 'red');
            return false;
        }
        
        //判断密码是否为空
        if ($('#rg-userpass1').val() == '') {
            $('.notice').html('密码不能为空！').css('color', 'red');
            return false;
        } else if ($('#rg-userpass2').val() == '') {
            $('.notice').html('确认密码不能为空！').css('color', 'red');
            return false;
        } else if ($("#rg-userpass1").val() != $('#rg-userpass2').val()) {
            $('.notice').html('密码和确认密码不一致！').css('color', 'red');
            return false;
        }
        //判断邮箱是否为空
        if ($('#rg-useremail').val() == '') {
            $('.notice').html('邮箱不能为空！').css('color', 'red');
            return false;
        }*/
   
});
