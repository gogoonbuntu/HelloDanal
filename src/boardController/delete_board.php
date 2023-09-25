<?php

    require_once('../config/dbconn.php') ;
    
    $bno = $_POST['seqno'] ;
    $btype = $_POST['btype'] ;
    $sql = "delete from TABLE_BOARD where seqno=$bno" ;
    $board_name = array('MARKET', 'FOOD', 'THUNDER') ;
    $sql1 = "delete from TABLE_".$board_name[$btype]." where board_seqno=$bno" ;
    echo $sql ;
    echo $sql1 ;
    if(!mysqli_query($conn, $sql)) {
        die(mysqli_error($conn)) ;
    }
    
    if(!mysqli_query($conn, $sql1)) {
        die(mysqli_error($conn)) ;
    } 
?>
<script>
    location.replace('../index.php') ;
</script>