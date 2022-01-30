<!--Table -->
<div class="card-body">
                                            <div class="teams mb-4">
                                                <div class="row px-2">
                                                    <!--Repeat-->
                                                    <?php
                                        
                                            $sql = "CALL sp_getPetCategories();";
                                            $result = $conn->query($sql);
                                            $count = 0;
                                            if ($result -> num_rows > 0) {
                                                //output data for each row
                                                while ($row = $result->fetch_assoc()) {
                                                    $count++;
                                                    $petid = $row['petcatID'];
                                                    $name = $row['name'];
                                                    $img = $row['imgPath'];

                                                    echo '
                                                    <div class="col-lg-3 col-md-6 mb-0 px-2 rounded text-center">
                                                <div class="item">
                                                    <div class="d-team-grid team-info">
                                                        <div class="column"><a href="adminviewContent.php?content=p&p='.$petid.'"><img class="border rounded"
                                                                    src="category/'.$img.'" alt="pet image" style="width:75%"/></a>
                                                        </div>
                                                        <div class="container">
                                                            <a href="adminviewContent.php?content=p&p='.$petid.'"><h5 class="name-pos mb-0">'.$name.'
                                                            </h5></a>
                                                            <!--<input class="btn btn-warning rounded" type="button" value="'.$name.'" style="width:75%"/>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    ';
                                                }
                                            }
                                            $result->close();
                                            $conn->next_result();
                                        
                                        
                                            ?>
                                                    <!--Repeat-->

                                                </div>
                                            </div>
                                        </div>
                                        <!--Table -->