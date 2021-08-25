<!DOCTYPE html>
<html>
<head>
	<title>온라인 투표</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
	<script language="JavaScript" src="js/user.js"></script>

</head>
<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
	<section id="testimonials" class="hoc container clear">
		<ul class="nospace group">
			<li class="one_half">
				<blockquote>

					<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
						<tr>
							<form name="form1" id="loginForm" method="post" action="checklogin.php" >
								<td>
								<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >
									<tr>
										<td style="color:#000000"; width="78" >Email</td>
										<td style="color:#000000"; width="6">:</td>
										<td style="color:#000000"; width="294">
										<input type="text" name="myusername" id="myusername">
										</td>
									</tr>
									<tr>
										<td style="color:#000000"; >Password</td>
										<td style="color:#000000"; >:</td>
										<td style="color:#000000"; >
										<input type="password" name="mypassword" id="mypassword">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td style="color:#000000";>
										<input type="submit" name="Submit" value="Login">
										</td>
									</tr>
								</table></td>
							</form>
						</tr>
					</table>
					<center>
						<br>
						<a href="registeracc.php"><b>회원 가입</b></a>
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
<script src="login.js"></script>
</body>
</html>

