<?php
if (!isset($_SESSION)) {
    session_start();
}
session_destroy();
$_SESSION = array(); // 세션 정보 초기화
?>

<!DOCTYPE html>
<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>

        		<div id="page">
					<div id="header">
					<h5>Logged Out Successfully </h5>
					<p align="center">&nbsp;</p>
					</div>
					<a href="login.php">로그인</a> 화면으로 전환

				</div>

        </blockquote>

      </li>
    </ul>
  </section>
</div>

<?php require_once ('./layout/tail.php');?>

<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>
