<?php
    function valid($classNo, $Day, $classes_from, $to, $teacherId, $error)
    {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Edit Class Records</title>
	</head>
	<style type="text/css">
		td {
			padding: 20px;
			shape-outside: ellipse(2px);
			text-align: center;
			border-style: inherit;
			border-radius: 5%;
			border-width: 2px;
			border-color: white;
			background: transparent;
		}
		body {
			background-image: url(images/background6.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			height: 100%;
		}
		.form {
			align-content: center;
		}
		.edit {
			width: 40%;
			padding: 10px;
			background-color: brown;
			border-radius: 20%;
			color: white;
			font-size: 15px;
		}
		.edit:hover {
			background-color: black;
		}

	</style>
<body>
<?php

if ($error != '')
		{
		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
		}
		?>
		<br><br><br><br><br><br>
		<form class="form" action="" method="post">
		<input type="hidden" name="classNo" value="<?php echo $classNo; ?>"/>

		<center><table border="1" width="30%" >
		<tr>
		<td height="60" colspan="2" style="background-color: lightgreen"><b><font size="5px" color='black'>Edit Class Records </font></b></td>
		</tr>
		<tr>
		<td width="179"><b><font color='white'>Day<em>*</em></font></b></td>
		<td><label>
		<input  type="text" name="Day" value="<?php echo $Day; ?>" />
		</label></td>
		</tr>

		<tr>
		<td width="179"><b><font color='white'>from<em>*</em></font></b></td>
		<td><label>
		<input type="time" name="classes_from" value="<?php echo $classes_from; ?>" />
		</label></td>
		</tr>

		<tr>
		<td width="179"><b><font color='white'>to<em>*</em></font></b></td>
		<td><label>
		<input type="time" name="to" value="<?php echo $to; ?>" />
		</label></td>
		</tr>

		<tr>
		<td width="179"><b><font color='white'>Teacher ID<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="teacherId" value="<?php echo $teacherId; ?>" />
		</label></td>
		</tr>

		<tr align="Right">
		<td colspan="2"><label>
		<input class="edit" type="submit" name="submit" value="Edit Records">
		</label></td>
		</tr>
		</table>
	</center>
		</form>
		</body>
		</html>
		<?php
		}

		$dbhost = 'localhost';
		$dbuser = 'root';//change to ur mysql installed user
		$dbpass = '';//give mysql password of ur system
		$dbase = 'mydb';//give database name created in ur system

		   $db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbase);
		  // Check connection
		  if (mysqli_connect_errno())
		    {
		    echo "Failed to connect to MySQL: " . mysqli_connect_error();
		    }

		if (isset($_POST['submit']))
		{

		if (is_numeric($_POST['classNo']))
		{

		
		$classNo = $_POST['classNo'];
		$Day = mysqli_real_escape_string($db, $_POST['Day']);
		$classes_from = mysqli_real_escape_string($db, $_POST['classes_from']);
		$to = mysqli_real_escape_string($db, $_POST['to']);
		$teacherId = mysqli_real_escape_string($db, $_POST['teacherId']);


		if ($classNo == '' || $Day == '' || $classes_from == '' || $to == '' || $teacherId == '')
		{

		$error = 'ERROR: Please fill in all required fields!';


		valid($classNo,$Day,$classes_from,$to,$teacherId, $error);
		}
		else
		{

		mysqli_query($db, "UPDATE classdetails SET Day='$Day', classes_from='$classes_from', `to`='$to', teacherId='$teacherId' WHERE classNo='$classNo'")
		or die(mysqli_error($db));

		header("Location: ShowClass.php");
		}
		}
		else
		{

		echo 'Error!';
		}
		}
		else

		{

		if (isset($_GET['classNo']) && is_numeric($_GET['classNo']) && $_GET['classNo'] > 0)
		{

		$classNo = $_GET['classNo'];
		$result = mysqli_query($db,"SELECT * FROM classdetails WHERE classNo=$classNo")
		or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);

		if($row)
		{

		$Day = $row['Day'];
		$classes_from = $row['classes_from'];
		$to = $row['to'];
		$teacherId = $row['teacherId'];

		valid($classNo,$Day,$classes_from,$to,$teacherId, '');
		}
		else
		{
		echo "No results!";
		}
		}
		else

		{
		echo 'Error!';
		}
		}
?>