<?php
$now = getdate();
$today = $now['year']."_".$now['mon']."_".$now['mday'];
$log_filename = 'logs/'.$today.'.log';

//push_log($_SERVER, $_COOKIE['user_id']." ENTER ".$board['title']."(".$bno.")", __LINE__);

function push_log($_SV, $log_str , $line)
{
	global $log_filename;
	global $now;
	global $today;

	$now_time   = $now['hours'].":".$now['minutes'].":".$now['seconds'];
	$now        = $today." ".$now_time;
	
	$log_str = $_SV['PHP_SELF']." - ".$_SV['REMOTE_ADDR']." - ".$log_str." - ".$_SV['HTTP_USER_AGENT'];
	// PHP File Name - Client IP - msg - Client Program
	
	
	$filep = fopen($log_filename, "a");
	if(!$filep) {
		die("can't open log file : ". $log_filename);
	}
	fputs($filep, "{$now} : ({$line}) : {$log_str}\n\r");
	fclose($filep);
}
?>