<?php /*a:1:{s:49:"F:\xampp\htdocs\ayaka\app\view\bslogin\index.html";i:1648451336;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo htmlentities($title); ?></title>
</head>
<body>
<link href="static/css/stylesbylogin.css" rel="stylesheet" type="text/css" />
<link href="static/css/sweetalert.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/js/jquery.js"></script>
<script type="text/javascript" src="static/js/sweetalert-dev.js"></script>
<div class="htmleaf-container">
	<div class="wrapper">
		<div class="container">
			<h1><span id='spId'>Welcome</span></h1>
			
			<form class="form">
				<input type="text" id='userid'  placeholder="请输入账号">
				<input type="password" id='userpassword'   placeholder="请输入密码">
				<input type="button" id="login-button"  value="登录">
			</form>
		</div>
</div>

<script>
//花里胡哨的显示
document.onkeydown = function (e) { // 回车提交表单
	if(e.key=='Enter'){
		$('#login-button').trigger("click");
	}
}
$('#login-button').click(function (event) {
	let $userid=$('#userid');
    let $password=$('#userpassword');
    // 按钮点击后检查输入框是否为空，为空则找到span便签添加提示
    if ($userid.val().length===0||$password.val().length===0)
    {
    	swal('用户名与密码都不能为空')
    }else{
    	$.ajax({
            type: "POST",
            url:"bslogin/logincheck",
            data:{USERID : $userid.val() , PASSWORD : $password.val()},
            dataType:'json',
            async: false,
            cache:false,
            error: function(request) {
            	swal("Please refresh the page and try again.");
            },
            success: function(data) {
                if(!data.isSuccess){
                	swal(data.message);
                }else{ 
                	event.preventDefault();//阻止 方法阻止元素发生默认的行为（例如，当点击提交按钮时阻止对表单的提交或者a标签）
                	$('form').fadeOut(500);
                	$('.wrapper').addClass('form-success');
//                 	$("#spId").text(data.message);
                	setTimeout(
                        	function(){ 
                            	location.href=""; 
                            	}, 1500
                            	);
                	
                }
            }
        });
    }
	
});
</script>

<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';color:#000000">
<h1>后台管理</h1>
</div>
</body>
</html>