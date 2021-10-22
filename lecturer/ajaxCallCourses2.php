<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');


    $lid = intval($_GET['lid']);//gradeId

        $queryss=mysqli_query($con,"select * from tblcourse where departmentId=".$departmentId." and facultyId = ".$facultyId." and levelId = ".$lid." ORDER BY courseTitle ASC");                        
        $countt = mysqli_num_rows($queryss);

        if($countt > 0){                       
        echo '<label for="select" class="form-control-label">Course</label>
        <select required name="courseId" class="custom-select form-control">';
        echo'<option value="">--Select Course--</option>';
        while ($row = mysqli_fetch_array($queryss)) {
        echo'<option value="'.$row['Id'].'" >'.$row['courseTitle'].'</option>';
        }
        echo '</select>';
        }

?>

