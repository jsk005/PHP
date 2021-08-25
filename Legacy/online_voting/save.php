<?php
require('connection.php');
$vote = $_REQUEST['vote'];

$sql ="UPDATE candidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_name='$vote'";
mysqli_query($dbconn,$sql);
mysqli_close($con);
?>