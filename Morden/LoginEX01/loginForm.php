<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="form.css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#login-submit').click(function(e){
		var userID = $("input[name='userID']");
		if( userID.val() =='') {
            alert("아이디를 입력하세요");
            userID.focus();
            return false;
        }

		var password = $("input[name='password']");
		if(password.val() =='') {
            alert("비밀번호를 입력하세요!");
            password.focus();
            return false;
        }
        $.ajax({
            url: 'a.loginChk.php',
            type: 'POST',
            data: {userID:userID.val(), password:password.val()},
            dataType: "json",
            success: function (response) {
                if(response.result == 1){
                    //alert('로그인 성공');
                    location.href='index.php';
                } else if(response.result == -2){
                 	alert('입력한 값에 문제가 있습니다');
                } else {
                    alert('로그인 실패');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("arjax error : " + textStatus + "\n" + errorThrown);
            }
        });
	});
});
</script>
</head>
<body>
<div class="container">
<h2>로그인 Form 예제</h2>
<form method="post" action="a.loginChk.php">
	<table>
		<tr>
			<td style="font-size:14px">로그인 ID</td>
			<td><input type="text" name="userID" value=""></td>
		</tr>
		<tr>
			<td style="font-size:14px">패스워드</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan='2' align=left>
				<input type="button" id="login-submit" value="로그인">
			</td>
		</tr>
		<tr>
			<td colspan='2'><p>회원이 아니신가요? <a href="joinForm.php">회원가입 하기</a></p></td>
		</tr>
	</table>
</fom>
</div>
</body>
</html>
