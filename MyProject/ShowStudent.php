<!DOCTYPE html>
<html>

	<head>
		<style>
			table, th, td {
    			border: 1px solid black;
    			 padding: 15px;
    			 border-color: grey;
    			 border-width: 3px;
    			 font-family: monospace;

    			 
			}
			table {
				text-align: center;
				width: 70%;
				background-color: lightgreen;
			}
			.head {
				padding: 10px;
				background-color: grey;
				font-size: 20px;
			}
			body {
				background-image: url(images/background8.png);
			}
			button {
				
				border: none;
			    outline: none;
			    height: 40px;
			    background: brown;
			    color:#fff;
			    font-size: 18px;
			    border-radius: 100px;
			    width: 10%;
			}
			button:hover {
				cursor: pointer;
			    background: black;
			}
		</style>
	</head>

<body><center>
	
	<div class="head">
		<h1>Student Details</h1>
	</div>
	<br>
	


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM studentdetails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Student Id</th><th>Email</th><th>Gender</th><th>Date of Birth</th><th>Place</th><th>Teacher Id</th><th></th><th></th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"]. "</td><td>" . $row["studentId"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["gender"]. "</td><td>" .$row["DOB"]. "</td><td>" . $row["place"]. "</td><td>" . $row["teacherId"]. '<td><b><font color="#663300"><a href="editStudent.php?studentId=' . $row["studentId"] . '">Edit</a></font></b></td>' . '<td><b><font color="#663300"><a href="deleteStudent.php?studentId=' . $row["studentId"] . '">Delete</a></font></b></td></tr>' ;
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<br><br>
<button onclick="window.location.href='StudentDetails.php'">Add Student</button>

</center>

</body>
</html>