<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "include/functions.php";

                    //Load notif from database\
                    $adminid= $_SESSION['userid'];
                    $sql = "CALL sp_getNotif($adminid);";
                    $result = $conn->query($sql);

                    if ($result -> num_rows > 0) {
                        //output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $NID = $row['NID'];
                            $title = $row['title'];
                            $message = $row['message'];
                            $date = $row['createdDateTime'];
                            $status = $row['status'];
                            echo $message;
                        }
                    }
?>
</body>
</html>