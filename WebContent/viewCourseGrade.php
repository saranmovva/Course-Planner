<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Course Manager</title>
<link rel="stylesheet" href="css/bootstrap.css" > </link>
<script type="text/javascript" src="js/bootstrap.js"> </script>
<style>

*
+ {
	margin: 0px auto;
}

html,body {
	text-align: center;
}
</style>
</head>
<body>
	<br />
	<br />
	<br />
	<?php
		$servername = "localhost:3306";
		$username = "root";
		$password = "root";
		$db = "course_manager";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);

		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 

		$course_name = $_SESSION["view_course_grade"];
		$user_id = $_SESSION["user_id"];
		
		
		$result = $conn->query("SELECT * FROM course WHERE course_name = '" . $course_name . "'");

		$counter = mysqli_num_rows($result);
		
		if($counter > 0){
		$row = $result -> fetch_assoc();
		$course_id = $row['course_id'];
		
		
		$res = $conn->query("SELECT * FROM assignment WHERE user_id = '" . $user_id . "' AND course_id = '" . $course_id . "'");

		$count = mysqli_num_rows($res);
		
		
		if($count > 0){

			echo "<table class='table'>";
			echo "<tr style='background-color:white;'>";
			echo "<td>Assignment Name</td>";
			echo "<td>Weight Category</td>";
			echo "<td>Assignment Grade</td>";
			echo "</tr>";

			for($i = 0; $i < $count; $i++){
				$r = $res -> fetch_assoc();
				$assignment_type_id = $r['assignment_type_id'];
				$assignment_type = "";
				
				$re = $conn->query("SELECT * FROM assignment_type WHERE assignment_type_id = '" . $assignment_type_id . "'");

				$c = mysqli_num_rows($res);
				
				if($c > 0){
					$ro = $re -> fetch_assoc();
				
				
				
				echo "<tr style='background-color:white;'>";
				echo "<td>".$r['assignment_name']."</td>";
				echo "<td>". $ro['assignment_type'] ."</td>";
				echo "<td>".round($r['assignment_grade'], 2)."</td>";
				echo "</tr>";
				}
				
				
			}
			
				$res = $conn->query("SELECT * FROM assignment_type WHERE course_id = '" . $course_id . "'");

				$count = mysqli_num_rows($res);
				$grade = 0;
				if($count > 0){
					
					for($i = 0; $i < $count; $i++){
						$row = $res -> fetch_assoc();
						$assignment_type_id = $row['assignment_type_id'];
						$weight = $row['weight_percent'];
						$temp = 0;
						
						$re = $conn->query("SELECT * FROM assignment WHERE course_id = '" . $course_id . "' AND assignment_type_id = '" . $assignment_type_id . "'");

						$ct = mysqli_num_rows($re);
							
						if($ct > 0){
							$temp = 0;
							for($j = 0; $j < $ct; $j++){
					
								$rows = $re -> fetch_assoc();
								$assignment_grade = $rows['assignment_grade'];
								
								$temp = $temp + $assignment_grade;
							}
							
							$temp = $temp / $ct;
							$grade = $grade + ($temp * ($weight / 100));
						}
											
						
					}
					
					
						
						echo "<tr style='background-color:white;'>";
						echo "<td>"."</td>";
						echo "<td>Course Grade Total :</td>";
						echo "<td>". round($grade, 2) ."</td>";
						echo "</tr>";
				
				}
			echo "</table>";
		} else {
			echo "No assignments have been added for this course!";
		}
		}
		
	?>
	
	<br />
	<br />
	<div class="container" style="width: 15%">
	<button class="btn btn-info btn-block login" onclick="location.href = 'courseManager.php';">Home</button>
	</div>
</body>
</html>