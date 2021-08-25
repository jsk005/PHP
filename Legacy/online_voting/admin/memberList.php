<?php
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['admin']) && $_SESSION['admin']!=1){
    header("location:access-denied.php");
}

require_once ('../connection.php');
require_once '../phpclass/dbClass.php';
require_once '../phpclass/boardClass.php';

// 삭제
if (isset($_GET['id']) && $_GET['mode']=='delete' && $_SESSION['admin']==1) {
    $myId = addslashes($_GET['id']);
    $sql = "DELETE FROM members WHERE member_id = '$myId'";
    $result = mysqli_query($dbconn,$sql);
}


$c = new MySQLiDbClass;
$b = new boardClass;

$link_url = $_SERVER['PHP_SELF']; // 현재 실행중인 파일명 가져오기
$rowsPage = 2; // 한 화면에 표시되는 게시글 수
$curPage = isset($_GET['p']) ? $_GET['p'] : 1;//페이지 변수 설정
$table ="members";
$where = isset($_GET['where']) ? $_GET['where']: '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword']: '';
$xorderby= isset($xorderby) ? $xorderby : 'member_id DESC';
if($where && $keyword) {
    if($where == 'name') $sql = "name LIKE '%".$keyword."%' ";
    if($where == 'email') $sql = "email LIKE '%".$keyword."%' ";
    if($where == 'mobileNO') $sql = "mobileNO LIKE '%".$keyword."%' ";
    if($where == 'unify') {
        $sql = "(name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR mobileNO LIKE '%".$keyword."%') ";
    }
} else {
    $sql ='';
}
$g['url_link']=($where?'where='.$where.'&amp;':'').($keyword?'keyword='.urlencode(stripslashes($keyword)).'&amp;':'');
$g['bbs_reset'] = $link_url;


$rows = $c->getDbArray($table,$sql,'*',$xorderby,$rowsPage,$curPage);
$NUM = $c->getDbRows($table,$sql); // 전체 게시글수
$TPG = $b->getTotalPage($NUM,$rowsPage);

?>

<!DOCTYPE html>
<html>
<head>
<title>온라인 투표</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<script language="JavaScript" src="js/admin.js"></script>

</head>
<body id="top">
<?php require_once ('header.php');?>

<div id="container">
	<div class="wrapper bgded overlay" style="background-image:url('');">
	</div>

<div class="pull-left info">
    <?php if( $keyword ):?><strong>"<?php echo $keyword?>"</strong> 검색결과 : <?php endif?>
    <?php echo number_format($NUM)?>개 (<?php echo $curPage;?>/<?php echo $TPG;?>페이지)
</div>
<table id="memberListTable" class="table table-bordred table-striped table-hover">
   <thead>
        <th align="center" width="50"><strong>idx</strong></th>
        <th align="center"><strong>아이디</strong></th>
        <th align="center"><strong>성명</strong></th>
        <th align="center"><strong>휴대폰번호</strong></th>
        <th align="center"><strong>권한</strong></th>
        <th align="center"><strong>수정</strong></th>
        <th align="center"><strong>삭제</strong></th>
   </thead>
   <tbody>

<?php while($R = mysqli_fetch_array($rows)):?>
<tr id="<?php echo $R['member_id']; ?>">
    <td><?php echo $R['member_id']; ?></td>
    <td><?php echo $R['email']; ?></td>
    <td><?php echo $R['name']; ?></td>
    <td><?php echo $R['mobileNO']; ?></td>
    <td><?php echo $R['admin'] == 1 ? '관리자' : ''; ?></td>
    <td><a href="<?php echo 'memberUpdate.php?id='.$R['member_id'].'&mode=update';?>">수정</a></td>
    <td><a href="<?php echo $link_url.'?id='.$R['member_id'].'&mode=delete';?>">삭제</a></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<div class='searchbox'>
    <form id="memberListSearchf" class="form-inline" action="<?php echo $link_url;?>">
        <input type="hidden" name="orderby" value="<?php echo $xorderby;?>" />
        <input type="hidden" name="p" value="<?php echo $curPage;?>" />
        <select name="where" class="form-control input-sm">
            <option value="unify">통합</option>
            <option value="name">이름</option>
            <option value="email">아이디</option>
            <option value="mobileNO">휴대폰</option>
        </select>
        <div class="input-group input-group-sm">
            <input type="text" name="keyword" value="" class="form-control input-search" placeholder="검색어">
            <span class="input-group-btn">
                <button type="button" id='memberListKReset' class="btn btn-default" title="리셋"><i class="glyphicon glyphicon-repeat"></i></button>
                <button type="submit" class="btn btn-info" title="검색"><i class="glyphicon glyphicon-search"></i></button>
            </span>
        </div>
    </form>
</div>
<div class="pull-right info">
    <a href="<?php echo $g['bbs_reset']?>" id='memberListBtnReset' class="btn btn-default btn-sm pull-right">처음목록</a>
</div>
<?php $b->PageLinkView($link_url, $NUM, $rowsPage, $curPage, $g['url_link']); ?>


</div>

<?php
require_once ('../layout/tail.php');
?>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
<script src="../login.js"></script>
</body>
</html>
