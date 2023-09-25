<body>
    <?php
    include '../config/define.php' ;
    include ROOT.'config/dbconn.php' ;
    include ROOT.'lib/log.php';
    
    date_default_timezone_set("Asia/Seoul");
    $time_now = date("Y-m-d H:i:s") ;
    
    $title = $_POST['title'] ;
    $type = $_POST['btype'] ;
    $content = $_POST['content'] ;
    $author = $_POST['author'] ;
    $level = $_POST['level'] ;
    
    $sql = "insert into TABLE_BOARD(title, type, content, author, level, create_time) values ('$title', $type, '$content', '$author', $level, '$time_now')" ;
    
    $sql_get_board_seqno = "select seqno from TABLE_BOARD where title='$title' and content='$content' order by create_time desc limit 1";
    
    
    
    /* 참고용, 변수들 할당된 후 재정의 해줘야함 */
    
    $sql0 = "insert into TABLE_MARKET(board_seqno, price, num_ok) values ($board_seqno, $price, '$num_ok')";
    $sql1 = "insert into TABLE_FOOD(board_seqno, likes, distance, location, loc_name) values ($board_seqno, $likes, $distance, '$location', '$loc_name')" ;
    $sql2 = "insert into TABLE_THUNDER(board_seqno, invite, distance, location, menu, loc_name) values ($board_seqno, '$invite', $distance, '$location', '$menu', '$loc_name')" ;
    
    $sql_img = "insert into TABLE_IMAGE(board_seqno, imgsrc) values ($board_seqno, '$path_filename_ext')" ;
        
        if($_POST['btype'] == 0){ //중고장터
            $price = $_POST['price'];
            $num_ok = $_POST['check'];
            $num_ok=='' ? $num_ok=0 : $num_ok=1 ;
            
         
            if (($_FILES['uploadfile']['name']!="")){
                // Where the file is going to be stored
                $target_dir = "/uploadimg/";
                $file = $_FILES['uploadfile']['name'][0];
                $pathinfo = pathinfo($file);
                $filename = $pathinfo['filename'];
                $ext = $pathinfo['extension'];
                $temp_name = $_FILES['uploadfile']['tmp_name'][0] ;
                
                $path_filename_ext = $target_dir.$filename.date('Y-m-d_H:i:s').".".$ext;
                 
                // echo "<script> alert('".$temp_name."');</script>" ;
                 
                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                     echo 'file already exists.';
                     echo '<script>alert("Sorry, file already exists.");</script>';
                 } else {
                     move_uploaded_file($temp_name,$_SERVER['DOCUMENT_ROOT'].$path_filename_ext);
                     echo 'success';
                 }
                 
                if (!mysqli_query($conn,$sql))
                {
                    die('Error: ' . mysqli_error($conn));
                }
                $board_seqno = mysqli_fetch_array(mq($sql_get_board_seqno))[0] ;
              
                
                $sql_img = "insert into TABLE_IMAGE(board_seqno, imgsrc) values ($board_seqno, '$path_filename_ext')" ;
                if (!mysqli_query($conn, $sql_img))
                {
                    die('<br>Error: ' . mysqli_error($conn).' from sql('.$sql_img.')');
                }
                
                $sql0 = "insert into TABLE_MARKET(board_seqno, price, num_ok) values ($board_seqno, $price, '$num_ok')";
                if (!mysqli_query($conn,$sql0))
                {
                    die('Error: ' . mysqli_error($conn));
                }
                
                 
            } else {
                echo '<script>alert("File Upload Error."); history.back(); </script>';
            }
        }
        
        else if ($_POST['btype'] == 1){ //맛집
            $likes = $_POST['likes'] ;
            $loc_name = $_POST['loc_name'];
            $location = $_POST['location'] ;
            $distance = $_POST['distance'] ;
        
            if (($_FILES['uploadfile']['name']!="")){
                // Where the file is going to be stored
                $target_dir = "/uploadimg/";
                $file = $_FILES['uploadfile']['name'][0];
                $pathinfo = pathinfo($file);
                $filename = $pathinfo['filename'];
                $ext = $pathinfo['extension'];
                $temp_name = $_FILES['uploadfile']['tmp_name'][0] ;
                
                $path_filename_ext = $target_dir.$filename.date('Y-m-d_H:i:s').".".$ext;
                 
                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    echo 'file already exists.';
                    echo '<script>alert("Sorry, file already exists.");</script>';
                } else {
                    move_uploaded_file($temp_name,$_SERVER['DOCUMENT_ROOT'].$path_filename_ext);
                    echo 'success';
                }
                
                if (!mysqli_query($conn,$sql))
                {
                    die('Error: ' . mysqli_error($conn));
                }
                $board_seqno = mysqli_fetch_array(mq($sql_get_board_seqno))[0] ;
                
                $sql_img = "insert into TABLE_IMAGE(board_seqno, imgsrc) values ($board_seqno, '$path_filename_ext')" ;
                if (!mysqli_query($conn,$sql_img))
                {
                    die('Error: ' . mysqli_error($conn));
                }
                
                $sql1 = "insert into TABLE_FOOD(board_seqno, likes, distance, location, loc_name) values ($board_seqno, $likes, $distance, '$location', '$loc_name')" ;
                // echo '<script> alert("'.$sql1.'");</script>' ;
                if (!mysqli_query($conn,$sql1))
                {
                    die('Error: ' . mysqli_error($conn));
                }
                
                 
            } else {
                echo '<script>alert("File Upload Error."); history.back(); </script>';
            }
            
        }
        
        else if($_POST['btype'] == 2){ //번개 모임
            $invite = $_POST['invite'];
            $loc_name = $_POST['loc_name'];
            $location = $_POST['location'] ;
            $distance = $_POST['distance'] ;
            $menu = $_POST['menu'] ;
            $start_time = $_POST['start_time'];
            // $start_time[4] = "년";
            // $start_time[7] = "월";
            $start_time[10] = " ";
            
            
            $time_with_content = "[".substr($start_time, 8, 2)."일 " ;
            $time_with_content .= substr($start_time, 11, 2)."시 " ;
            $time_with_content .= substr($start_time, 14, 2)."분]" ;
            $time_with_content .= "\r\n".$content;
            
            $sql = "insert into TABLE_BOARD(title, type, content, author, level, create_time) values ('$title', $type, '$time_with_content', '$author', $level, '$time_now')" ;
            
            if (!mysqli_query($conn,$sql))
            {
                die('Error: ' . mysqli_error($conn));
            }
            
            $sql_get_board_seqno = "select seqno from TABLE_BOARD where title='$title' and content='$time_with_content' order by create_time desc limit 1";
            $board_seqno = mysqli_fetch_array(mq($sql_get_board_seqno))[0] ;
            echo $board_seqno;
            
            $sql2 = "insert into TABLE_THUNDER(board_seqno, invite, distance, location, menu, start_time, loc_name) values ($board_seqno, '$invite', $distance, '$location', '$menu', '$start_time', '$loc_name')" ;
            if (!mysqli_query($conn,$sql2))
            {
                die('Error: ' . mysqli_error($conn));
            }
            

        }
        push_log($_SERVER, $author.' WRITE POST '.$title, __LINE__);
    ?>
    <form action="detail.php" name="myform" method="post">
        <input type="hidden" name="input_idx">
    </form>
    <script>
        var myform = document.forms['myform'] ;
        myform['input_idx'].value=<?php echo $board_seqno ;?> ;
        myform.submit();
    </script>
</body>
