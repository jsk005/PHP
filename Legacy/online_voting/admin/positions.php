<?php
if (!isset($_SESSION)) {
    session_start();
}
require('../connection.php');
if(isset($_SESSION['admin']) && $_SESSION['admin']!=1){
   header("location:access-denied.php");
}

$sql ="SELECT * FROM positions";
$result=mysqli_query($dbconn,$sql);
if (mysqli_num_rows($result)<1){
	$result = null;
}

// inserting sql query
if (isset($_POST['Submit'])){
	$newPosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
	$sql = "INSERT INTO positions(position_name) VALUES ('$newPosition')";
	mysqli_query($dbconn,$sql);
	header("Location: positions.php");
}

if (isset($_POST['Update'])){
    $idx = $_POST['idx'];
    $newPosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
    $sql ="Update positions SET position_name='$newPosition' where idx=$idx";
    mysqli_query($dbconn,$sql);
     header("Location: positions.php");
}

// deleting sql query
if (isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode']=='delete') {
 $id = $_GET['id'];
 $sql = "DELETE FROM positions WHERE idx='".$id."'";
 $result = mysqli_query($dbconn,$sql);
 header("Location: positions.php");
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
<div >
	<table width="380" align="center">
	<CAPTION><h4>후보자 분류
	<?php if(isset($_GET['mode']) && $_GET['mode']=='update'){
            echo '수정';
            require_once '../phpclass/dbClass.php';
            $c = new MySQLiDbClass;
            $R = $c -> getDbData('positions', 'idx='.$_GET['id'], '*');
    }else{
        echo '추가';
    }
	?></h4></CAPTION>
	<form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return positionValidate(this)">
		<?php if(isset($_GET['mode']) && $_GET['mode']=='update'):?>
		<input type="hidden" name="idx" value="<?php echo $R['idx'];?>" />
		<?php endif;?>
	<tr>
	    <td bgcolor="#00ff80">분류</td>
	    <td bgcolor="#808080"><input type="text" name="position" value="<?php echo isset($_GET['mode']) && $_GET['mode']=='update' ? $R['position_name']:'';?>" /></td>
		<?php if(isset($_GET['mode']) && $_GET['mode']=='update'):?>
		<td bgcolor="#00FF00"><input type="submit" name="Update" value="수정" /></td>
		<?php else:?>
	    <td bgcolor="#00FF00"><input type="submit" name="Submit" value="추가" /></td>
		<?php endif;?>
	</tr>
	</table>

	<table border="0" width="420" align="center">
		<CAPTION><h4>분류 현황</h4></CAPTION>
		<tr>
		<th>ID</th>
		<th>분류</th>
		<th>수정</th>
		<th>삭제</th>
		</tr>

		<?php
			while ($row=mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['idx']."</td>";
				echo "<td>" . $row['position_name']."</td>";
				echo '<td><a href="positions.php?id='. $row['idx'].'&mode=update">수정</a></td>';
				echo '<td><a href="positions.php?id='. $row['idx'].'&mode=delete">삭제</a></td>';
				echo "</tr>";
			}
			mysqli_free_result($result);
		?>

	</table>
	<hr>
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

