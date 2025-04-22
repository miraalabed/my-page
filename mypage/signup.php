<!DOCTYPE html>
<html>
<head>
<title>signup</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>Create a new Account</h1>
	</header>
	<form method="post" action="signup.php">

		<div class="welcomeBack">
			<h2 style="color: whitesmoke;">Welcome again!</h2>
			<br>
			<h4 style="color: whitesmoke;">If you already have an account, please
				Sign in with your information...</h4>
			<br> <br>
			<button name="back" class="back">Signin!</button>
		</div>
		<div class="signup">
			<h2
				style="font-size: 22px; padding-left: 18%; padding-right: 18%; color: steelblue;">Create
				Account</h2>
			<br>
<?php 
// 1 connect to database
$c = mysqli_connect("localhost", "root", "12345678", "myproject");
$q2="select username from admin order by username asc;";
$x=mysqli_query($c, $q2);
$accounts=array();
$j=0;
while ($a=mysqli_fetch_assoc($x)) {
    $accounts[$j]=$a['username'];
    $j++;
    ;
}

?>
			<table>
				<tr>
					<td style="color: steelblue;">ACCOUNT: </td>
					<td ><select name="account">
					<?php 
					for ($i = 0; $i < sizeof($accounts); $i++) {
					    $n=$accounts[$i];
					    echo "<option>$n</option>";
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td style="color: steelblue;">BIRTHDAY:</td>
					<td><input style="box-shadow: 2px 2px 5px steelblue; color: grey; cursor: pointer;"
						type="date" name="birthday"
						value="<?php if(isset($_POST['birthday'])) echo $_POST['birthday'];?> "></td>
				</tr>
				<tr>
					<td colspan=2><input style="box-shadow: 2px 2px 5px steelblue;"
						type="text" name="name" style="width:250px" placeholder="USERNAME"
						value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"></td>
				</tr>
				<tr>
					<td colspan=2><input style="box-shadow: 2px 2px 5px steelblue;"
						type="password" name="pass" style="width:250px;"
						placeholder="PASSWORD"
						value="<?php if(isset($_POST['pass'])) echo $_POST['pass'];?>"></td>
				</tr>
				<tr>

				</tr>
				<tr>
					<td colspan=2><input style="box-shadow: 2px 2px 5px steelblue;"
						type="password" name="confirm" style="width:250px;"
						placeholder="CONFIRM PASSWORD"
						value="<?php if(isset($_POST['confirm'])) echo $_POST['confirm'];?>"></td>
				</tr>

			</table>
			<br>
			<button name="sign" class="sign" style="width: 100px;">Signup!</button>
			<br> <br>
		
<?php
date_default_timezone_set('Asia/Jerusalem');
if (isset($_POST['sign'])) {
    $bd = $_POST['birthday'];
    $name = $_POST['name'];
    $pass1 = $_POST['pass'];
    $pass2 = $_POST['confirm'];
if(!file_exists("users\\".$name)) mkdir("users\\".$name);
    if ($bd == null && $name == null && $pass1 == null && $pass2 == null) {
        echo "<h4>Enter your information</h4>";
    } else if ($bd == null)
        echo '<h4>Select your birthdate</h4>';
    else if ($name == null)
        echo '<h4>enter your username</h4>';
    else if ($pass1 == null)
        echo '<h4>enter your password</h4>';
    else if ($pass2 == null)
        echo '<h4>enter your confirm password</h4>';
    else if ($bd != null && $name != null && $pass1 != null && $pass2 != null) {
        $y = explode("-", $bd);
        $birthdays = ($y[0] * 365) + ($y[1] * 30) + $y[2];
        $bd2 = date("Y-m-d");
        $y2 = explode("-", $bd2);
        $todayindays = ($y2[0] * 365) + ($y2[1] * 30) + $y2[2];
        $age = floor(($todayindays - $birthdays) / 365);
        $bdbool = false;
        if ($age >= 18)
            $bdbool = true;

        $namebool = false;
        if (strlen($name) >= 8)
            $namebool = true;

        $passbool = false;
        if ($pass1 == $pass2)
            $passbool = true;
        echo "<h4>";
        if (! $bdbool)
            echo 'The user must be 18 or older!';
        else if (! $namebool)
            echo 'Username must be 8 letters at least!';
        else if (! $passbool)
            echo 'Password missmatch!';
        else {
            // 2 sql command
            $q = "INSERT INTO users (user_name, pass, bd, notification, username) 
VALUES ('$name', '$pass1', '$bd', 1, '$accounts');
";
           // $connect = mysqli_query($c, $q);
            if(mysqli_query($c, $q)){
                if (!file_exists("users\\".$name)) mkdir("users\\".$name);
                echo "<script> alert ('Welcome! Now, if you want to access your account, please log in from the Signin page'); window.location.href='signin.php';</script>";
            }
            else{
                echo 'The user already exists';
            }

        }
        echo "</h4>"; 
    }
}
if (isset($_POST['back'])) {
    header("location:signin.php");
}

?>
</div>
	</form>

</body>
<footer></footer>
</html>