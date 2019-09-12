<?php
    require_once('utility.php');
    require_once('database.php');

    $db = dbConnect();


    $document_root = $_SERVER["DOCUMENT_ROOT"];

    echo $_FILES;

    if(isset($_FILES["userFile"])){
        move_uploaded_file($_FILES["userFile"]["tmp_name"], "uploadedFiles/".$_FILES["userFile"]["name"]);
        echo "<h3>File Uploaded Successfully</h3>";
    }

    @$fp = fopen("$document_root/Capstone/uploadedFiles/test.txt", "rb");
    flock($fp, LOCK_SH);
    if(@!fp){
        echo "<h3>An Error Has Occurred</h3>";
    }

    while(!feof($fp)){
        $lineItem = fgetcsv($fp, 0, ",");

        foreach($lineItem as $item){
            print_r($item);
        }
        echo "<br>";
    }

    flock($fp, LOCK_UN);
    fclose($fp);
?>