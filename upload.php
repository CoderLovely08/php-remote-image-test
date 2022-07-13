<?php

include 'config.php';
$connectionString = "host=".$config['DB_HOST'] . " port =5432 dbname=".$config['DB_DATABASE']. " user=".$config['DB_USERNAME']." password=".$config['DB_PASSWORD'];
$conn =pg_connect($connectionString);

if (!$conn) {
    echo 'something went wrong!';
    exit();
}
echo 'connected';
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    print_r($file);
    $fileName=$_FILES['file']['name'];
    $fileType=$_FILES['file']['type'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileTempLocation=$_FILES['file']['tmp_name'];
//     echo "File name is: ".$fileName."<br>\nFile type is: ".$fileType."<br>\nFile Size is: ". ($fileSize/1000)." kb";

    // get the file extension
    $fileExt=explode('.',$fileName);
    // print_r($fileExt);
    $fileExtension=strtolower(end($fileExt));

    // list of file types which can be uploaded
    $allowedExtension=array('jpg','jpeg','png');

    // check if the correct file type is selected
    if (in_array($fileExtension,$allowedExtension)) {
        if ($fileError===0) {
            if($fileSize<500000){
                // $fileUniqueName=uniqid('',true).".".$fileExtension;
                $fileUniqueName="$fileExt[0].".$fileExtension;
                echo $fileUniqueName;
                $fileDestinantion='uploads/'.$fileUniqueName;
                move_uploaded_file($fileTempLocation,$fileDestinantion);
                $query="insert into images(image_ref) values('$fileUniqueName')";
                echo $query;
                $run = pg_query($conn,$query);
                if($run) echo 'upload successfull';
                else echo 'error';
                // header("Location: index.html?uploaded");
            }else echo 'File size is larger than 500kb';
        }
    }else echo 'Selected file type not allowed!';
    
}else{
    echo 'soemthig';
}
?>
