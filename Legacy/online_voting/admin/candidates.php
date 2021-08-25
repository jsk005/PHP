<?php
if (!isset($_SESSION)) {
    session_start();
}
require('../connection.php');
if(isset($_SESSION['admin']) && $_SESSION['admin']!=1){
  header("location:access-denied.php");
}
$result=mysqli_query($dbconn,"SELECT * FROM candidates");
if (mysqli_num_rows($result)<1){
	$result = null;
}


if (isset($_POST['Submit'])){
    $newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
    $newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
	$sql ="INSERT INTO candidates(candidate_name,candidate_position) VALUES ('$newCandidateName','$newCandidatePosition')";
    mysqli_query($dbconn,$sql);
     header("Location: candidates.php");
}

if (isset($_POST['Update'])){
    $idx = $_POST['idx'];
    $newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
    $newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
    $sql ="Update candidates SET candidate_name='$newCandidateName',candidate_position='$newCandidatePosition' where idx=$idx";
    mysqli_query($dbconn,$sql);
    header("Location: candidates.php");
}


if (isset($_GET['id']) && isset($_GET['mode']) && $_GET['mode']=='delete'){
	$id = $_GET['id'];
	$result = mysqli_query($dbconn,"DELETE FROM candidates WHERE idx='$id'");
	header("Location: candidates.php");
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
<CAPTION><h4>후보자
    <?php if(isset($_GET['mode']) && $_GET['mode']=='update'){
            echo '수정';
            require_once '../phpclass/dbClass.php';
            $c = new MySQLiDbClass;
            $R = $c -> getDbData('candidates', 'idx='.$_GET['id'], '*');
    }else{
        echo '추가';
    }
    ?></h4></CAPTION>
<form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)">
    <?php if(isset($_GET['mode']) && $_GET['mode']=='update'):?>
    <input type="hidden" name="idx" value="<?php echo $R['idx'];?>" />
    <?php endif;?>
<tr>
    <td bgcolor="#FAEBD7">후보자 이름</td>
    <td bgcolor="#FAEBD7"><input type="text" name="name" value="<?php echo isset($_GET['mode']) && $_GET['mode']=='update' ? $R['candidate_name']:'';?>" /></td>
</tr>

<tr>
    <td bgcolor="#7FFFD4">후보자 분류</td>
    <td bgcolor="#7FFFD4"><SELECT NAME="position" id="position">select
    <OPTION VALUE="select">select
    <?php
        $sql ="SELECT * FROM positions";
        $positions_retrieved=mysqli_query($dbconn,$sql);
        while ($row=mysqli_fetch_array($positions_retrieved)){
          echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
        }
    ?>
    </SELECT>
    </td>
</tr>
<tr>
    <td bgcolor="#BDB76B">&nbsp;</td>
    <?php if(isset($_GET['mode']) && $_GET['mode']=='update'):?>
    <td bgcolor="#BDB76B"><input type="submit" name="Update" value="수정" /></td>
    <?php else:?>
    <td bgcolor="#BDB76B"><input type="submit" name="Submit" value="추가" /></td>
    <?php endif;?>
</tr>
</form>
</table>
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>후보자 현황</h3></CAPTION>
<tr>
<th>ID</th>
<th>후보자 이름</th>
<th>분류</th>
<th>수정</th>
<th>삭제</th>
</tr>

<?php
    while ($row=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['idx']."</td>";
        echo "<td>" . $row['candidate_name']."</td>";
        echo "<td>" . $row['candidate_position']."</td>";
        echo '<td><a href="candidates.php?id=' . $row['idx'] . '&mode=update">수정</a></td>';
        echo '<td><a href="candidates.php?id=' . $row['idx'] . '&mode=delete">삭제</a></td>';
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

