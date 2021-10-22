
<?php

include('../includes/dbconnection.php');
include('../includes/session.php');
error_reporting(0);

if(isset($_GET['assignmentId'])){

    $_SESSION['assignmentId'] = $_GET['assignmentId'];
    
    $query = mysqli_query($con,"select * from tblassignments where Id='$_SESSION[assignmentId]'");
    $rowi = mysqli_fetch_array($query);

    $courseId = $rowi['courseId'];
    $llevelId = $rowi['levelId'];
    $staffId = $rowi['staffId'];
    $scoreObtainable = $rowi['scoreObtainable'];
    $passMark = $rowi['passMark'];

    $courseId = $rowi['courseId'];
    $queryc = mysqli_query($con,"select * from tblcourse where Id='$courseId'");
    $rowc = mysqli_fetch_array($queryc);

    $levelId = $rowi['levelId'];
    $queryl = mysqli_query($con,"select * from tbllevel where Id='$llevelId'");
    $rowl = mysqli_fetch_array($queryl);
    
    }
    
    else{
    
    echo "<script type = \"text/javascript\">
        window.location = (\"viewGradedAssignments.php\")
        </script>"; 
    }

?>

<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php include 'includes/title.php';?>
<meta name="description" content="Ela Admin - HTML5 Admin Template">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
<link rel="shortcut icon" href="../img/favicon2.jpeg" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
<link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

<script>
function showCourses(str) {
if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
} else { 
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","ajaxCallCourses2.php?lid="+str,true);
    xmlhttp.send();
}
}
//Only allows Numbers
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

//Check if the value entered is greater than 100 and not less than 0
function myFunction() {
  var x, text;
  // Get the value of the input field with id="numb"
  x = document.getElementById("score").value;
  // If x is Not a Number or less than one or greater than 10
  if (isNaN(x) || x < 1 || x > 100) {
    // text = "Value cannot be greater than 100 or less than 0";
    alert("Invalid");
  } 
  else{
    text = "";
  }
 document.getElementById("demo").innerHTML = text;
}
</script>

</head>
<body>
<!-- Left Panel -->
<?php include 'includes/leftMenu.php';?>

<!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
        <?php include 'includes/header.php';?>
    <!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Assignments</a></li>
                                <li class="active">Graded Assignments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       
                      
                    </div> <!-- .card -->
                </div><!--/.col-->
           

            <br><br>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title"><h2 align="center">All Assignments Graded</h2></strong>
                        </div>
                        <div class="card-body">
                        <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Fullname</th>
                                        <th>Course Code </th>
                                        <th>Course Title</th>
                                        <th>Level</th>
                                        <th>Submitted Description</th>
                                        <th>Score Obtainable</th>
                                        <th>Pass Mark</th>
                                        <th>Score Obtained</th>
                                        <th>Status</th>
                                        <th>Lecturer Notes/Remark</th>
                                        <th>Assignment Submitted</th>
                                        <th>Date Submitted</th>
                                        <th>Status</th>
                                        <th>Date Graded</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                        <?php
                $ret=mysqli_query($con,"SELECT tblassignmentsubmitted.Id AS assignmentSubmittedId, tblassignmentsubmitted.assignmentId,tblassignmentsubmitted.levelId,
                tblassignmentsubmitted.courseId,tblassignmentsubmitted.description As submittedDescription,tblassignmentsubmitted.assignmentSubmitted,tblassignments.staffId,tblassignments.Id, 
                tblassignments.title,tblassignments.description,tblassignments.passMark,
                tblassignmentsubmitted.staffId,tblassignmentsubmitted.scoreObtained,tblassignmentsubmitted.scoreObtainable,tblassignmentsubmitted.scoreStatus,tblassignmentsubmitted.isGraded,
                tblassignmentsubmitted.staffNotes,tblassignmentsubmitted.dateSubmitted,tbllevel.levelName,tblcourse.courseTitle,tblcourse.courseCode,tblassignmentsubmitted.dateGraded,
                tblstudent.firstName, tblstudent.lastName
                from tblassignmentsubmitted
                INNER JOIN tbllevel ON tbllevel.Id = tblassignmentsubmitted.levelId
                INNER JOIN tblstudent ON tblstudent.matricNo = tblassignmentsubmitted.matricNo
                INNER JOIN tblassignments ON tblassignments.Id = tblassignmentsubmitted.assignmentId
                INNER JOIN tblcourse ON tblcourse.Id = tblassignmentsubmitted.courseId
                where tblassignmentsubmitted.assignmentId = '$_SESSION[assignmentId]'");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['firstName']." ". $row['lastName'];?></td>
                <td><?php  echo $row['courseCode'];?></td>
                <td><?php  echo $row['courseTitle'];?></td>
                <td><?php  echo $row['levelName'];?></td>
                <td><?php  echo $row['submittedDescription'];?></td>
                <td><?php  echo $row['scoreObtainable'];?></td>
                <td><?php  echo $row['passMark'];?></td>
                <td><?php  echo $row['scoreObtained'];?></td>
                <td><?php  echo $row['scoreStatus'];?></td>
                <td><?php  echo $row['staffNotes'];?></td>
                <td><a href='../student/download.php?file=<?php echo urlencode($row['assignmentSubmitted']);?>' title="Download File"><i class="fa fa-download fa-1x">&nbsp;&nbsp;&nbsp;Download</i></a></td>
                <td><?php  echo $row['dateSubmitted'];?></td>
                <td><?php if($row['isGraded'] == 0){echo "Not Graded";} if($row['isGraded'] == 1){ echo "Graded";};?></td>
                <td><?php  echo $row['dateGraded'];?></td>
                </tr>
                <?php 
                $cnt=$cnt+1;
                }?>
                                                                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<!-- end of datatable -->

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

    <?php include 'includes/footer.php';?>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/lib/data-table/datatables.min.js"></script>
<script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="../assets/js/lib/data-table/jszip.min.js"></script>
<script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="../assets/js/init/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>

</body>
</html>
