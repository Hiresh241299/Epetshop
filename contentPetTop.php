<!--Form-->
<?php
                                        //check if there is query string and check if the id exists
                                        $petexists = false;
                                        if (isset($_GET['p'])) {
                                            if (verifyPetCat($_GET['p'])) {
                                                //load in form
                                                $petexists = true;

                                                $sql = "CALL sp_getPetCategories();";
                                                $result = $conn->query($sql);
                                                if ($result -> num_rows > 0) {
                                                    //output data for each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        if ($row['petcatID'] == $_GET['p']) {
                                                            $petid = $row['petcatID'];
                                                            $name = $row['name'];
                                                            $img = $row['imgPath'];
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
        <input type="text" class="form-control input-style" id="petname" name="pname"
            value='<?php (($petexists)?$x=$name:$x=" "); echo $x;?>' placeholder="Enter Pet Name">
    </div>
    <!-- Load Image -->
    <img class="rounded" id="addimg" src='<?php (($petexists)?$x="category/".$img:$x=" "); echo $x;?>'
        alt="Pet Image" />
    <input type="text" value='<?php (($petexists)?$x=$img:$x=" "); echo $x;?>' disabled hidden>
    </br>
    </br>
    <!--<div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="image" id="image" class="form-control"
                                                    required="">
                                            </div>-->
    <div class="custom-file">
        <input type="file" id="image" name="image" class="custom-file-input" id="validatedCustomFile" required="">
        <label class="custom-file-label" for="validatedCustomFile">Choose
            file...</label>
    </div>
    <button type="submit" class="btn btn-primary btn-style mt-4"
        name="<?php echo $btnAddOrUpdate;?>"><?php echo $btnAddOrUpdate;?></button>
    <?php
                                            if ($petexists) {
                                                echo'
                                                <a href="adminviewContent.php?content=p"  class="btn btn-warning btn-style mt-4">Cancel</a>
                                                <button type="button"  class="btn btn-danger btn-style mt-4" onclick="DeleteContent('.$petid.', '.$_GET['p'].')">Delete</button>
                                                ';
                                            }
                                            ?>
</form>
<!--Form-->

<?php
                                        //insert pet category
                                        if (isset($_POST['Insert'])) {
                                            //Fetch data from the fields
                                            $name = $_POST['pname'];
                                            //$img = $_POST['image'];
                                            $status = 1;
                                            $date = date("Y/m/d h:i:s");
                                            //add img field to form
                                            $statusMsg = '';
                                            $targetDir = "category/";
                                            $fileName = basename($_FILES["image"]["name"]);
                                            $targetFilePath = $targetDir . $fileName;
                                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                                            //allow certain file type
                                            $allowTypes = array('jpg','jpeg','png','gif','tiff','webp');

                                            if (in_array($fileType, $allowTypes)) {
                                                // Upload file to server
                                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                                                    $result = addPetCat($name, $fileName, $date, $status);
                                                    if ($result) {
                                                        //**********
                                                        header('Location: adminviewContent.php?content=p');
                                                    } else {
                                                        //**********get add product failed message
                                                        header('Location: fail.php');
                                                        //echo "<script>window.location.href='register.php';</script>";
                                                    }
                                                } else {
                                                    $statusMsg = "Sorry, there was an error uploading your file.";
                                                    header("Location: fail.php");
                                                }
                                            }
                                        }

                                        //update pet category
                                        if (isset($_POST['Update'])) {
                                        //Fetch data from the fields
                                            $name = $_POST['pname'];
                                            //$img = $_POST['image'];
                                            $status = 1;
                                            $date = date("Y/m/d h:i:s");
                                            //add img field to form
                                            $statusMsg = '';
                                            $targetDir = "category/";
                                            $fileName = basename($_FILES["image"]["name"]);
                                            $targetFilePath = $targetDir . $fileName;
                                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                                            //allow certain file type
                                            $allowTypes = array('jpg','jpeg','png','gif','tiff','webp');
                                            if (in_array($fileType, $allowTypes)) {
                                                // Upload file to server
                                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                                                    $result = updatePetCategory($petid, $name, $fileName, $date, $status);
                                                    if ($result) {
                                                        //**********
                                                        header('Location: adminviewContent.php?content=p');
                                                    } else {
                                                        //**********get add product failed message
                                                        header('Location: fail.php');
                                                        //echo "<script>window.location.href='register.php';</script>";
                                                    }
                                                } else {
                                                    $statusMsg = "Sorry, there was an error uploading your file.";
                                                    header("Location: fail.php");
                                                }
                                            }
                                        }
                                        ?>