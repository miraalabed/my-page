<?php
$c = new mysqli("localhost","root","12345678","myproject");
$q="CREATE TABLE IF NOT EXISTS users (
    num INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(20),
    bd DATE,
    pass VARCHAR(20),
    notification BIT,
    username VARCHAR(20),
    FOREIGN KEY (username) REFERENCES admin(username)
);";
$q2="CREATE TABLE IF NOT EXISTS admin (
    username VARCHAR(20) PRIMARY KEY,
    USER_password VARCHAR(20)
);
";
$q3="insert into admin VALUES('facebook','111');";
$q4="insert into admin VALUES('insta','000');";
mysqli_query($c, $q);
mysqli_query($c, $q2);
mysqli_query($c, $q3);
mysqli_query($c, $q4);

?>