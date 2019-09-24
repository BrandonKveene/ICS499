<?php
    require_once('database.php');

    $db = dbConnect();

    $document_root = $_SERVER["DOCUMENT_ROOT"];
    
    if(isset($_FILES["userFile"])){
        move_uploaded_file($_FILES["userFile"]["tmp_name"], "uploadedFiles/".$_FILES["userFile"]["name"]);
        echo "<h3>File Uploaded Successfully</h3>";
    }

    @$fp = fopen("uploadedFiles/".$_FILES["userFile"]["name"], "rb");

    flock($fp, LOCK_SH);
    if(@!fp){
        echo "<h3>An Error Has Occurred</h3>";
    }
    
    while(!feof($fp)){
        $lineItem = fgetcsv($fp, 0, "\t");
        foreach($lineItem as $item){
            $cellContents = explode(",", $item);

            $sql = "INSERT INTO releases (id, name, type, status, dependency_date, open_date,
            freeze_date, rtm_date, manager, author, app_id)
            VALUES ('".$cellContents[0]."','".$cellContents[1]."','".$cellContents[2]."','".$cellContents[3]."','".
            $cellContents[4]."','".$cellContents[5]."','".$cellContents[6]."','".$cellContents[7]."','".$cellContents[8]."','".
            $cellContents[9]."','".$cellContents[10]."')";
            

            if (mysqli_query($db, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }

            }
        }

    flock($fp, LOCK_UN);
    

    fclose($fp);
    

    header("Location:displayResults.php");
?>