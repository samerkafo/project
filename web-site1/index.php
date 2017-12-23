
<!--// pararmeters.php -->



<?php
$host="172.18.0.3";
$user="root";
$password="netlab";
$database="bigdata";
?>




<!--connectDB.php -->

<?php 

$connect=  mysqli_connect($host, $user, $password, $database);
if(mysqli_connect_errno()){
    die("cannot connect to database field:". mysqli_connect_error());
    
}
 else {
    echo 'Database is connected';  
}
?>
 <?php
     $TimeStamp=date("h:i:s");
     $HostName = "Website_1";
     $ipAdd=$_SERVER['REMOTE_ADDR'];
        

?>


<!-- insertRecord.php -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>


<?php
$rest = substr(gethostname(), 6);
$colr= "#".$rest;
   $query="insert into activitylog (TimeStamp ,HostName ,Color ,RemoteIP)values( '$TimeStamp' , '$HostName','$colr','$ipAdd')";
        $result=  mysqli_query($connect, $query);

?>



<!-- printTavle.php-->


  <?php
        
        $query="select * from activitylog ORDER BY NumberAccess DESC limit 10";
        $result=  mysqli_query($connect, $query);
        if(! $result){
            die("Error in query");
        }
    ?>
        <ul>
    <?php

        echo "<table border='1'>
              <tr>
              <th>NumberAccess</th>
              <th>TimeStamp</th>
              <th>HostName </th>
              <th>Color </th>
              <th>RemoteIP</th>
              </tr>";


        while($row = mysqli_fetch_array($result))
        {
           $clr= $row['Color'];

        echo "<tr>";
        echo " <td bgcolor='$clr'>" . $row['NumberAccess'] . "</td>";
        echo " <td bgcolor='$clr'>" . $row['TimeStamp'] . "</td>";
        echo " <td bgcolor='$clr'>" . $row['HostName'] . "</td>";
        echo " <td bgcolor='$clr'>". $row['Color'] . "</td>";
        echo " <td bgcolor='$clr'>". $row['RemoteIP'] . "</td>";

        echo "</tr>";
        }
        echo "</table>";
   ?>
        </ul>

<!-- reduceTable -->



<?php
        $query="select * from activitylog ";
        $result=  mysqli_query($connect, $query);
        $numofrows= mysqli_num_rows($result);
        if ($numofrows > 200 )
        {
            $del_rows=$numofrows - 200;

        $query1="delete from activitylog order by NumberAccess limit '$del_rows'  ";
        $result1=  mysqli_query($connect, $query1);

    }
        if(! $result){
            die("Error in query");
        }
        $result++
    ?>



</body>
</html>
<?php
mysqli_close($connect);
?>

