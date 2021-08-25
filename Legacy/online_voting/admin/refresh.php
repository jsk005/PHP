<?php
if (!isset($_SESSION)) {
    session_start();
}
require('../connection.php');

if (isset($_POST['Submit'])){
  $position = addslashes( $_POST['position'] );

    $results = mysqli_query($dbconn,"SELECT * FROM candidates where candidate_position='$position'");

    $row1 = mysqli_fetch_array($results); // for the first candidate
    $row2 = mysqli_fetch_array($results); // for the second candidate
      if ($row1){
      $candidate_name_1=$row1['candidate_name']; // first candidate name
      $candidate_1=$row1['candidate_cvotes']; // first candidate votes
      }

      if ($row2){
      $candidate_name_2=$row2['candidate_name']; // second candidate name
      $candidate_2=$row2['candidate_cvotes']; // second candidate votes
      }
}

if(isset($_SESSION['admin']) && $_SESSION['admin']!=1){
 header("location:access-denied.php");
}
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>


<!DOCTYPE html>
<html>
<head>
<title>online voting</title>

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

<script language="JavaScript" src="js/admin.js">
</script>

</head>
<body id="top">
<?php require_once ('header.php');?>

<div >
  <div >
    <table width="420" align="center">
    <form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
    <tr>
        <td style="color:#000000";>분류 선택</td>
        <td><SELECT NAME="position" id="position">
        <OPTION  VALUE="select"><p style="color:black";>select</p>
        <?php
			$sql = "SELECT * FROM positions";
			$positions=mysqli_query($dbconn,$sql);
			while ($row=mysqli_fetch_array($positions)){
			  echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
			}
        ?>
        </SELECT></td>
        <td style="color:black";><input type="submit" name="Submit" value="See Results" /></td>
    </tr>
    <tr>


    </tr>
    </form>
    </table>
    <?php if(isset($_POST['Submit'])){echo $candidate_name_1;} ?>:<br>
    <img src="images/candidate-1.gif"
    width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>'
    height='10'>
    <?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
    <br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_1;} ?>
    <br>
    <br>
    <?php if(isset($_POST['Submit'])){ echo $candidate_name_2;} ?>:<br>
    <img src="images/candidate-2.gif"
    width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>'
    height='10'>
    <?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
    <br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_2;} ?>

  </div>

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

