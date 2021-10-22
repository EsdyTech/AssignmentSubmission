
<?php
include('dbconnection.php');
session_start(); 

if (isset($_SESSION['staffId']) )
{
    $staffId = $_SESSION['staffId'];

    $query = mysqli_query($con,"select * from tblassignedstaff where staffId='$staffId'");
    $count = mysqli_num_rows($query);
    $rows = mysqli_fetch_array($query);
    
    
    //FOR ADMINISTRATOR
    $query2 = mysqli_query($con,"select * from tblassignedadmin where staffId='$staffId'");
    $count2 = mysqli_num_rows($query2);
    $rowss = mysqli_fetch_array($query2);

    if($count > 0){
        //$roleId =  $rows['roleId'];
      $departmentId =  $rows['departmentId'];
      $facultyId =  $rows['facultyId'];

    }

    else if($count2 > 0){
      //$roleId =  $rows['roleId'];
      $departmentId =  $rowss['departmentId'];
      $facultyId =  $rowss['facultyId'];

    }
    else{
   
    }

}

else if (isset($_SESSION['matricNo']) )
{
    $matricNo = $_SESSION['matricNo'];

    $query = mysqli_query($con,"select * from tblstudent where matricNo='$matricNo'");
    $count = mysqli_num_rows($query);
    $rows = mysqli_fetch_array($query);
    
    
    if($count > 0){
      //$roleId =  $rows['roleId'];
      $departmentId =  $rows['departmentId'];
      $facultyId =  $rows['facultyId'];
      $levelId =  $rows['levelId'];

    }
    else{
   
    }
}

else{
  echo "<script type = \"text/javascript\">
  window.location = (\"../index.php\");
  </script>";

}


// $expiry = 1800 ;//session expiry required after 30 mins
// if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {

//     session_unset();
//     session_destroy();
//     echo "<script type = \"text/javascript\">
//           window.location = (\"../index.php\");
//           </script>";

// }
// $_SESSION['LAST'] = time();
    
?>