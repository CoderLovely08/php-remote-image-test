<?php
include 'config.php';
$connectionString = "host=".$config['DB_HOST'] . " port =5432 dbname=".$config['DB_DATABASE']. " user=".$config['DB_USERNAME']." password=".$config['DB_PASSWORD'];
$conn =pg_connect($connectionString);

if (!$conn) {
    echo 'something went wrong!';
    exit();
}
echo 'connected';
$query="insert into images(image_ref) values('Ragini')";
$result=pg_query($conn,$query);
// if($result) echo 'data inserted';
// else echo 'error';
?>