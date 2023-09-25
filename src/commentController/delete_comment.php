<?php
    include '../config/define.php' ;
	include ROOT.'config/dbconn.php';
	include ROOT.'lib/log.php';
	$bno = $_POST['seqno'];
	$cno = $_POST['comment_seqno'];
	$sql = "delete FROM TABLE_COMMENT where seqno='$cno';";
	
	push_log($_COOKIE['user_ud']);
	
if (!mysqli_query($conn,$sql))
    {
        die('Error: ' . mysqli_error($conn));
    }
    echo "1 record deleted";
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
</body>
</html>
<script>
    var form = document.createElement("form");
        
        form.setAttribute('method', 'post');
	    form.setAttribute('action', "detail.php");
	    document.charset = "utf-8";
	

		var hiddenField = document.createElement('input');
        var bno = <?php echo $bno ?>;
		hiddenField.setAttribute('type', 'hidden');
        hiddenField.setAttribute('name', "input_idx");
		hiddenField.setAttribute('value', bno);

		form.appendChild(hiddenField);

	    document.body.appendChild(form);
        
	    form.submit();
</script>

