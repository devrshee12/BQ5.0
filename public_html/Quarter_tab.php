
<ul class="nav nav-tabs" style="border:none">  

    <li ><a href='BlissData.php' >IV Data</a></li>

    <li > <a href="Short-Gamma.php" > Short </a></li>
    <li  > <a href="Long-Gamma.php" > Long  </a></li>
    <li  > <a href="Low-priced.php" > Low IV </a></li>
    <li  > <a href="High-priced.php" > High IV</a></li>
    <?php 
    include("./privilege_check.php");

$check_obj = new user_privilege;
$array = $check_obj->get_export_privilege();
    if(isset($array['email']));
    {
    $email_id = explode(",", $array['email']);
    if (isset($_SESSION['email']) && in_array(strtolower($_SESSION['email']), $email_id)) {
        echo '<li id="expo_button">  <a >
          <span class="glyphicon glyphicon-export" ></span> Export
            </a></li>';
    }
    }
    ?>
    <h3>IV Analytics: Quarterly Average </h3>      

</ul> 