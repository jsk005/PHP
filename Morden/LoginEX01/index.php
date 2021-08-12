<?php
if(!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="form.css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div>
<?php
	if(isset($_SESSION['userID'])){
		echo $_SESSION['userNM'].'님이 로그인하셨습니다<br />';
	} else {
		echo("<meta http-equiv='Refresh' content='0; URL=loginForm.php'>");
	}
?>
Click here to clean <a href = "logout.php" tite = "Logout">Session.
</div>
</body>
</html>
