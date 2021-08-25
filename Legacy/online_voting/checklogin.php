<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>온라인 투표</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>

<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
      <li class="one_half">

      	<div >
		<h3>Invalid Credentials Provided </h3>

		</div>

		<div>

		<?php
			ini_set ("display_errors", "1");
			error_reporting(E_ALL);
			ob_start();

			require_once('connection.php');

			// Defining your login details into variables
			$myusername=$_POST['myusername'];
			$mypassword=$_POST['mypassword'];
			$encrypted_mypassword=md5($mypassword); //MD5 Hash for security

			// MySQL injection protections
			$myusername = stripslashes($myusername);
			$mypassword = stripslashes($mypassword);
			$myusername = mysqli_real_escape_string($dbconn,$myusername);
			$mypassword = mysqli_real_escape_string($dbconn,$mypassword);

			$sql = "SELECT count(*) FROM members WHERE email='$myusername' and password='$encrypted_mypassword'";
			$rs = mysqli_query($dbconn,$sql);
			if($row= mysqli_fetch_array($rs)){
				if($row[0] == 1){
					$sql="SELECT * FROM members WHERE email='$myusername' and password='$encrypted_mypassword'";
					$result=mysqli_query($dbconn,$sql);
					$user = mysqli_fetch_array($result);
					$_SESSION['member_id'] = $user['member_id'];
					$_SESSION['member_name'] = $user['name'];
					$_SESSION['admin'] = $user['admin'];
					header("location:voter.php");
				}else {
					echo "ID, 패스워드를 확인하세요<br><br>Return to <a href=\"login.php\">Login</a>";
				}
			}
			ob_end_flush();
		?>
		</div>

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
</body>
</html>



