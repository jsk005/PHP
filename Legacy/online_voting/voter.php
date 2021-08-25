<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('connection.php');

if(empty($_SESSION['member_id'])){
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
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
      <li class="one_half first">
        <blockquote> <div id="container">
		<p> Click a link above voter pages to do some stuff.</p>
		</div> </blockquote>

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


