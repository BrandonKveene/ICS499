<?php
    $document_root = $_SERVER["DOCUMENT_ROOT"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ICS-499 Capstone</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="userFile">
        <div></div>
        <input type="submit" value="Upload File">
    </form>

    <?php
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
            print_r($lineItem);
            foreach($item in $lineItem){
                print_r($item);
            }
            echo "<br>";
        }

        flock($fp, LOCK_UN);
        fclose($fp);
    ?>
</body>
</html>