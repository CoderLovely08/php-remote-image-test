<?php
include 'config.php';
$connectionString = "host=".$config['DB_HOST'] . " port =5432 dbname=".$config['DB_DATABASE']. " user=".$config['DB_USERNAME']." password=".$config['DB_PASSWORD'];
$conn =pg_connect($connectionString);

if (!$conn) {
    echo 'something went wrong!';
    exit();
}//else echo 'connected ' .$conn;
$sql="Select * from images";
$res=pg_query($conn,$sql);
$row = pg_fetch_all($res);
for ($i = 0; $i < count($row); $i++) {
    echo '<label for="">'.$row[$i]['image_ref'].'</label> 
    <br>
    <img id="'.$row[$i]['id'].'" src="uploads/'.$row[$i]['image_ref'].'" alt="'.$row[$i]['image_ref'].'">
    <br>';
}
?>


<a href="index.html">Go back</a>