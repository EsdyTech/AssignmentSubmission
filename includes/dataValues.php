
<?php 
error_reporting(0);
$que=mysqli_query($con,"select * from tbldepartment where Id = '$departmentId'"); //department                     
$row = mysqli_fetch_array($que);  
$departmentName = $row['departmentName'];      


$que=mysqli_query($con,"select * from tblfaculty where Id = '$facultyId'"); //faculty                      
$row = mysqli_fetch_array($que);  
$facultyName = $row['facultyName'];      




////////////  ADMINISTRATOR DASHBOARD //////////////

$queryStudent=mysqli_query($con,"select * from tblstudent where facultyId = '$facultyId' and departmentId = '$departmentId'"); //assigned staff
$adminCountStudent = mysqli_num_rows($queryStudent);

$queryCourses=mysqli_query($con,"select * from tblcourse where facultyId = '$facultyId' and departmentId = '$departmentId'"); //today's Attendance
$adminCountCourses=mysqli_num_rows($queryCourses);




//-------------------------SUPER ADMINISTRATOR


$admin=mysqli_query($con,"select * from tbladmin where adminTypeId = '2'");
$countAdmin=mysqli_num_rows($admin);

$todaysAtt=mysqli_query($con,"select * from tblattendance where date(DateTaken)=CURDATE();"); //today's Attendance
$countTodaysAttendance=mysqli_num_rows($todaysAtt);

$allAtt=mysqli_query($con,"select * from tblattendance");
$countAllAttendance=mysqli_num_rows($allAtt);

// //-------------------------------------------


$staffQuery=mysqli_query($con,"select * from tblstaff"); //staff
$countAllStaff = mysqli_num_rows($staffQuery);

$departmentQuery=mysqli_query($con,"select * from tbldepartment"); //department
$countDepartment = mysqli_num_rows($departmentQuery);

$facultyQuery=mysqli_query($con,"select * from tblfaculty"); //faculty
$countFaculty = mysqli_num_rows($facultyQuery);

$studentQuery=mysqli_query($con,"select * from tblstudent"); //student
$countAllStudent = mysqli_num_rows($studentQuery);

$courseQuery=mysqli_query($con,"select * from tblcourse"); //courses
$countAllCourses = mysqli_num_rows($courseQuery);


//-----------------------LECTURER----------------------

$lecCourse=mysqli_query($con,"select * from tblcourse where departmentId = '$departmentId'"); //courses
$countLecCourse = mysqli_num_rows($lecCourse);

$que=mysqli_query($con,"select * from tblassignedstaff where departmentId = '$departmentId'"); //assigned staff
$lecCountStaff = mysqli_num_rows($que);


//-----------------------STUDENT----------------------
    $querys = mysqli_query($con,"select * from tblassignments where levelId ='$levelId'");
    while ($rrs=mysqli_fetch_array($querys)) {
        $allAssignments++;
    }

$studAss=mysqli_query($con,"select * from tblassignments where levelId = '$levelId'"); //courses
while ($rowq=mysqli_fetch_array($studAss)) {

    $assignmentId = $rowq['Id'];
    $qqq = mysqli_query($con,"select * from tblassignmentsubmitted where assignmentId ='$assignmentId' and matricNo = '$matricNo' and levelId ='$levelId'");
    while ($ros=mysqli_fetch_array($qqq)) {
        $countSubmitted++;
    }
}

$studAss2=mysqli_query($con,"select * from tblassignments where levelId = '$levelId'"); //courses
while ($rowq2=mysqli_fetch_array($studAss2)) {

    $assignmentId2 = $rowq2['Id'];
    $qqqs = mysqli_query($con,"select * from tblassignmentsubmitted where assignmentId !='$assignmentId2' and matricNo = '$matricNo' and levelId ='$levelId'");
    while ($ross=mysqli_fetch_array($qqqs)) {
        $countNotSubmitted++;
    }
}

//-----------------------------------------------------------------------------------------

$querysuper = mysqli_query($con,"select * from tblassignments");
while ($rrs=mysqli_fetch_array($querysuper)) {
    $allAssignmentsSuper++;
}

$studAsssuper=mysqli_query($con,"select * from tblassignments"); //courses
while ($rowqs=mysqli_fetch_array($studAsssuper)) {

$assignmentIds = $rowqs['Id'];
$qqqs = mysqli_query($con,"select * from tblassignmentsubmitted where assignmentId ='$assignmentIds'");
while ($ros=mysqli_fetch_array($qqqs)) {
    $countSubmittedSuper++;
}
}

?>