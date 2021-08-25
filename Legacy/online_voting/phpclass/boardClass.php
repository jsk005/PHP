<?php
class boardClass {

	function PageLinkView($link_url,$totalcnt,$rowsPage,$curPage){
		echo '<div style="position:relative;vertical-align:top;padding-top:0;margin-top:0">';
			echo '<div class="pagelink">';
				$Info = $this->PageList($totalcnt,$rowsPage,$curPage,'');
				if($Info['current_block'] > 2){
					echo "<a href='".$link_url."?p=1'>◀</a> ";
				}
				if($Info['current_block'] > 1){
					echo "<a href='".$link_url."?p=".$Info['prev']."'>◁</a> ";
				}
				foreach($Info['current'] as $w) {
					if($curPage == $w){
						echo "<a href='".$link_url."?p=".$w."'><span style='color:red;font-size:22pt'>".$w."</span></a> ";
					} else {
						echo "<a href='".$link_url."?p=".$w."'>".$w."</a> ";
					}
				}
				if($Info['current_block'] < ($Info['total_block'])){
					echo "<a href='".$link_url."?p=".$Info['next']."'>▷</a> ";
				}
				if($Info['current_block'] < ($Info['total_block']-1)){
					echo "<a href='".$link_url."?p=".$Info['totalPage']."'>▶</a> ";
				}
			echo '</div>';
		echo '</div>';
	}


	// $curPage : 현재 페이지, $totalcnt : 총 게시물수
	// $block_limit : 한 화면에 뿌려질 게시글 개수
	function PageList($totalcnt,$rowsPage,$curPage,$block_limit) {
		$block_limit = $block_limit ? $block_limit : 10;  // 한 화면에 보여줄 개수 기본 10으로 설정

		// 총 페이지수 구하기
		$totalPage = ceil($totalcnt/$rowsPage);
		if($totalPage == 0) {
			++$totalPage;
		}
		$total_block = ceil($totalPage / $block_limit); //전체 블록 갯수

		$curPage = $curPage ? $curPage : 1; // 현재 페이지

		// 현재 블럭 : 화면에 표시될 페이지 리스트
		$current_block=ceil($curPage/$block_limit);
		// 현재 블럭에서 시작페이지
		$fstPage = (((ceil($curPage/$block_limit)-1)*$block_limit)+1);
		// 현재 블럭에서 마지막 페이지
		$endPage = $fstPage + $block_limit -1;
		if($totalPage < $endPage) {
			$endPage = $totalPage;
		}

		// 시작 바로 전 페이지
		$prev_page = $fstPage - 1;
		// 마지막 다음 페이지
		$next_page = $endPage + 1;

		foreach(range($fstPage, $endPage) as $val) {
			$row[] = $val;
		}
		// 배열로 결과를 돌려준다.
		return array(
			'total_block' => $total_block,
			'current_block' => $current_block,
			'totalPage' => $totalPage,
			'fstPage' => $fstPage,
			'endPage' => $endPage,
			'prev' => $prev_page,
			'next' => $next_page,
			'current' => $row
		);
	}

    //총페이지수
    function getTotalPage($num,$rec){
        return @intval(($num-1)/$rec)+1;
    }


}//end class boardClass

