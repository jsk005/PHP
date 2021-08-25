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

<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left">
      <h1><a href="index.php">온라인 투표</a></h1>
    </div>

	<nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="access-denied.php">Home</a></li>

        <li><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li><a href="login.php">로그인</a></li>
            <li><a href="registeracc.php">회원가입</a></li>

          </ul>
        </li>

      </ul>
    </nav>
  </header>
</div>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear">
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Online <a href="#">Voting</a></h2>
    <ul class="nospace group">
      <li class="one_half">


      	<div id="container">
		<div class="err">Access Denied!</div>
		  <p>You don't have access to this resource. <a href="login.php">Click here</a> to login first.</p>
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



