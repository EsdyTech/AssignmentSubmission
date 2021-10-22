
<?php

include('../includes/dbconnection.php');
include('../includes/session.php');
error_reporting(0);

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
                                <li><a href="#">Assignment</a></li>
                                <li class="active">Submit Assignment</li>
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
                            <strong class="card-title"><h2 align="center">All Assignments Submitted</h2> <i style="margin-left:500px;color:red;">Note: Once an assignment submitted has been graded, you can't delete that submitted assignment!</i></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Lecturer</th>
                                        <th>Course Code </th>
                                        <th>Course Title</th>
                                        <th>Level</th>
                                        <th>Description of Submission</th>
                                        <th>Score Obtainable</th>
                                        <th>Score Obtained</th>
                                        <th>Status</th>
                                        <th>Lecturer Notes</th>
                                        <th>Assignment Submitted</th>
                                        <th>Date Submitted</th>
                                        <th>Status</th>
                                        <th>Date Graded</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                        <?php
                $ret=mysqli_query($con,"SELECT tblassignmentsubmitted.Id AS assignmentSubmittedId, tblassignmentsubmitted.assignmentId,tblassignmentsubmitted.levelId,
                tblassignmentsubmitted.courseId,tblassignmentsubmitted.description AS submittedDescription,tblassignmentsubmitted.assignmentSubmitted,tblassignments.staffId,tblassignments.Id, tblassignments.title,tblassignments.description,
                tblassignmentsubmitted.staffId,tblassignmentsubmitted.scoreObtained,tblassignmentsubmitted.scoreObtainable,tblassignmentsubmitted.scoreStatus,tblassignmentsubmitted.isGraded,
                tblassignmentsubmitted.staffNotes,tblassignmentsubmitted.dateSubmitted,tbllevel.levelName,tblcourse.courseTitle,tblcourse.courseCode,tblassignmentsubmitted.dateGraded,
                tblstaff.firstName, tblstaff.lastName
                from tblassignmentsubmitted
                INNER JOIN tbllevel ON tbllevel.Id = tblassignmentsubmitted.levelId
                INNER JOIN tblstaff ON tblstaff.staffId = tblassignmentsubmitted.staffId
                INNER JOIN tblassignments ON tblassignments.Id = tblassignmentsubmitted.assignmentId
                INNER JOIN tblcourse ON tblcourse.Id = tblassignmentsubmitted.courseId
                where tblassignmentsubmitted.matricNo = '$matricNo' and tblassignmentsubmitted.levelId = '$levelId'");
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
                <td><?php  echo $row['scoreObtained'];?></td>
                <td <?php if($row['scoreStatus'] == "Failed"){echo "style='color:red'";} if($row['scoreStatus'] == "Passed"){ echo "style='color:green'";};?>><?php  echo $row['scoreStatus'];?></td>
                <td><?php  echo $row['staffNotes'];?></td>
                <td><a href='download.php?file=<?php echo urlencode($row['assignmentSubmitted']);?>' title="Download Assignment"><i class="fa fa-download fa-1x">&nbsp;&nbsp;&nbsp;Download</i></a></td>
                <td><?php  echo $row['dateSubmitted'];?></td>
                <td <?php if($row['isGraded'] == 0){echo "style='color:red'";} if($row['isGraded'] == 1){ echo "style='color:green'";}?>><?php if($row['isGraded'] == 0){echo "Not Graded";} if($row['isGraded'] == 1){ echo "Graded";}?></td>
                <td><?php  echo $row['dateGraded'];?></td>
                <?php
                    if($row['isGraded'] == 0){
                ?>
                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteAssignmentSubmitted.php?delid=<?php echo $row['assignmentSubmittedId'];?>" title="Delete Assignment"><i class="fa fa-trash fa-1x"></i></a></td>
                <?php
                }else{
                ?>
                <td></td>
                 <?php
                    }
                ?>
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
