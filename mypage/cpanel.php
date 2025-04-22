<html>
<head>
<title>cpanel</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
header {
	text-align: center;
	background-color: steelblue;
	color: ghostwhite;
	padding: 0.5%;
}
.list {
	border: none;
	cursor: pointer;
	position: absolute;
	top: 8%;
	right: 2%;
}

.list:hover {
	color: white;
}

.op {
	background-color: steelblue;
	width: 10.2%;
	color: white;
	border-radius: 5px;
	position: absolute;
	top: 12%;
	right: 3%;
	text-align: center;
	display: none;
}

.op button {
	background-color: steelblue;
	width: 100%;
	color: white;
	border-radius: 0%;
		box-shadow: none;

	padding: 2%;
}

.op button:hover {
	background-color: rgb(58, 109, 152);
	border-radius: 0%;
		box-shadow: none;

}
table{
width : 100%;
}
td {
	border: 1px solid steelblue;
	padding-bottom: 0%;
	height : 1%;
	text-align: center;  
    vertical-align: middle;
}
.d{
position: absolute;
	top: 18%;
	left: 1%;
	width : 80%;
}
input{
width : 100%;
height : 100%;
}
</style>
<form method="post" action="cpanel.php">
	<header>
	
	<div class="list" id="bars" onclick="show()">
			<br><i class="fa fa-bars" aria-hidden="true"></i>
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
	<div class="op" id="options">

		
		<button name="logout">
			<i style="font-size: 20px" class="fa" aria-hidden="true">&#xf08b;</i>
		</button>
		<br> 
	</div>

	<h1>Users Information</h1>
</header>
<br>
<br>





<?php
$c = mysqli_connect("localhost", "root", "12345678", "myproject");
$q = "SELECT * FROM users order by user_name ASC;";
$x = mysqli_query($c, $q);
$data = array(
    array()
);
$count = 0;
while ($a = mysqli_fetch_assoc($x)) {
    if ($a['notifications'] == 1)
        $count ++;
    $data[] = $a;
}
echo "<div class='d'>";
echo "<table>";
echo "<tr>
<td style='background-color: steelblue; width:1%;'>DELETE</td>
<td style='background-color: steelblue; width:3%;'>NUMBER</td>
<td style='background-color: steelblue; width : 5%;'>USERNAME</td>
<td style='background-color: steelblue; width : 5%;'>PASSWORD</td>
<td style='background-color: steelblue; width : 5%;'>BIRTHDATE</td>
</tr>";

foreach ($data as $columns) {
    if ($columns['num'] != "") {
        $name =  $columns['user_name'];
        $pass =  $columns['pass'];
        $bd = $columns['bd'] ;
        $num = $columns['num'];
        echo "<tr>";
        echo "<td style='width:1%;'><input style='background-color: white; border: none;' type='submit' name='$num' value='x'></td>";
        if (isset($_POST[$num])){
            
            $q2="delete from users where num=$num;";
            mysqli_query($c,$q2);
            header("location:cpanel.php");
        }
        if ($columns['notifications'] == 0) {
            echo "<td style='width:3%;'> ". $columns['num'] . "</td>";
            echo "<td style='width:5%;'><input type='text' value='$name' name='name_$num'></td>";
            echo "<td style='width:5%;'><input type='text' value='$pass' name='pass_$num'></td>";
            echo "<td style='width:5%;'><input type='date' value='$bd' name='bd_$num'></td>";
        } else {
            echo "<td style='color:steelblue; width:3%;'>" . $columns['num'] . "</td>";
            echo "<td style='color:steelblue; width:5%;'><input type='text' value='$name' name='name_$num'></td>";
            echo "<td style='color:steelblue; width:5%;'><input type='text' value='$pass' name='pass_$num'></td>";
            echo "<td style='color:steelblue; width:5%;'><input type='date' value='$bd' name='bd_$num'></td>";
        }
        echo "</tr>";
    }
}
echo "</table>";
if (isset($_POST['update'])) {
    foreach ($data as $columns) {
        if (!empty($columns['num'])) {
            $num = $columns['num'];
            $newname = $_POST['name_' . $num];
            $newpass = $_POST['pass_' . $num];
            $newbd = $_POST['bd_' . $num];
            $q3 = "UPDATE users SET name='$newname', pass='$newpass', bd='$newbd' WHERE num='$num';";
            mysqli_query($c, $q3);
        }
    }
    header("Location: cpanel.php");
}
if (isset($_POST['seen'])) {
    $q2 = "UPDATE users set notifications=0 WHERE notifications=1;";
    mysqli_query($c, $q2);
}
if ($count != 0) {
    echo "<h3 style='color:steelblue;'>You have " . $count . " new users</h3>";
}
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("location:Admin.php");
}


?>

		<br><button name="update">Updaete</button>
		<button name="seen">Notifiction</button>
		
<?php echo "</div>";?>

	</form>



</html>