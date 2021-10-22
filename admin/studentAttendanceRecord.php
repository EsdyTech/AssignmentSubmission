
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
function showTypes(str) {
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
        xmlhttp.open("GET","ajaxCallTypes.php?tid="+str,true);
        xmlhttp.send();
    }
}

function showValues(str) {
    if (str == "") {
        document.getElementById("txtHintt").innerHTML = "";
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
                document.getElementById("txtHintt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCallDeptCourses.php?fid="+str,true);
        xmlhttp.send();
    }
}

function showCourses(str) {
    if (str == "") {
        document.getElementById("txtHinttt").innerHTML = "";
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
                document.getElementById("txtHinttt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCallStudentInDept.php?deptId="+str,true);
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
                                    <li><a href="#">Attendance</a></li>
                                    <li class="active">Student Attendance</li>
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
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Student Attendance Record</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="">
                                            <div class="row">
                                                    </div>
                                                    <div>
                                                    
                                
                                        <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                        <label for="select" class=" form-control-label">Select Faculty</label>
                                             <?php 
                                                $query=mysqli_query($con,"select * from tblfaculty where Id = '$facultyId' ORDER BY facultyName ASC");                        
                                                $count = mysqli_num_rows($query);
                                                if($count > 0){                       
                                                    echo ' <select required name="facultyId" onchange="showValues(this.value)" class="custom-select form-control">';
                                                    echo'<option value="">--Select Faculty--</option>';
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    echo'<option value="'.$row['Id'].'" >'.$row['facultyName'].'</option>';
                                                        }
                                                            echo '</select>';
                                                        }
                                                ?>              
                                                </div>
                                                </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                 <label for="x_card_code" class="control-label mb-1">Type</label>
                                               <select required name="typeId" onchange="showTypes(this.value)" class="form-control">
                                                <option value="">--Select Type--</option>
                                                <option value="1" >All</option>
                                                <option value="2" >Single Date</option>
                                                <option value="3" >Between Date Range</option>
                                                </select>
                                                                                          
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php
                                                    echo"<div id='txtHintt'></div>";
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php
                                                    echo"<div id='txtHint'></div>";
                                                    ?>                                        
                                                </div>
                                            </div>
                                          </div>

                                           <?php
                                            echo"<div id='txtHinttt'></div>";
                                            ?>  

                                                <button type="submit" name="submit" class="btn btn-primary">View Attendance Record</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
                   
                <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Record List</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                   <thead>
                                    <tr>
                                    <th>S.NO</th>
                                    <th>Matric No</th>
                                    <th>Full Name</th>
                                    <th>Level</th>
                                    <th>Course</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>CheckInTime</th>
                                    <th>CheckOutTime</th>
                                    <th>Date Taken</th>
                                    <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
        <?php
                    
        if(isset($_POST['submit'])){

            $typeId  = $_POST['typeId'];
            $cardId  = $_POST['cardId'];
             $courseId  = $_POST['courseId'];
            $singleDate  = $_POST['singleDate'];
            $fromDate  = $_POST['fromDate'];
            $toDate  = $_POST['toDate'];

            if($typeId == 1){ //All Attendance per course
            $ret=mysqli_query($con,"SELECT tblcourse.courseId,tblcourse.courseTitle,tblattendance.cardId, tblstudent.matricNo, tblstudent.firstName,tblstudent.lastName, 
            tblstudent.otherName, tblattendance.CheckInTime,tblattendance.CheckOutTime, 
            tblattendance.DateTaken, tblfaculty.facultyName, tbldepartment.departmentName,tbllevel.levelName
            from tblattendance 
            INNER JOIN tblstudent ON tblstudent.cardId = tblattendance.cardId
            INNER JOIN tblcourse ON tblcourse.courseId = tblattendance.courseId
            INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
            INNER JOIN tbldepartment ON tbldepartment.Id = tblcourse.departmentId
            INNER JOIN tblfaculty ON tblfaculty.Id = tblcourse.facultyId
            where tblattendance.cardId ='$cardId' and tblcourse.courseId = '$courseId'");    
            
            }
            else if($typeId == 2){ //Single Dates

             $ret=mysqli_query($con,"SELECT tblcourse.courseId,tblcourse.courseTitle,tblattendance.cardId, tblstudent.matricNo, tblstudent.firstName,tblstudent.lastName, 
            tblstudent.otherName, tblattendance.CheckInTime,tblattendance.CheckOutTime, 
            tblattendance.DateTaken, tblfaculty.facultyName, tbldepartment.departmentName,tbllevel.levelName
            from tblattendance 
            INNER JOIN tblstudent ON tblstudent.cardId = tblattendance.cardId
            INNER JOIN tblcourse ON tblcourse.courseId = tblattendance.courseId
            INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
            INNER JOIN tbldepartment ON tbldepartment.Id = tblcourse.departmentId
            INNER JOIN tblfaculty ON tblfaculty.Id = tblcourse.facultyId
            where date(DateTaken) = '$singleDate' and tblattendance.cardId ='$cardId' and tblcourse.courseId = '$courseId'");          
        
            }

            else if($typeId == 3){ //Between Dates

             $ret=mysqli_query($con,"SELECT tblcourse.courseId,tblcourse.courseTitle,tblattendance.cardId, tblstudent.matricNo, tblstudent.firstName,tblstudent.lastName, 
            tblstudent.otherName, tblattendance.CheckInTime,tblattendance.CheckOutTime, 
            tblattendance.DateTaken, tblfaculty.facultyName, tbldepartment.departmentName,tbllevel.levelName
            from tblattendance 
            INNER JOIN tblstudent ON tblstudent.cardId = tblattendance.cardId
            INNER JOIN tblcourse ON tblcourse.courseId = tblattendance.courseId
            INNER JOIN tbllevel ON tbllevel.Id = tblstudent.levelId
            INNER JOIN tbldepartment ON tbldepartment.Id = tblcourse.departmentId
            INNER JOIN tblfaculty ON tblfaculty.Id = tblcourse.facultyId
            where date(DateTaken) between '$fromDate' and '$toDate' and tblattendance.cardId ='$cardId' and tblcourse.courseId = '$courseId'");          
        
            }
        }

        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

        ?>
                            <tr>   
                            <td><?php echo $cnt;?></td>
                            <td><?php  echo $row['matricNo'];?></td>
                            <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
                            <td><?php  echo $row['levelName'];?></td>
                            <td><?php  echo $row['courseTitle'];?></td>
                            <td><?php  echo $row['facultyName'];?></td>
                            <td><?php  echo $row['departmentName'];?></td>
                            <td><?php  echo date("h:i a", strtotime($row['CheckInTime']));?></td>
                            <?php 
                            if ($row['CheckOutTime'] != null) {
                            ?>
                            <td><?php  echo date("h:i a", strtotime($row['CheckOutTime']));?></td>
                            <?php } else{?>
                            <td></td>
                            <?php }?>
                            <td><?php  echo $row['DateTaken'];?></td>
                            <!-- <td><a href="studentDetails.php?editid=<?php echo $row['matricNo'];?>" title="View Full Details"><i class="fa fa-eye fa-1x"></i></a></td> -->
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
