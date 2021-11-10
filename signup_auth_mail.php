<?php
@extract($_POST);

include 'dbconn.php' ;
include 'log.php' ;


$user_id = $_GET['uid'] ;
$authkey = generateRandomString() ;

$contents = "<center>Hello Danal!<br>" ;
$contents .= "the Auth Key is shown below :<br>" ;
$contents .= $authkey ;
$contents .= "<br><img src='cid:danaly'>" ;
$contents .= "</center>" ;




$sql = "insert into TABLE_AUTH(id, authkey, indate) values('" ;
$sql .= $user_id ;
$sql .= "', '" ;
$sql .= $authkey ;
$sql .= "', '" ;
date_default_timezone_set("Asia/Seoul");
$sql .= date("Y-m-d H:i:s") ;
$sql .= "') ;" ;

//////////// MAIL STARTSS

$to_id=$user_id.'@danal.co.kr';
$from_id='vkdldk333@naver.com';
$pass="!Q2w3edaidai";
$title='Hello Danal authentication';
$article=$contents;

require_once("class.phpmailer.php");

$smtp="smtp.naver.com";
$mail=new PHPMailer(true);
$mail->IsSMTP();

try{
	$mail->Host=$smtp;
	$mail->SMTPAuth=true;
	$mail->Port=465;
	$mail->SMTPSecure="ssl";
	$mail->Username=$from_id;
	$mail->Password=$pass;
	$mail->CharSet = "UTF-8";
	$mail->SetFrom($from_id, 'Hello Danal');
	$mail->AddAddress($to_id);
	$mail->Subject=$title;
	$mail->MsgHTML($article);
	$mail->Send();
	mq($sql);
} catch (phpmailerException $e){
	echo $e->errorMessage();
} catch (Exception $e){
	echo $e->getMessage();
}
echo $sql."<br>";
echo "메일이 발송되었습니다";

push_log($_SERVER, $user_id." AUTH Mail Sent "."(".$authkey.")", __LINE__);

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>