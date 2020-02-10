<?php

require ('trainlog_includes.php');

if ($_POST['to_do']){
	$to_do = $_POST['to_do'];
}
elseif ($_GET['to_do']){
	$to_do = $_GET['to_do'];
}
else {
	$to_do = "login";
}

if ($to_do != "process_login" AND $to_do != "logout"){
	admin_header();
	$q_admin_u = $_COOKIE[q_username];
	$q_admin_p = $_COOKIE[q_password];
}

switch ($to_do) {

	case "install":

	connect_to_mysql();
	$q_query = "CREATE TABLE IF NOT EXISTS ".$_POST[db_prefix]."entry (uin int(11) NOT NULL auto_increment, date text NOT NULL, name text NOT NULL, dist float NOT NULL default '0', time text NOT NULL, weight text NOT NULL, notes text NOT NULL, type text NOT NULL, KEY uin (uin)) TYPE=MyISAM"; 
	if(mysql_query("$q_query")){echo"Entry table successfully created.<br>";}else{echo"Error: Entry table not created.<br>";}

	mysql_close();

	break;

	case "delete_entry_process":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			connect_to_mysql();
			$result = mysql_query("DELETE FROM ".$db_prefix."entry WHERE uin='$_POST[entry_num]'") or die("Entry Deletion MySQL Error " . mysql_error());
			mysql_close();

			echo"<p align='center' class='title'>Entry Deleted</p>";

			echo"<p align='left' class='prose'>The entry has been successfully deleted.</p>";

		}
		else {
		admin_login_form();
		}

	break;

	case "delete_entry":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			connect_to_mysql();
			$result = mysql_fetch_array(mysql_query("SELECT * FROM ".$db_prefix."entry WHERE uin='$_GET[entry_num]'")) or die("Error: " . mysql_error());
			mysql_close();

			$short = substr($result[1], 0, 100);

			echo"<p align='center' class='title'>Delete Entry?</p>";

			echo"<p align='center' class='prose'>Are you certain you want to delete this <i>'$short'</i> entry?</p>";

			echo"<center><table width='50%' border='0' cellpadding='2' cellspacing='0'><tr>";
			echo"<form action='$_SERVER[PHP_SELF]' method='post'><td align='center'>";
			echo"<input type='hidden' name='to_do' value='delete_entry_process'>";
			echo"<input type='hidden' name='entry_num' value='$_GET[entry_num]'>";
			echo"<input type='submit' value='Yes, Delete'>";
			echo"</td></form><form action='$_SERVER[PHP_SELF]' method='post'><td align='center'>";
			echo"<input type='hidden' name='to_do' value='view_entry'>";
			echo"<input type='submit' value='No, Cancel'>";
			echo"</td></form></tr></table></center>";

		}
		else {
		admin_login_form();
		}

	break;

	case "edit_entry_process":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			connect_to_mysql();
			if(!mysql_query("UPDATE ".$db_prefix."entry SET date='$_POST[my_date]', name='$_POST[my_name]', dist='$_POST[my_distance]', time='$_POST[my_time]', weight='$_POST[my_weight]', notes='$_POST[my_notes]', type='$_POST[my_type]' WHERE uin='$_POST[entry_num]'")) die("Updating Entry Data MySQL Error " . mysql_error());
			mysql_close();

			echo"<p align='center' class='title'>Entry Edited</p>";

			echo"<p align='left' class='prose'>Your entry has been edited.</p>";
		}
		else {
		admin_login_form();
		}

	break;

	case "edit_entry":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			echo"<p align='center' class='title'>Edit Entry</p>";

			echo"<p align='left' class='prose'>Make the appropriate changes, then click the 'Edit Entry' button to edit this entry.</p>";

			connect_to_mysql();
			$result = mysql_fetch_array(mysql_query("SELECT * FROM ".$db_prefix."entry WHERE uin='$_GET[entry_num];'")) or die("Edit Entry MySQL Data Retrieval Error. " . mysql_error());

			echo"<p align='left' class='prose'>";
			echo"<form action='$_SERVER[PHP_SELF]' method='post' class=prose>";
			echo"<input type='hidden' name='entry_num' value='$_GET[entry_num];'>";
			echo"<input type='hidden' name='to_do' value='edit_entry_process'>";
			echo"Date: <input name='my_date' class=textfield value='$result[1]'><br>";
			echo"Name: <input name='my_name' class=textfield value='$result[2]'><br>";
			echo"Distance (miles): <input name='my_distance' class=textfield value='$result[3]'><br>";
			echo"Time: <input name='my_time' class=textfield value='$result[4]'><br>";
			echo"Weight: <input name='my_weight' class=textfield value='$result[5]'><br>";
			echo"Note: <input name='my_notes' class=textfield size=50 value='$result[6]'><br>";
			if($result[7]=="0")
				echo"Type:  <input type='radio' name='my_type' value='0' checked> Run<input type='radio' name='my_type' value='1'> Bike<br><br>";
			else
				echo"Type:  <input type='radio' name='my_type' value='0'> Run<input type='radio' name='my_type' value='1' checked> Bike<br><br>";
			echo"<input type='submit' value='Edit Entry'>";
			echo"</form>";
			echo"</p>";


		}
		else {
		admin_login_form();
		}

	break;

	case "view_entry":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			echo"<center><font class='title'>View/Edit/Delete Entries</font></center><br>";

			echo"<table width='100%' border='1' bordercolor='#000000' cellspacing='0' cellpadding='2'>";
			echo"<tr bgcolor='#EEEEEE'><td class='prose'><b>Entry</b></td><td class='prose'><b>Tools</b></td></tr>";
			
			connect_to_mysql();
			$result = mysql_query("SELECT * FROM ".$db_prefix."entry ORDER BY `uin` ASC") or die("Entry List Retrieval MySQL Error. " . mysql_error());
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$short = substr($row[1], 0, 100);
				echo"<tr><td class='prose'>$short</td><td class='prose'><a href='$_SERVER[PHP_SELF]?to_do=edit_entry&entry_num=$row[0]'>Edit</a> | <a href='$_SERVER[PHP_SELF]?to_do=delete_entry&entry_num=$row[0]'>Delete</a></td></tr>";
			}
			mysql_close();

			echo"</table>";

		}
		else {
		admin_login_form();
		}

	break;

	case "new_entry_process":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			connect_to_mysql();
			if(!mysql_query("INSERT INTO ".$db_prefix."entry VALUES('','$_POST[new_date]','$_POST[new_name]','$_POST[new_dist]','$_POST[new_time]','$_POST[new_weight]','$_POST[new_note]','$_POST[new_type]')")) die("Error: " . mysql_error());
			mysql_close();

			echo"<p align='center' class='title'>Entry Added</p>";

			echo"<p align='left' class='prose'>Your entry has been added to the database.</p>";

		}
		else {
		admin_login_form();
		}

	break;

	case "new_entry":

		if (admin_login_check($q_admin_u,$q_admin_p)){
			admin_links();

			echo"<p align='center' class='title'>Add New Entry</p>";

			echo"<p align='left' class='prose'>Please complete the form below to add a new entry:</p>";

			echo"<p align='left' class='prose'>";
			echo"<form class ='prose' action='$_SERVER[PHP_SELF]' method='post'>";
			echo"<input type='hidden' name='to_do' value='new_entry_process'>";
			echo"Date: <input name='new_date' class=textfield><br>";
			echo"Name: <input name='new_name' class=textfield><br>";
			echo"Distance: <input name='new_dist' class=textfield><br>";
			echo"Time: <input name='new_time' class=textfield><br>";
			echo"Weight: <input name='new_weight' class=textfield><br>";
			echo"Note: <input name='new_note' class=textfield><br>";
			echo"Type:  <input type='radio' name='new_type' value='0'> Run<input type='radio' name='new_type' value='1'> Bike<br><br>";
			echo"<input type='submit' value='Add New Entry'>";
			echo"</form>";
			echo"</p>";

		}
		else {
		admin_login_form();
		}

	break;

	case "logout":

		setcookie("q_username", NULL, time()-86400, "/", ".$site_domain", 0);
		$_COOKIE["q_username"] = NULL;

		setcookie("q_password", NULL, time()-86400, "/", ".$site_domain", 0);
		$_COOKIE["q_password"] = NULL;

		admin_header();

		echo"<font class='prose'>You are now logged out of the TrainLog admin area.";

	break;

	case "process_login":

		$_POST['q_admin_p'] = md5($_POST['q_admin_p']);

		if (admin_login_check($_POST['q_admin_u'],$_POST['q_admin_p'])){

			setcookie("q_username", $_POST['q_admin_u'], time()+60*60*24*365, "/", ".$site_domain", 0);
			$_COOKIE["q_username"] = $_POST['q_admin_u'];

			setcookie("q_password", $_POST['q_admin_p'], time()+60*60*24*365, "/", ".$site_domain", 0);
			$_COOKIE["q_password"] = $_POST['q_admin_p'];

			admin_header();

			admin_links();

			echo"<p align='left' class='prose'>You have now successfully logged in to the admin area. Cookies have been sent on your computer which will keep you logged in, until you <a href='$_SERVER[PHP_SELF]?to_do=logout'>log out</a>.</p>";
		}
		else {
		admin_login_form();
		}
	break;

	case "login":

	admin_login_form();

	break;

}

admin_footer();

?>
