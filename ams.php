<?php
	
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = '';
	$mysql_database = 'attendancemgtsys';
	
	// $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_database)or die('Cannot open database');	
	// $con=mysqli_connect("localhost", "133484", "olanrewaju", "133484");
	$conn=mysqli_connect("localhost", "187783", "attendance", "187783");
	 
	if($conn->connect_error){
		die("Connection Failed: ".$conn->connect_error);
	}
	
	if (isset($_GET['x'])) {
 
		$userData= $_GET['x'];
		$data = explode('-',$userData);
		$courseId = $data[0];
		$cardId = $data[1];


		// $checkIn = date('H:m:d', time()+3600);  
		// $dateIn = date('Y-m-d', time()+3600);

		date_default_timezone_set("Africa/Lagos"); // Added a TimeZone for Africa/Lagos
		$checkInOut = date('H:i:s'); // I updated this code for time and date
		$dateIn = date('Y-m-d');
		//echo ' UserID: '.$userId.' TIME: '.$checkIn. ' DATE: '.$dateIn ;

		$qq= mysqli_query($conn,"select * from tblstudent where cardId = '$cardId'");
		$row = mysqli_fetch_array($qq);
		$count = mysqli_num_rows($qq);
		
		if($count > 0){ //check if data exist


				$querys = mysqli_query($conn,"select * from tblattendance where cardId='$cardId' && courseId='$courseId' && DateTaken='$dateIn' && CheckOutTime =''");
				$rets = mysqli_fetch_array($querys);
				if($rets > 0){

					$rett=mysqli_query($conn,"update tblattendance set CheckOutTime ='$checkInOut' where cardId='$cardId' && courseId='$courseId' && DateTaken='$dateIn' && CheckOutTime =''");
					echo "Check Out Time was Taken Successfully!";

				}

				else{
				
						$query = "INSERT INTO tblattendance(courseId, cardId, CheckInTime, CheckOutTime, DateTaken)VALUES ('$courseId', '$cardId','$checkInOut', '', '$dateIn')";
						if(mysqli_query($conn, $query)){

							echo "New Attendace record was taken successfully!";

						}
						else{
							echo "Error".$query."".mysqli_error($conn);
						}
				}
		} //end of if isset($_GET['x'])

			else{
				echo 'Student with the Card ID does not exist!';
			}
	}
	else{
		echo 'Please insert parameters';
	}
	//$conn->close();
	mysqli_close($conn);
	
?>