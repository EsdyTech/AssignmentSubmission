<?php
 include('../includes/dbconnection.php');
include('../includes/session.php');

$delid = $_GET['delid'];

$query = mysqli_query($con,"DELETE FROM tblassignmentsubmitted WHERE Id ='$delid'");

if ($query == TRUE) {

    echo "<script type = \"text/javascript\">
    window.location = (\"submitAssignment.php?assignmentId=$_SESSION[assignmentId]\")
    </script>";  

    $alertStyle ="alert alert-success";
    $statusMsg="Assignment Deleted Successfully!";
}
else{


}

?>

