            <?php
//require 'blissquants/public_html/db_connect_vol.php';
error_reporting(0);                                 //mysql_num_rows is showing error so this will not display any error
ini_set('display_errors', 0);
 $con=mysqli_connect("localhost","root","");
   if(!$con)
   {
       die('could not connect to databace:'.mysqli_error());       
   }
  $sel_db =  mysqli_select_db($con,"bliss_vol");

$n=0;
//$dat1 =  $_POST['ar_data'];
//$date1 =  $_POST['date1'];
//$sort =  $dat1['sort'];
//$search = $_POST['search'];
$date1 = "2016-07-10/2016-07-14";



//$sort =  "DESC";
$search = "CAIRN";
$dates1 = explode("/", $date1);

 $date1 = $dates1[0]; //take one date
    if(count($dates1)>1) // check whether second date is there or not
    {
        $date2 = $dates1[1]; // insert second date
    }
    else
    {
        $date2 = $date1; 
    }
$check1 = 0;
$check2 = 0;
$total_data = 0;
$array_all = array(array());
$array2 = (array) null;
$array3 = (array) null;
$array_date = (array) null;
$array_vol = (array) null;
$array_eq = (array) null;
 $today = date("Y-m-d");
mysqli_set_charset($con,'utf8');
                             //select db
        if($search == "")
        {
            $sql = "SELECT * FROM `companies` order by c_name $sort";                                     //FETCHING ALL company namre from db
        }
        else
        {
            $sql = "SELECT * FROM `companies` WHERE c_name LIKE '$search%'";    
        }
        $result=mysqli_query($con,$sql);
        $n=mysqli_num_rows($result);
    if($n>0)
      {
        while($row=mysqli_fetch_row($result))                                     //inserting all fetch value to array
        {
            if($row != null)
            {
                $array2[] = $row[1];
                $array3[] = $row[2];
            }
        }
        for ($i = 0 ; $i < $n; $i++)                                               //calculate last inserted value is maximum of particular or not
        {
            $table_name = strtolower("vol_".$array2[$i]);
            
             $sql3 = "SELECT ROUND(ATM_vol,1),date,time FROM `$table_name` WHERE ATM_vol  > 10 and ATM_vol <> '50.0' and date between '$date1' and '$date2' order by entry_number";
            $result3 = mysqli_query($con,$sql3);
            $n3=mysqli_num_rows($result3);
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result3))
              {
                  if($row != null)
                  {  
                    $array_vol[] = $row[0];
                    $time = date("g:i a", strtotime($row[2]));


                    if($date1 == $date2)
                    {
                      $array_date[] = $time;
                    }
                    else
                    {
                        $date = new DateTime($row[1]);
$date = $date->format('d M Y');
                      $array_date[] = $date." ".$time;
                    }
					  
                      // echo $table_name;
                  }
              }
             $sql_vol_highlow = "SELECT  ROUND( ATM_vol, 1 ) as current,ROUND( maxv.maxvol, 1),ROUND( maxv.minvol, 1)
FROM `$table_name`,(SELECT  MAX(ATM_vol) as maxvol,MIN(ATM_vol) as minvol FROM `$table_name` where date
BETWEEN '$date1'
AND '$date2'
)maxv
ORDER BY entry_number DESC
LIMIT 1";
             
                  //and ATM_vol <> '50.0'
            $result_vol_highlow = mysqli_query($con,$sql_vol_highlow);
            $n3=mysqli_num_rows($result_vol_highlow);
             
            if($n3>0)
            {
              while($row=mysqli_fetch_row($result_vol_highlow))
              {
                  if($row != null)
                  {     $vol[0] = $row[0]; //get last date of inserted data
                        $vol[1] = $row[1];        //taking last vol to variable
                         $vol[2] = $row[2];        //taking last vol to variable
                    
                     //  echo $table_name." ".$row[0]." ".$row[1]." ".$row[2]." ".$row[4]." ".$row[5]."<br>";
                  }
              }
            }
            
            $sql2 = "select ROUND( ATM_vol, 1) from `$table_name` ORDER BY entry_number DESC LIMIT 1 , 1";
            $result2 = mysqli_query($con,$sql2);
            $n2=mysqli_num_rows($result2);
            if($n2>0)
            {
              while($row = mysqli_fetch_row($result2))
              {
                  if($row != null)
                  {                     
                      
                        $previous_vol = $row[0];
                  }
              }
            }

          //   $array_all[$total_data][3] = "<img src='image/". $array3[$i].".jpg' alt='no img' name='$array2[$i]' height='15' width='20'/>";
            
           // $total_data = $total_data + 1;
            }
          
           
            
      
       echo json_encode(array("a" => $array_date,"b" => $array_vol, "pre_vol" => $previous_vol,"vol" => $vol ));  //json code to encrypt
       }
       
      }
     else 
       {
       echo "No Data";
       } 
          
?>

