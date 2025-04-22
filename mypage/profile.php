<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>user's profile</title>
<link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
$myname = $_SESSION['username'];
$connect = mysqli_connect("localhost", "root", "12345678", "myproject");
$q = "SELECT * FROM users WHERE user_name = '$myname';";
$c = mysqli_query($connect, $q);
$temp = mysqli_fetch_assoc($c);
$pass = $temp['pass'];
$birthday = $temp['bd'];
$pics = array(
    ".png",
    '.jpg',
    '.jfif',
    '.jpeg'
);
$imgfullname="users\\".$myname."\\profile.".$pics;
?>

<form method="post" action="profile.php">
	<header>
	
	<div class="list" id="bars" onclick="show()">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>
		<script>
	var x=true;
	function show(){
	if(x){
	document.getElementById("bars").style.color="rgb(58, 109, 152)";
	document.getElementById("options").style.display="inline";
	x=false;
	}else{
	document.getElementById("bars").style.color="white";
	document.getElementById("options").style.display="none";
	x=true;
	}
	}
	</script>
		<h1>Welcome</h1>
	</header>
	

<?php
if (isset($_POST['show'])) {
    echo "<div style='width: 12%; background-color: steelblue; color : white ;text-align: center; border : 1px solid steelblue; position: absolute; top: 16%; left: 10%;'>";
    echo "> INFORMATION < <br>";
    echo " Name : " . $myname;
    echo " <br>Password : " . $pass;
    echo " <br>BirthDate : " . $birthday;
    echo "</div>";
}
if (isset($_POST['edit'])) {
    echo "<div class='edit' style='width: 20%; hight: 35%; color : white ;text-align: center; border : 1px solid steelblue; position: absolute; top: 16%; left: 10%;'>";
    echo "<br><input style='box-shadow: 2px 2px 5px steelblue; width: 90%; color: black; cursor: pointer;'
    type='text' name='name' value='$myname'><br><br>";
    echo "<input style='box-shadow: 2px 2px 5px steelblue; width: 90%; color: black; cursor: pointer;'
    type='password' name='pass' value='$pass'><br><br>";
    echo "<input style='box-shadow: 2px 2px 5px steelblue; width: 90%; color: black; cursor: pointer;'
    type='date' name='birthdate' value='$birthday'><br><br>";
    echo '<input style="box-shadow: 2px 2px 5px steelblue;background-color: steelblue; border : none; width: 90%; color: black; cursor: pointer;"
    type="submit" name="update" value="UPDATE"><br><br>';
    echo "</div>";
    
    
}
if (isset($_POST['update'])) {
    session_start();
    session_destroy();
    $newName = $_POST['name'];
    $newPass = $_POST['pass'];
    $newBirth = $_POST['birthdate'];
    $q2 = "update users set name='$newName', pass='$newPass', bd='$newBirth' WHERE name = '$myname' ;";
    mysqli_query($connect, $q2);
    rename($myname, $newName);
    echo "<script> alert('Your account has been updated.'); window.location.href='signin.php';</script>";
}
if (isset($_POST['change'])) {

    header("location:change.php");
}
if (isset($_POST['delete'])) {
    session_start();
    $myname = $_SESSION['username'];      
    $q2 = "DELETE FROM users WHERE name = '$myname';";
    mysqli_query($connect, $q2);
    rmdir($myname); 
    session_destroy();
    echo "<script> alert('Your account has been deleted.'); window.location.href='signin.php';</script>";
}
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("location:signin.php");
}
?>
<div class="op" id="options">
		<br>
		<button name="show">Show Information</button>
		<br>
		<button name="edit">Edit Information</button>
		<br>
		<button name="change">Change picture</button>
		<br>
		<button name="delete" onclick="return confirmDelete()">Delete Account</button>
		<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete your account?');
}
</script>
		<hr>
		<button name="logout">
			<i style="font-size: 20px" class="fa" aria-hidden="true">&#xf08b;</i>
		</button>
		<br> <br>

	</div>



	<div class="side">
		<h3> <?php echo $myname?> </h3>
		<img  src="<?php echo $imgfullname; ?>" style="border-radius:100%;width:100px;">
	</div>
</form>



<body>
<?php

date_default_timezone_set('Asia/Jerusalem');
$today = date("y-m-d");
$todayarray = explode("-", $today);
$todayindays = ($todayarray[1] * 30) + $todayarray[2];

$bdarray = explode("-", $birthday);
$bdindayas = ($bdarray[1] * 30) + $bdarray[2];

if ($todayindays - $bdindayas == 0) {
    echo '<img style="width:17%; height:3%; padding-left:42%; padding-top:0.5%;" src="birthday.jpg">';
}
?>

</body>
<footer> </footer>
</html>
