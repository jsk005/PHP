<?php
require('connection.php');
//Process
if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email'])){
    $myName = addslashes( $_POST['name'] ); //prevents types of SQL injection
    $myEmail = $_POST['email'];
    $myPassword = $_POST['password'];
    $myVoterid = $_POST['voter_id'];

    $newpass = md5($myPassword);
    $sql ="INSERT INTO members(name, email, voter_id, password) VALUES ('$myName','$myEmail','$myVoterid', '$newpass')";
    $result =mysqli_query($dbconn,$sql);
    if($result){
        header("location:login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->

</head>
<body id="top">

<div class="wrapper row1">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>

<div>
  <center><h3>회원 등록 사항</h3></center>
</div>

<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" id="registerForm" method="post" action="registeracc.php">
<td>
<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
	<td style="color:#000000"; width="120" >Name</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input type="text" name="name" value=""></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="150" >Email</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input type="text" name="email" value="" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="120" >Voter Id</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input type="text" name="voter_id" value=""></td>
	</tr>

	<tr>
	<td style="color:#000000"; >패스워드</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="password" type="password" value=""></td>
	</tr>

	<tr>
	<td style="color:#000000"; >패스워드 확인</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="repassword" type="password" value=""></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td style="color:#000000";><input type="submit" name="submit" value="회원등록"></td>
	</tr>

</table>
</td>
</form>
</tr>
</table>

<center>
<br>이미 가입되어있나요? <a href="login.php"><b>로그인 전환</b></a>
</center>

        </blockquote>

      </li>
    </ul>
  </section>
</div>
<?php require_once ('./layout/tail.php');?>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
<script language="JavaScript" src="js/user.js"></script>
<script src="login.js"></script>
</body>
</html>

