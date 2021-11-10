<?php
	include 'dbconn.php';
	include 'log.php';
	$bno = $_POST['board_seqno'];
	$author = $_POST['author'];
	$content = $_POST['content'];
    
    push_log($_SERVER, $author.' COMMENT ON '.$bno, __LINE__);
	$sql = "insert into TABLE_COMMENT(board_seqno, content, author, create_time) values ('$bno', '$content', '$author', now());";
	    
	if (!mysqli_query($conn,$sql))
    {
        die('Error: ' . mysqli_error($conn));
    }
    echo "1 record added";
	
?>
<!DOCTYPE html>
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