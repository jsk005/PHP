<header id="header" class="hoc clear">
<div id="logo" class="fl_left">
  <h1><a href="index.html">온라인 투표</a></h1>
</div>
<nav id="mainav" class="fl_right">
  <ul class="clear">
	<li class="active"><a href="index.php">Home</a></li>
	<?php if(isset($_SESSION['member_id']) && !empty($_SESSION['member_id'])):?>
	<li><a class="drop" href="#"><? echo $_SESSION['member_name'] ?></a>
	  <ul>
		<li><a href="logout.php">로그아웃</a></li>
		<li><a href="manage-profile.php">정보수정</a></li>
		<li><a href="vote.php">Vote</a></li>
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']==1):?>
		<li class="divider"></li>
		<li><a href="admin/index.php">관리자</a></li>
		<?php endif;?>
	  </ul>
	</li>
	<?php else:?>
	<li><a class="drop" href="#">로그인</a>
	  <ul>
		<li><a href="login.php">로그인</a></li>
		<li><a href="registeracc.php">회원가입</a></li>
	  </ul>
	</li>
	<?php endif;?>

  </ul>
</nav>
</header>
</div>