<?php
    include 'dbconn.php' ;
    $sql = "select id, phone from TABLE_USER ;" ;
    $result = mq($sql) ;
    
    $uid = $_POST['uid'] ;
    $phonenum = $_POST['phonenumber'] ;
    
    while($row = mysqli_fetch_array($result)){
        if($row[0] == $uid && $row[1] == $phonenum) {
            echo 1 ;
            return ;
            break ;
        } 
    }
    echo 0 ;
?>