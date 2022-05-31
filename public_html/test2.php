 <?php 
 include("db_connect.php");
 $scrip = "ACC";
 $table_name_fut = "fut_".strtolower($scrip);
 $startdate = "2019-01-15";
 $date = "2019-01-21";
 $sql_current = "SELECT date,open,high,low,close FROM `$table_name_fut` WHERE date between '$startdate' and '$date' order by date desc ";
            $result_current = mysqli_query($con, $sql_current);
           $row = mysqli_fetch_all($result_current);
echo serialize($row);
                echo "      <tr>
                            <td>" .$row[0][0] ."</td>
                            <td>" . Round($row[0][1], 1) . "</td>
                            <td>" . Round($row[0][2], 1) . "</td>
                            <td>" . Round($row[0][3], 1) . "</td>
                            <td>" . Round($row[0][4], 1) . "</td>
                                <td>" . Round($row[1][4], 1) . "</td>
                        </tr>";
            
            ?>