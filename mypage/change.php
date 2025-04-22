<!DOCTYPE html>
<html>
<head>
<title>Change picture</title>
<link rel="stylesheet" href="styleSignin.css">
</head>
<header>
	<h1>Change your profile picture</h1>
</header>
<body>
<?php 
echo '<br> upload your profile picture <br><br> ';

?>

	<form method="post" action="change.php" enctype="multipart/form-data">
		<input type="file" name="myfile"><br>
		<br> <input type="submit" name="ok" value="OK">
<?php
session_start();
$myname = $_SESSION['username'];

$pics = array(
    ".png",
    '.jpg',
    '.jfif',
    '.jpeg'
);
if (isset($_POST['ok'])) {
    $info = $_FILES['myfile'];
    for ($i = 0; $i < sizeof($pics); $i ++) {
        if (file_exists($myname . "\\profile." . $info[$i])) {
            unlink($myname . "\\profile." . $info[$i]);
        }
    }
    $name = $info['name'];
    $tmpname = $info['tmp_name'];
    $namearray = explode(".", $name);
    $ext = $namearray[1];
    $newname = $myname . "\\profile." . $ext;
    if (move_uploaded_file($tmpname, $newname)) {
        echo "done";
    }
}
?>
</form>
</body>

</html>