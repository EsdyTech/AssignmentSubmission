
<?php

$query = mysqli_query($con,"select * from tblstudent where matricNo='$matricNo'");
$row = mysqli_fetch_array($query);
$staffFullName = $row['firstName'].' '.$row['lastName'];
$levelId = $row['levelId'];

$que = mysqli_query($con,"select * from tbllevel where Id='$levelId'");
$rows = mysqli_fetch_array($que);
$levelName = $rows['levelName'];
?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">STUDENT (Level: <?php echo $levelName;?>)&nbsp;&nbsp;&nbsp;<br><?php echo $staffFullName;?></li>
                   
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Courses</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-eye"></i><a href="viewStudentCourses.php">View Courses</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-group"></i>Assignments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-eye"></i><a href="viewAssignments.php">View Assignments</a></li>
                            <li><i class="fa fa-eye"></i><a href="viewSubmittedAssignments.php">All Submitted Assignments</a></li>
                        </ul>
                    </li>
                   
                    <!-- <li class="menu-title">Attendance</li>/.menu-title -->
                   <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-calendar"></i>Attendance</a>
                        <ul class="sub-menu children dropdown-menu"> -->
                            <!-- <li><i class="fa fa-calendar"></i><a href="allAttendanceRecord.php">All Attendance</a></li> -->
                            <!-- <li><i class="fa fa-calendar"></i><a href="todaysAttendanceRecord.php">Today's Attendance</a></li> -->
                            <!-- <li><i class="fa fa-calendar"></i><a href="courseAttendanceRecord.php">Course Attendance</a></li>
                            <li><i class="fa fa-calendar"></i><a href="studentAttendanceRecord.php">Student Attendance</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="menu-title">Profile</li>/.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="changePassword.php">Change Password</a></li>
                            <li><i class="menu-icon fa fa-user"></i><a href="updateProfile.php">Update Profile</a></li>
                            </li>
                        </ul>
                         <li>
                        <a href="logout.php"> <i class="menu-icon fa fa-close"></i>Logout </a>
                    </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>