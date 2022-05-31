
<?php
$table1 =  $_POST['table_name'];
//$table1 = 'earning2';
                    $get_date;
                     include("db_connect.php");                      
                        $sql = "SELECT UPDATE_TIME FROM information_schema.tables WHERE  TABLE_SCHEMA = 'bliss' AND TABLE_NAME = "."'$table1'";
                          $result=mysqli_query($con,$sql);
                         while($row=mysqli_fetch_row($result))
                            {               
                        $get_date = $row[0];
                        $get_date = date("d M Y|h:iA", strtotime($get_date));
                        echo json_encode("Last Updated:" .$get_date);
                        }
                  

