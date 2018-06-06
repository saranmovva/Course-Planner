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
* {
	margin: 0px auto;
}

html,body {
	text-align: center;
}
</style>
</head>
<body>
	<br /><br /><br />

	<div class="container" style="width: 15%">
	<button class="btn btn-info btn-block login" onclick="location.href = 'newCourse.php';">Add Course</button>
	</div>
	<br /><br />
	<div class="container" style="width: 15%">
	<button class="btn btn-info btn-block login" onclick="location.href = 'selectCourse.php';">Add Assignment</button>
	</div>
	<br /><br />
	<div class="container" style="width: 15%">
	<button class="btn btn-info btn-block login" onclick="location.href = 'selectCourseGrade.php';">View Course
		Grade</button>
	</div>
	<br /><br />
	<div class="container" style="width: 15%">
	<button class="btn btn-info btn-block login" onclick="location.href = 'index.php';">Log Out</button>
	</div>






</body>
</html>
