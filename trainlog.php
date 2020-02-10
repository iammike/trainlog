<?php

require ('trainlog_includes.php');

connect_to_mysql();

echo "<table spacing=0 width=780>";

# Run Mileage
$sqlsum = "SELECT sum(dist) FROM ".$db_prefix."entry WHERE type=0";
$sumresult = mysql_query($sqlsum);
$sumresult = mysql_fetch_array($sumresult);
$my_sum = $sumresult[0];
$my_sum = floor(($my_sum) * 100 + .5) * .01;
echo "<tr><b>Running Mileage:</b> $my_sum miles | ";

# Bike Mileage
$sqlsum = "SELECT sum(dist) FROM ".$db_prefix."entry WHERE type=1";
$sumresult = mysql_query($sqlsum);
$sumresult = mysql_fetch_array($sumresult);
$my_sum = $sumresult[0];
$my_sum = floor(($my_sum) * 100 + .5) * .01;
echo "<b>Biking Mileage:</b> $my_sum miles<br><br></tr>";

# Top Row
echo "<tr><td><b>Date</b></td><td><b>Name</b></td><td align=center><b>Dist (mi)</b></td><td align=center><b>Time (m:s)</b></td><td align=center><b>Weight (lbs)</b></td><td><b>Notes</b></td>";
echo "</tr>";

# Grab array of all data
$sqldata = "SELECT * FROM ".$db_prefix."entry ORDER BY `uin` DESC";
$result = @mysql_query($sqldata);

# Grab each record, parse in to variables, display in table
while($row = mysql_fetch_array($result)) {
	$date = $row[1];
	$name = $row[2];
	$dist = $row[3];
	$time = $row[4];
	$weight = $row[5];
	$notes = $row[6];

	echo "<tr><td>$date</td><td>$name</td><td align=center>$dist</td><td align=center>$time</td><td align=center>$weight</td><td>$notes</td>";
	print "</tr>";
}

echo "</table>";

mysql_close();

echo "<p align=right><a href='http://www.iammike.org/index.php?loc=about_tl' target='_blank'>TrainLog v$version</a> by <a href='http://www.iammike.org' target='_blank'>Mike</a> | <a href='$adminpath'>Admin</a></p>";

?>
