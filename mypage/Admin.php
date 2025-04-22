
<html>
<head>
<title>AdminLogin</title>
<link rel="stylesheet" href="style.css">
</head>
<header>
	<h1>Admin Login</h1>
</header><br><br>
<form method="post" action="Admin.php">
<div class="input" style="position: absolute;
	top: 36%;
	left: 39%;">
	
<br>

			<div>
				<img style="width: 8%;" src="user.png">
				 <input  type="text" name="username" placeholder="USERNAME">
			</div>
			<br>
			<div>
				<img style="width: 7%;" src="pass.png"> 
<input  type="password" name="pass" placeholder="PASSWORD">
			</div>
<br><br>
			<?php echo "<span style='color:white;'>-------------</span>";?><button name="ok">LOGIN</button><h1></h1><br>
		</div>
		</form>

<?php
if (isset($_POST['ok'])) {
    $nameenterd = $_POST['username'];
    $passenterd = $_POST['pass'];
    $connect = mysqli_connect("localhost", "root", "12345678", "myproject");
    $q = "SELECT * FROM admin WHERE username='$nameenterd';";
    $x = mysqli_query($connect, $q);
    while ($a = mysqli_fetch_assoc($x)) {
        $namefromdatabase = $a['username'];
        $passfromdatabase = $a['USER_password'];
    }
    if ($nameenterd != $namefromdatabase)
        echo "Username does not exist";
    elseif ($passenterd != $passfromdatabase)
        echo "Wrong password";
    else {
        header("location:cpanel.php");
    }
}

?>

