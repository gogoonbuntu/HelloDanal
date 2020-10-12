<?php
include "dbconn.php";
$sql = "select * from board";
$result = mq($sql);

$type = $_POST["type"];
while($row = mysqli_fetch_array($result)){
?>
<tr>
	<td>
		<div class="thumbnail">
			<img src="<?php echo $row['imgsrc'];?>">
		</div>
		<div class="title">
			<?php echo $row['title'];?>
		</div>
		<div class="content">
			<?php echo $row['content'];?>
		</div>
		<div class="important">
			<?php
				switch($type){
					case 0: echo "중고장터"; break;
					case 1: echo "맛집정보"; break;
					case 2: echo "번개모임"; break;
					case 3: echo "내프로필"; break;
				}
			?>
		</div>
	</td>
</tr>
		<?php
}
?>