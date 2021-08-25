<?php
if (!isset($_SESSION)) {
    session_start();
}
require('../connection.php');

if(isset($_SESSION['admin']) && $_SESSION['admin']==1){
    
}else{
   echo '<img src="e1.jpg" width="100%" height="100%"  />';  /* here goes the page when destroy the cookies */
   exit;
}
?>


<!DOCTYPE html>
<html>
<head>
<title>온라인 투표</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<?php require_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
       <li class="one_third">
          <blockquote>In this page, Admin can set candidates for voting and view results.</blockquote>
      </li>

    </ul>

  </section>
</div>

<?php require_once ('../layout/tail.php');?>

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
