<?php
if (!isset($_SESSION)) {
    session_start();
}

require ('connection.php');

if (empty($_SESSION['member_id'])) {
    header("location:access-denied.php");
}

$sql = "SELECT * FROM members WHERE member_id = '$_SESSION[member_id]'";
$result = mysqli_query($dbconn,$sql);
if(mysqli_num_rows($result) < 1) {
    $result = null;
}
$row = mysqli_fetch_array($result);
if ($row) {
    // get data from db
    $stdId = $row['member_id'];
    $Name = $row['name'];
    $email = $row['email'];
    $voter_id = $row['voter_id'];
}

// updating sql query
if (isset($_POST['update'])) {
    $myId = addslashes($_GET[id]);
    $myName = addslashes($_POST['name']);
    //prevents types of SQL injection
    $myEmail = $_POST['email'];
    $myPassword = $_POST['password'];
    $myVoterid = $_POST['voter_id'];

    $newpass = md5($myPassword);
    $sql = "UPDATE members SET name='$myName', email='$myEmail', voter_id = '$myVoterid', password='$newpass' WHERE member_id = '$myId'";
    $result = mysqli_query($dbconn,$sql);

    // redirect back to profile
    header("Location: manage-profile.php");
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
<script language="JavaScript" src="js/user.js"></script>

</head>
<body id="top">
<?php include_once ('header.php');?>

<div class="wrapper bgded overlay" style="background-image:url('');">
  <section id="testimonials" class="hoc container clear">
    <ul class="nospace group">
      <li class="one_half first">
        <blockquote>
            <table border="0" width="620" align="center">
            <CAPTION><h4>내 프로필</h4></CAPTION>
            <form>
            <br>
            <tr><td></td><td></td></tr>
            <tr>
                <td style="color:#000000"; >Id:</td>
                <td style="color:#000000"; ><?php echo $stdId; ?></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Name:</td>
                <td style="color:#000000"; ><?php echo $Name; ?></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Email:</td>
                <td style="color:#000000"; ><?php echo $email; ?></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Voter Id:</td>
                <td style="color:#000000"; ><?php echo $voter_id; ?></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Password:</td>
                <td style="color:#000000"; >Encrypted</td>
            </tr>
            </table>
            </form>

        </blockquote>

      </li>
      <li class="one_half">
        <blockquote>
            <table  border="0" width="620" align="center">
            <CAPTION><h4>프로필 수정</h4></CAPTION>
            <form id="updateProfile" action="manage-profile.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
            <table align="center">
            <tr>
                <td style="background-color:#0000ff">Name:</td>
                <td style="background-color:#0000ff"  >
                    <input  style="color:#000000"; type="text" font-weight:bold;" name="name" maxlength="15" value="<?php echo $Name; ?>">
                </td>
            </tr>

            <tr>
                <td style="background-color:#0000ff" >Email Address:</td>
                <td style="background-color:#0000ff">
                    <input style="color:#000000";  type="text" font-weight:bold;" name="email" maxlength="100" value="<?php echo $email;?>">
                </td>
            </tr>

            <tr>
                <td style="background-color:#bf00ff" >Voter Id:</td>
                <td style="background-color:#bf00ff">
                    <input  style="color:#000000";  type="text"  font-weight:bold;" name="voter_id" maxlength="100" value="<?php echo $voter_id;?>">
                </td>
            </tr>

            <tr>
                <td style="background-color:#0000ff" >새 비밀번호:</td>
                <td style="background-color:#0000ff" >
                    <input  style="color:#000000";  type="password" font-weight:bold;" name="password" maxlength="15" value="<?php echo '';?>">
                </td>
            </tr>

            <tr>
                <td style="background-color:#bf00ff" >비밀번호 확인:</td>
                <td style="background-color:#bf00ff" >
                    <input style="color:#000000";  type="password"  font-weight:bold;" name="repassword" maxlength="15" value="<?php echo '';?>">
                </td>
            </tr>

            <tr>
                <td style="background-color:#0000ff" >&nbsp;</td>
                </td><td style="background-color:#0000ff" >
                    <input style="color:#ff0000";  type="submit" name="update" value="Update Profile">
                </td>
            </tr>

            </table>
            </form>
            </table>

        </blockquote>

      </li>

    </ul>
  </section>
</div>
<?php
require_once ('./layout/tail.php');
?>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
<script src="login.js"></script>
</body>
</html>


