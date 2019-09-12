<?php
    define('DB_SERVER', 'localhost');
    define('DB_NAME', 'bom');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    function dbConnect(){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        dbConfirmConnection();
        return $connection;
    }

    function dbConfirmConnection(){
        if(mysqli_connect_errno()){
            $msg = "Database connection failed: " . mysqli_connect_error();
            exit($msg);
        }
    }

    function dbDisconnect($connection){
        if(isset($connection)){
            mysqli_close($connection);
        }
    }

?>