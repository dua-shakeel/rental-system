<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<?php
	$database_host = "39.46.198.172";
	$database_user = "DESKTOP-IPPHTT1\cp";
	$database_pass = "";
	$database_name = "CAR_RENTAL";
	$connection = mysqli_connect($database_host, $database_user, $database_pass, $database_name);
	if(mysqli_connect_errno()){
		die("Failed connecting to MySQL database. Invalid credentials" . mysqli_connect_error(). "(" .mysqli_connect_errno(). ")" ); }
	$res="select Owner_id,rental.Ctype AS Category,SUM(rental.Nodays*rates.Drate+ rental.Noweeks*rates.Wrate) AS Earnings
FROM rental, rates ,owns
where rental.Ctype=rates.Ctype and rental.Vehicle_id=owns.Vehicle_id
group by Owner_id";
	$result=mysqli_query($connection,$res);
	echo "<h1><center>Profits according to car types</h1><br><br>";	
?>
<center>
<table border='1'>
<tr>
<th>Owner id</th>
<th>Category</th>
<th>Earnings</th>
</tr>
<?php
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>" . $row["Owner_id"] . "</td>";
echo "<td>" . $row["Category"] . "</td>";
echo "<td>" . $row["Earnings"] . "</td>";
echo "</tr>";
}
}
?>
</table>
</body>
</html>