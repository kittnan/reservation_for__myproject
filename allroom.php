<!-- add allroom + add reservation เมื่อทำการเพิ่มห้อง พร้อมสถานะเปิดใช้งาน -->
    <?php  
       include_once("connect.php"); 
       $sqlallroom = "SELECT * FROM allroom" ;
       $result = $conn->query($sqlallroom);
       while($row = mysqli_fetch_assoc($result)){
           $roomid = $row['roomid'] ;
           if($row['status']==1){
               $sql2 = "INSERT INTO `reservation` (`rid`, `roomid`, `date`, `1`, `q1`, `2`, `q2`,
                `3`, `q3`, `4`, `q4`, `5`, `q5`, `6`, `q6`, `7`, `q7`, `8`, `q8`, `9`, `q9`) VALUES
                 (NULL, '$roomid' , '', '0', '', '0', '', '0', '', '0', '', '0', '', '0', '', '0', '', '0', '', '0', '') " ;

                    if ($conn->query($sql2) === TRUE){
                        $sql3 = "UPDATE `allroom` SET `status` = '2' WHERE `allroom`.`roomid` = $roomid";
                        $conn->query($sql3) ;
                    }
           }
       }
    ?>
