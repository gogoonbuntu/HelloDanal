<?php
	include 'dbconn.php';
	
	$bno = $_GET['idx'];
	$sql = mq("delete from board where idx=".$bno.";");
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0; url=/board.html" />
