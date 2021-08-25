<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once('connection.php');

if(empty($_SESSION['member_id'])){
    header("location:access-denied.php");
}

if (isset($_POST['Submit'])){
    $position = addslashes( $_POST['position'] );
    $sql = "SELECT * FROM candidates WHERE candidate_position='$position'";
    $result = mysqli_query($dbconn,$sql);
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

<script type="text/javascript">
function getVote(int){
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
  }else{// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  if(confirm("Your vote is for "+int)){
      xmlhttp.open("GET","save.php?vote="+int,true);
      xmlhttp.send();
  }else{
      alert("다른 후보를 선택하세요. ");
  }

}

function getPosition(String){
  if (window.XMLHttpRequest){
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
  }else {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.open("GET","vote.php?position="+String,true);
  xmlhttp.send();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function(){
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })

    });
   j('.refresh').css({color:"green"});
});
</script>


</head>
<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">

            <div >
            <table bgcolor="#00FF00" width="420" align="center">
            <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
            <tr>
                <td bgcolor="#5D7B9D" >Choose Position</td>
                <td bgcolor="#5D7B9D" style="color:#000000"; ><SELECT NAME="position" id="position" onclick="getPosition(this.value)">
                <OPTION  VALUE="select">select
                <?php
					$positions=mysqli_query($dbconn,"SELECT * FROM positions");
	                while ($row=mysqli_fetch_array($positions)){
		                echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
			        }
                ?>
                </SELECT></td>
                <td bgcolor="#5D7B9D" ><input style="color:#ff0000";  type="submit" name="Submit" value="See Candidates" /></td>
            </tr>
            <tr>

            </tr>
            </form>
            </table>
            <table width="270" align="center">
            <form>
            <tr>
                <th>Candidates:</th>
            </tr>
            <?php

                if (isset($_POST['Submit'])) {
                  while ($row=mysqli_fetch_array($result)){
                      echo "<tr>";
                      echo "<td style='background-color:#bf00ff'>" . $row['candidate_name']."</td>";
                      echo "<td style='background-color:#bf00ff'><input type='radio' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)' /></td>";
                      echo "</tr>";
                  }
                  mysqli_free_result($result);
                }
            ?>

            <tr>
                <h4>NB: Click a circle under a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</h4>
            </tr>
            </form>
            </table>
            </div>


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

