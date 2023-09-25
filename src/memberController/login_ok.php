<body>
    <img src="../../img/opening.png">
</body>
<style>
    img {
        height: 100%;
        animation: load 2s;
    }
    
    @keyframes load{
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
        }
    }
    body{
        overflow: hidden;
        text-align:center;
        background:linear-gradient(180deg, #FFF 0%, #F6EFEF 100%);
    }
</style>
<?php
    include '../config/define.php' ;
	include ROOT.'config/dbconn.php';
	include ROOT."../lib/password.php";
	include ROOT."../lib/log.php";
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	    echo "<script>"
	        ."alert('잘못된 접근입니다');"
	        ."history.back();"
	        ."</script>" ;
        die('잘못된 접근입니다');
	    exit;
	}
	$user_id = $_POST['userid'];
    $password = $_POST['userpw'];

    if(!isset($user_id) || !isset($password) || $user_id=='') {
	    echo "<script>alert('".$user_id.' '.$password." 아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
        exit;
    }
    
    
	//password변수에 POST로 받아온 값을 저장하고 sql문으로 POST로 받아온 아이디값을 찾습니다.
	
	$sql = mq('select * from TABLE_USER where id="'.$user_id.'"');
    
	$member = $sql->fetch_array(); // 입력된 id와 db에 있는 id가 같은 경우
    
    if($password == $member['pswd'])
    {
        push_log($_SERVER, $user_id." LOGIN.",__LINE__);
        ?>
        <script>
            var user_id = '<?php echo $user_id ;?>' ;
            var level = '<?php echo $member["level"] ;?>' ;
            var myidx = '<?php echo $member["seqno"] ;?>' ;
            
            function setCookie(name, value, expiredays) {
                var date = new Date();
                date.setDate(date.getDate() + expiredays);
                document.cookie = escape(name) + "=" + escape(value) + "; path=/; expires=" + date.toUTCString();
            }
            
            setCookie('user_id', user_id, 30);
            setCookie('level', level, 30);
            setCookie('myidx', myidx, 30);
            setTimeout(function(){
                alert(user_id + '님 로그인되었습니다.');
                location.href='../../index.php';}, 1000);
        </script>
        <?php
    }

    else{ // 비밀번호가 같지 않다면 알림창을 띄우고 전 페이지로 돌아갑니다
    	echo "<script>alert('아이디 혹은 비밀번호가 잘못된 값입니다.'); history.back();</script>";
    }
?>
