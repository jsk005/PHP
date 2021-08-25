<?php
if (!isset($_SESSION)) {
    session_start();
}
require ('../connection.php');
if(isset($_SESSION['admin']) && $_SESSION['admin']!=1){
    header("location:access-denied.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>online voting</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
		<script language="JavaScript" src="js/admin.js"></script>

	</head>
	<body id="top">
		<?php
        require_once ('header.php');
    ?>

		<div id="container">
			<div class="wrapper bgded overlay" style="background-image:url('');">
				<section id="testimonials" class="hoc container clear">
					<ul class="nospace group">
						<li class="one_third">

							<blockquote>

								<?php
								if(empty($_SESSION['member_id'])){
                                    header("location:access-denied.php");
                                }
                                //Process
                                if (isset($_POST['submit'])) {
                                    $myName = addslashes($_POST['name']);
                                    $myEmail = $_POST['email'];
                                    $myPassword = $_POST['password'];

                                    $newpass = md5($myPassword);
                                    //This will make your password encrypted into md5, a high security hash

                                    $sql = mysqli_query($dbconn,"INSERT INTO admin(name, email, password) VALUES ('$myName','$myEmail', '$newpass')");

                                }
                                //Process
                                if (isset($_GET['id']) && isset($_POST['update'])) {
                                    $myId = addslashes($_GET['id']);
                                    $myName = addslashes($_POST['name']);
                                    $myEmail = $_POST['email'];
                                    $myPassword = $_POST['password'];
                                    $newpass = md5($myPassword);
                                    $sql = mysqli_query($dbconn,"UPDATE admin SET name='$myName', email='$myEmail', password='$newpass' WHERE admin_id = '$myId'");
                                }
								?>
							</blockquote>
						</li>

					</ul>

				</section>
			</div>

			<table align="center">
				<tr>
					<td>
					<form action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
						<table align="center">
							<CAPTION>
								<h4>UPDATE ACCOUNT</h4>
							</CAPTION>
							<tr>
								<td>First Name:</td><td>
								<input type="text"  font-weight:bold;" name="firstname" maxlength="15" value=""></td></tr>
								<tr><td>Last Name:</td><td><input type="text" font-weight:bold;" name="lastname" maxlength="15" value="">
								</td>
							</tr>
							<tr>
								<td>Email Address:</td><td>
								<input type="text"  font-weight:bold;" name="email" maxlength="100" value=""></td></tr>
								<tr><td>New Password:</td><td><input type="password"  font-weight:bold;" name="password" maxlength="15" value="">
								</td>
							</tr>
							<tr>
								<td>Confirm New Password:</td><td>
								<input type="password"  font-weight:bold;" name="ConfirmPassword" maxlength="15" value=""></td></tr>
								<tr><td>&nbsp;</td><td><input type="submit" name="update" value="Update Account"></td></tr>
								</table>
								</form>

								</td>
								<td>

								<form action="manage-admins.php" method="post" onSubmit="return registerValidate(this)">
								<table align="center">
								<CAPTION><h4>CREATE ACCOUNT</h4></CAPTION>
								<tr><td>First Name:</td><td><input type="text"  font-weight:bold;" name="firstname" maxlength="15" value="">
								</td>
							</tr>
							<tr>
								<td>Last Name:</td><td>
								<input type="text" font-weight:bold;" name="lastname" maxlength="15" value=""></td></tr>
								<tr><td>Email Address:</td><td><input type="text"  font-weight:bold;" name="email" maxlength="100" value="">
								</td>
							</tr>
							<tr>
								<td>Password:</td><td>
								<input type="password" font-weight:bold;" name="password" maxlength="15" value=""></td></tr>
								<tr><td>Confirm Password:</td><td><input type="password" font-weight:bold;" name="ConfirmPassword" maxlength="15" value="">
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td><td>
								<input type="submit" name="submit" value="Create Account">
								</td>
							</tr>
						</table>
					</form></td>
				</tr>
			</table>

		</div>

		<?php
    require_once ('../layout/tail.php');
?>

		<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
		<!-- JAVASCRIPTS -->
		<script src="layout/scripts/jquery.min.js"></script>
		<script src="layout/scripts/jquery.backtotop.js"></script>
		<script src="layout/scripts/jquery.mobilemenu.js"></script>
		<!-- IE9 Placeholder Support -->
		<script src="layout/scripts/jquery.placeholder.min.js"></script>
		<!-- / IE9 Placeholder Support -->
	</body>
</html>
