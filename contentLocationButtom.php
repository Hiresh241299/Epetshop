<table id="" class="display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
    <thead>
        <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Emp. Name: activate to sort column descending" style="width: 239px;" aria-sort="ascending">
                No</th>
            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Emp. Name: activate to sort column descending" style="width: 239px;" aria-sort="ascending">
                District</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Emp. Status: activate to sort column ascending" style="width: 195px;">Action</th>

        </tr>
    </thead>
    <tbody>
        <?php
                                                    //get all users
                                                    //sp_getAllUsers (where roleID != '')

                                                    //Load all users from database
                                                    $sql = "CALL sp_getAllLocation();";
                                                    $result = $conn->query($sql);
                                                    $count = 0;
                                
                                                    if ($result -> num_rows > 0) {
                                                        //output data for each row
                                                        while ($row = $result->fetch_assoc()) {
                                                            $count++;

                                                            $lid = $row['locationID'];
                                                            $name = $row['name'];
                                                            
                                                            echo '
                                                            <tr role="row" class="odd">
                                                                <td>'.$count.'</span></td>
                                                                <td class="">'.$name.'</td>
                                                                <td><a href="adminviewContent.php?content=loc&loc='.$lid.'" class="btn btn-success">View</a></td>
                                                            </tr>
                                                            ';
                                                        }
                                                    }
                                                    $result->close();
                                                    $conn->next_result();
                                                    ?>
    </tbody>
</table>