<?php
    include '../config/define.php' ;
    include ROOT."config/dbconn.php";
    include ROOT."memberController/password.php";

    //$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $userid = $_POST['id'];
    $userpw = $_POST['pw'];


    $sql = mq("update TABLE_USER set pw='".$userpw."' where id = '".$userid."'");

    echo "<script>alert('비밀번호를 변경했습니다.'); location.href='login.php';</script>";
?>