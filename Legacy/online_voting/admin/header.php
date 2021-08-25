<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left">
      <h1><a href="#">온라인 투표</a></h1>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="../index.php">Home</a></li>
		<?php if(isset($_SESSION['admin']) && $_SESSION['admin']==1):?>
        <li><a class="drop" href="#">관리 Panel</a>
          <ul>
            <li><a href="memberList.php">회원관리</a></li>
            <li><a href="positions.php">분류관리</a></li>
            <li><a href="candidates.php">후보자관리</a></li>
            <li><a href="refresh.php">투표결과</a></li>
          </ul>
        </li>
		<?php endif;?>
        <li><a href="../logout.php">Logout</a></li>

      </ul>
    </nav>
  </header>
</div>