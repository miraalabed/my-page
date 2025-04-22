<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<h1>Login to your Account</h1>
	</header>

	<div class="p">
		<h2 style="color: steelblue;">Hello, there</h2>
		<p>Login to your account, see what is happening around you, share your
			news tou your friends, and enjoy your experience !!</p>
		<p>If you do not have an account, please signup ...</p>
	</div>

	<div class="input">
		<form method="post" action="signin.php">



			<div>
				<img style="width: 8%;" src="user.png"> <input type="text"
					name="username" placeholder="USERNAME"
					value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>">
			</div>
			<br>
			<div>
				<img style="width: 7%;" src="pass.png"> <input type="password"
					name="pass" placeholder="PASSWORD"
					value="<?php if(isset($_COOKIE['pass'])) echo $_COOKIE['pass'];?>">
			</div>
			<input type="checkbox" name="remember" checked>remember me <br> <br>
			<button name="log">LOGIN</button>
			<button name="sign">SIGNUP</button>
		</form>
<?php

if (isset($_POST['log'])) {
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    $remember = $_POST['remember'];
    $connect = mysqli_connect("localhost", "root", "12345678", "myproject");
    $q = "SELECT user_name, pass FROM users WHERE user_name='$user';";
    $c = mysqli_query($connect, $q);
    while ($temp = mysqli_fetch_assoc($c)) {
        $name = $temp['user_name'];
        $p = $temp['pass'];
    }
    if (empty($user) && empty($pass)) {
        echo '<h4>enter your username and password</h4>';
    } else if (! empty($user) && empty($pass)) {
        echo '<h4>enter your password</h4>';
    } else if (empty($user) && ! empty($pass)) {
        echo '<h4>enter your username</h4>';
    } else if (! empty($user) && ! empty($pass)) {
        if ($user != $name) {
            echo '<h4>username does not exist!</h4>';
        } elseif ($pass != $p) {
            echo '<h4>Password is wrong!</h4>';
        } else {
            if ($remember) {
                setcookie("username", $user, time() + 50000000);
                setcookie("pass", $pass, time() + 50000000);
            } else {
                setcookie("username", "");
                setcookie("pass", "");
            }
            session_start();
            $_SESSION['username'] = $user;
            header("location:profile.php");
        }
    }
}

if (isset($_POST['sign'])) {
    header("location:signup.php");
}

?>

</div>
	<footer></footer>

</body>
</html>