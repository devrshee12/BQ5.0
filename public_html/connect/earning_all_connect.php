<?php
$date = $_POST['data1'];
$script = $_POST['script'];
//$search = "sbin";
//$date = "2018-04-10/2018-05-10";
 include_once('Intraday_IV.php');  
       
 $intraday_obj = new Intraday_IV(); 

echo json_encode($intraday_obj->get_earning_all($date,$script)) ;
//---bliss---
//$dat = $_POST['data1'];
//echo $dat;
/* Database connection start */
/*include("../db_connect.php");


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'d_name', 
	1 => 'date',
	2 => 'time',
        3 => 'changes',
        4 => 'movement',
        
);

    $dat1 = filter_input(INPUT_POST, 'data1'); //get date
 //  $dat1 = "2018-04-10/2018-05-10";
    $pieces = explode("/", $dat1); // split date with /
    $date1 = $pieces[0]; //take one date
    if(count($pieces)>1) // check whether second date is there or not
    {
        $date2 = $pieces[1]; // insert second date
    }
    else
    {
        $date2 = 0; 
    }
    if($date2 == 0)
        {
            $sql = "SELECT name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement FROM `earning2` WHERE date = '$date1'"; 
        }
    else 
        {
            $sql = "select name,d_name,date,time,max_change,movement,changes,max_Movement,min_Movement from `earning2` WHERE date between '$date1' and '$date2'" ;
        }
     
//}
//$sql = "select d_name,date,time,max_change,movement from `earning2` WHERE date = '$dat1'" ;
//$sql.=" FROM earning2";
$query=mysqli_query($con, $sql) or die("earning_connect.php: get earning2");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.



if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql = "SELECT name,d_name, date, time,changes,movement";
$sql.=" FROM earning2 WHERE 1=1";
	$sql.=" AND ( d_name LIKE '".$requestData['search']['value']."%'";  
        $sql.=" OR name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR date LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR time LIKE '".$requestData['search']['value']."%')";
  
       
}
 $query=mysqli_query($con, $sql) or die("earning_connect.php: get earning2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";


$query=mysqli_query($con, $sql) or die("earning_connect.php: get earning2");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
     //   if(strlen($row["d_name"]) > 20 )
      //  $nestedData[] = date("d M Y",strtotime($row['date'])); //edited by aakash
          // $nestedData[] = $row['date']; //edited by aakash
    
            
         if($row["time"] == "00:00:00")
                            {
                                $name1 = $row["d_name"];
                                $dt1 = $row["date"];
                               
                                $result2 = mysqli_query($con,"SELECT name,d_name,date,time FROM earning2 WHERE d_name = '$name1' AND changes <> 0 ORDER BY date desc LIMIT 1;"); //get last result time from earning which has changes not zero bcoz we want time from that
                                $m =  mysqli_num_rows($result2); 
                               // echo "<br><br>  yes <br><br>".mysql_num_rows($result2);
                                $p = 0;
                               if($m>0)
                               {
                                while($row1=mysqli_fetch_row($result2)) //fetch row one by one in loop
                                    {
                                        $p = $p + 1;    
                                        if($p == $m)
											$tt=$row1[3];
                                        $nestedData[] = date("h:i A", strtotime($tt));   
                                       // $array2[] = $row1[4]; 
                                       /// echo "<br><br>  yes <br><br>";
                                    }
                               }
                               else
                                {
									$tt=$row["time"];
                                   $nestedData[] = date("h:i A", strtotime($tt));   
                               }
                            }
                            else
                            {
								$tt=$row["time"];
                                $nestedData[] = date("h:i A", strtotime($tt)); 
                            }
                             $nestedData[] = $row["name"];
                              $nestedData[] = $row['date']; //edited by aakash
	/*if( !empty($requestData['search']['value']) ) {
        $nestedData[] = $row[4];
        }
        else {
            $nestedData[]="±".$row['max_change'];
           }
        if( !empty($requestData['search']['value']) ) {
            if($row["movement"] == "0")
                {
                    $nestedData[]="-";
                }
            else
                {
                    $nestedData[] = Round($row["movement"],1);
                }
        }
        else {
                $nestedData[]=$row['min_Movement']." - ".$row['max_Movement'];
        }
       
        //$nestedData[] = "<img src='image/".$row["d_name"].".jpg' alt='img' height='15' width='20'/>";
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo(json_encode($json_data));  // send data as json format
*/

?>
