<?php
require'../includes/admin_config.php';
$userquery->admin_login_check();
$pages->page_redir();

$mode = $_GET['mode'];
$cid = $_GET['cid'];
$comment = array();
$comment['order'] = " comment_id DESC";

/* By default only video comments list but when you change this is used list video comments */
if(isset($_GET['filter'])) {
	$comment['type'] = $_GET['filter'];
	assign('filters',$_GET['filter']);
}

/* Used to list topic posts */
if(isset($_GET['filter'])) {
	$comment['type'] = $_GET['filter'];
	assign('filters',$_GET['filter']);
}

/* Used to list topic posts */
if(isset($_GET['filter'])) {
	$comment['type'] = $_GET['filter'];
	assign('filters',$_GET['filter']);
}

/* Used to update a comment */
if($cid) {
	if(isset($_POST['update_comment'])) {
		$updated_comment = $_POST['comment'];
		$cbvid->update_comment($cid,$updated_comment);
	}
}

/* Getting comments and assigning smarty variables */
$page = mysql_clean($_GET['page']);
$get_limit = create_query_limit($page,RESULTS);
$comment['limit'] = $get_limit;
$comments = $cbvideo->get_comments($comment);
assign("comments",$comments); 
if($mode) {
	assign('mode',$mode);
}
/* Pagination */
$ccount = $comment;
$ccount['count_only'] = true;
$total_rows  = $cbvideo->get_comments($ccount);
$total_pages = count_pages($total_rows,RESULTS);
$pages->paginate($total_pages,$page);
	
subtitle("Comments");
template_files('comments.html');
display_it();
?>