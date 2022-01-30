<!--Form-->
<?php
//check if there is query string and check if the id exists
$contentExists = false;
if (isset($_GET['loc'])) {
    if (verifyLocation($_GET['loc'])) {
        //load in form
        $contentExists = true;
        $sql = "CALL sp_getAllLocation();";
        $result = $conn->query($sql);
        if ($result -> num_rows > 0) {
            //output data for each row
            while ($row = $result->fetch_assoc()) {
                if ($row['locationID'] == $_GET['loc']) {
                    $lid = $row['locationID'];
                    $name = $row['name'];
                }
            }
        }
        $result->close();
        $conn->next_result();
    }
}
?>
<form action="#" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="input__label">Name</label>
        <input type="text" class="form-control input-style" id="petname" name="lname"
            value='<?php (($contentExists)?$x=$name:$x=" "); echo $x;?>' placeholder="Enter Brand Name">
    </div>
    <button type="submit" class="btn btn-primary btn-style mt-4"
        name="<?php echo $btnAddOrUpdate;?>"><?php echo $btnAddOrUpdate;?></button>
    <?php
    if ($contentExists) {
        echo'
        <a href="adminviewContent.php?content=loc"  class="btn btn-warning btn-style mt-4">Cancel</a>
        <button type="button"  class="btn btn-danger btn-style mt-4" onclick="DeleteContent('.$lid.', '.$_GET['loc'].')">Delete</button>
        ';
    }
    ?>
</form>
<!--Form-->

<?php
    //insert pet category
    if (isset($_POST['Insert'])) {
        //Fetch data from the fields
        $name = $_POST['lname'];
        $status = 1;

        $result = addLocation($name, $status);
        if ($result) {
            //**********
            header('Location: adminviewContent.php?content=loc');
        } else {
            //**********get add product failed message
            header('Location: fail1.php');
            //echo "<script>window.location.href='register.php';</script>";
        }
    }

    //update pet category
    if (isset($_POST['Update'])) {
    //Fetch data from the fields
        $name = $_POST['lname'];
        //$img = $_POST['image'];
        $status = 1;
        $date = date("Y/m/d h:i:s");
                $result = updateLocation($lid,$name,$status);
                if ($result) {
                    //**********
                    header('Location: adminviewContent.php?content=loc');
                } else {
                    //**********get add product failed message
                    header('Location: fail.php');
                    //echo "<script>window.location.href='register.php';</script>";
                }
    }
?>