<?php
if (!isset($_SESSION)) {
    session_start();
}
require ('../connection.php');
if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
    header("location:access-denied.php");
}

// 수정 정보 저장
if (isset($_GET['id']) && isset($_POST['update'])) {
    $Id = addslashes($_GET['id']);
    $Name = addslashes($_POST['name']);
    $Email = $_POST['email'];
    $mobileNO = $_POST['mobileNO'];
    if(strlen($_POST['password'])>0 && $_POST['password'] == $_POST['repassword']){
        $Password = $_POST['password'];
        $newpass = md5($Password);
        $sql = "UPDATE members SET name='$Name', email='$Email', mobileNO='$mobileNO', password='$newpass' WHERE member_id = '$Id'";
    } else {
        $sql = "UPDATE members SET name='$Name', email='$Email', mobileNO='$mobileNO' WHERE member_id = '$Id'";
    }
    $result = mysqli_query($dbconn,$sql);
    header("location:memberList.php");
}

require_once ('../connection.php');
require_once '../phpclass/dbClass.php';
$c = new MySQLiDbClass;

?>

<!DOCTYPE html>
<html>
<head>
    <title>online voting</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <script language="JavaScript" src="js/admin.js"></script>

</head>
<body id="top">
    <?php require_once ('header.php');?>
    <?php
        if (isset($_GET['id'])&& isset($_GET['mode']) && $_GET['mode']=='update') :
            $myId = addslashes($_GET['id']);
            $sql = 'member_id=' . $myId;
            $R = $c -> getDbData('members', $sql, '*');
    ?>

    <div id="container">
        <form action="memberUpdate.php?id=<?php echo $R['member_id'];?>" method="post">
            <table align="center">
                <CAPTION>
                    <h4>회원정보 수정</h4>
                </CAPTION>
                <tr>
                    <td>Name:</td>
                    <td>
                    <input type="text"  font-weight:bold;" name="name" maxlength="15" value="<?php echo $R['name']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email Address:</td><td>
                    <input type="text"  font-weight:bold;" name="email" maxlength="100" value="<?php echo $R['email']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>휴대폰번호:</td><td>
                    <input type="text"  font-weight:bold;" name="mobileNO" maxlength="100" value="<?php echo $R['mobileNO']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                    <input type="password"  font-weight:bold;" name="password" maxlength="15" value="">
                    </td>
                </tr>

                <tr>
                    <td>Confirm New Password:</td>
                    <td>
                    <input type="password"  font-weight:bold;" name="repassword" maxlength="15" value="">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td><td>
                    <input type="submit" name="update" value="수정">
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <?php endif;?>
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
