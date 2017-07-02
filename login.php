<?php
	ini_set("display_errors", 1);
	include_once('include/DB.php');
?>
<html>
<head>
	<!-- Standard Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<!-- Site Properities -->
	<title>校園授權軟體-登入</title>
    <link rel="stylesheet" type="text/css" href="css/semantic.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
	<!-- Used with Tab History !-->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
	<script src="js/semantic.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
</head>
<body>
	<script>
	function login(){
		$('#input_account,#input_password,#identity_field').removeClass("error");
		$('#account_error,#password_error,#login_error,#identity_error').remove();
		
		var ACCOUNT = $("#account").val();
		var PASSWORD = $("#password").val();
		var IDENTITY = $('input:radio:checked[name="identity"]').val();
		if(ACCOUNT.length > 0 && PASSWORD.length > 0 && IDENTITY != null){	
			$.ajax({
				url: "./login_check.php",
				type: "post",
				data: {
					account:ACCOUNT,
					password:PASSWORD,
					identity:IDENTITY
				},
				success: function(data) {
					/*if(data == "success")
						window.location.replace("index.php");
					else if(data == "error"){
						$('#login_form').before("<div id=\"login_error\" class=\"color-a94442\">使用者名稱與密碼不符</div>");
						$("#password").val("");
					}	*/
					alert(data);
				}
			});
		}else{
			if(ACCOUNT.length == 0){
				$('#input_account').addClass("error");
				$('#account_field').before("<div id=\"account_error\" class=\"color-a94442\">請輸入帳號</div>")
			}			
			if(PASSWORD.length == 0){
				$('#input_password').addClass("error");
				$('#password_field').before("<div id=\"password_error\" class=\"color-a94442\">請輸入密碼</div>")
			}
			if(IDENTITY == null){
				$('#identity_field').addClass("error");
				$('#identity_field').before("<div id=\"identity_error\" class=\"color-a94442\">請選擇身分</div>")
			}
		}
	}
	</script>
	<div class="s_main">
    	<div class="s_container s_center">
        	<div class="s_description">
            	<div class="s_header"><i class="warning icon"></i>第一次登入請注意</div>
                <p class="font-size-16 color-666">學生:<br>
				&nbsp;&nbsp;&nbsp;&nbsp;帳號:學號<br>
				&nbsp;&nbsp;&nbsp;&nbsp;密碼:選課密碼<br>
				&nbsp;&nbsp;&nbsp;&nbsp;忘記密碼<br>
				其他:<br>
				&nbsp;&nbsp;&nbsp;&nbsp;帳號:身份證字號(首字大寫)<br>
				&nbsp;&nbsp;&nbsp;&nbsp;密碼:行政自動化密碼<br>
				&nbsp;&nbsp;&nbsp;&nbsp;忘記密碼</p>
            </div>
        	<div class="s_login">
				<form id="login_form" class="ui form">
					<div id="account_field" class="inline fields">
						<label>帳號</label>
						<div id="input_account" class="field">
							<input id="account" type="text" name="account" placeholder="帳號">
						</div>
					</div>
					<div id="password_field" class="inline fields">
						<label>密碼</label>
						<div id="input_password" class="field">
							<input id="password" type="password" name="password" placeholder="密碼">
						</div>
					</div>
					<div id="identity_field" class="inline fields">
						<label for="identity">登入身分:</label>
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="identity" tabindex="0" class="hidden" value="student">
								<label>學生</label>
							</div>
						</div>
						<div class="field">
							<div class="ui radio checkbox">
								<input type="radio" name="identity" tabindex="0" class="hidden" value="other">
								<label>其他</label>
							</div>
						</div>
					</div>
					<p class="margin-top-10">
					<input type="button" value="登入" class="s_button border-0 margin-right-5" onclick="login()">
					<input type="reset" value="重填" class="s_button border-0"></p>
				</form>
			</div>    
		</div>
	</div>
	<div class="ui vertical segment s_footer">
		<div class="s_center">
			<?php include_once 'footer.php';?>
		</div>
	</div>
</body>
</html>