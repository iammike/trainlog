<?php

require('trainlog_includes.php');

if ($_POST['step']){
	$step = $_POST['step'];
} elseif ($_GET['step']){
	$step = $_GET['step'];
} else {
	$step = "1";
}

switch ($step) {

	case "1":

		admin_header();

		echo"<p align='center' class='title'>TrainLog Installer</p>";

		echo"<p align='left' class='prose'>Welcome to the TrainLog Installer. In a few short steps, this script (<i>trainlog_install.php</i>) will have the TrainLog script completely set up for you.";

		echo"<p align='left' class='prose'><font class='smalltitle'>Step 1:</font><br />Please enter your desired username and password for logging in to the admin area (you can change these later).</p>";

		echo"<center><table class='settings_table' width='80%' border='0' cellspacing='0' cellpadding='2'>";
		echo"<form action='$_SERVER[PHP_SELF]' method='post'><input type='hidden' name='step' value='2'>";
		echo"<tr><td align='left' class='settings_cell_normal'>Username</td><td align='left' class='settings_cell_normal'><input type='text' size='20' maxlength='255' name='admin_username' value=''></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Password</td><td align='left' class='settings_cell_normal'><input type='password' size='20' maxlength='255' name='admin_password' value=''></td></tr>";
		echo"<tr><td align='left' colspan='2' class='settings_cell_last'><input type='submit' value='Continue'></td></tr>";
		echo"</form></table></center><br /><br />";

		admin_footer();

	break;

	case "2":

		admin_header();

		echo"<p align='center' class='title'>TrainLog Installer</p>";

		if (!$_POST[admin_username]){
			echo"<p align='left' class='prose'>Sorry, you did not specify an admin username. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[admin_password]){
			echo"<p align='left' class='prose'>Sorry, you did not specify an admin password. Please go back and try again.</p>"; admin_footer(); exit;
		}

		echo"<p align='left' class='prose'>Welcome to the TrainLog installer. In a few short steps, this script (<i>trainglog_install.php</i>) will have the TrainLog script completely set up for you.";

		echo"<p align='left' class='prose'><font class='smalltitle'>Step 2:</font><br />Now enter the domain name fo your website, and your MySQL database information:</p>";

		echo"<center><table class='settings_table' width='80%' border='0' cellspacing='0' cellpadding='2'>";
		echo"<form action='$_SERVER[PHP_SELF]' method='post'><input type='hidden' name='step' value='3'>";
		echo"<input type='hidden' name='admin_username' value='$_POST[admin_username]'><input type='hidden' name='admin_password' value='$_POST[admin_password]'>";
		echo"<tr><td align='left' class='settings_cell_normal'>Website Domain <font class='smallprint'>(Examples: iammike.org, google.com)</font></td><td align='left' class='settings_cell_normal'><input type='text' size='20' name='site_domain'></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Database Location</td><td align='left' class='settings_cell_normal'><input type='text' size='20' name='db_location' value='localhost'></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Database Username</td><td align='left' class='settings_cell_normal'><input type='text' size='20' name='db_username'></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Database Password</td><td align='left' class='settings_cell_normal'><input type='password' size='20' name='db_password'></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Database Name</td><td align='left' class='settings_cell_normal'><input type='text' size='20' name='db_database'></td></tr>";
		echo"<tr><td align='left' class='settings_cell_normal'>Database Prefix</td><td align='left' class='settings_cell_normal'><input type='text' size='20' name='db_prefix' value='trainlog_'></td></tr>";
		echo"<tr><td align='left' colspan='2' class='settings_cell_last'><input type='submit' value='Continue'></td></tr>";
		echo"</form></table></center><br /><br />";

		admin_footer();

	break;

	case "3":

		admin_header();

		if (!$_POST[admin_username]){
			echo"<p align='left' class='prose'>Sorry, your admin username provided in step 1 was not specified in your last form post. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[admin_password]){
			echo"<p align='left' class='prose'>Sorry, your admin password provided in step 1 was not specified in your last form post. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[site_domain]){
			echo"<p align='left' class='prose'>Sorry, you did not specify the domain name of your website. If you do not have a domain name and are hosted on a static IP address, enter the static IP address.</p>"; admin_footer(); exit;
		}
		if (!$_POST[db_location]){
			echo"<p align='left' class='prose'>Sorry, you did not specify the location of your MySQL database. If you do not know this, try entering <i>localhost</i>. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[db_username]){
			echo"<p align='left' class='prose'>Sorry, you did not specify the username for your MySQL database. If you do not know this, try entering the username you use for FTP. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[db_password]){
			echo"<p align='left' class='prose'>Sorry, you did not specify the password for your MySQL database. Please go back and try again.</p>"; admin_footer(); exit;
		}
		if (!$_POST[db_database]){
			echo"<p align='left' class='prose'>Sorry, you did not specify the name of your MySQL database. Please go back and try again.</p>"; admin_footer(); exit;
		}

		$new_entry = "<?php\n\n\$db_location = \"$_POST[db_location]\";\n\$db_username = \"$_POST[db_username]\";\n\$db_password = \"$_POST[db_password]\";\n\$db_database = \"$_POST[db_database]\";\n\$db_prefix = \"$_POST[db_prefix]\";";
		$new_entry = $new_entry . "\n\n\$site_domain = \"$_POST[site_domain]\";\n\$fontface = \"Verdana,Arial,Sans-Serif\";";
		$new_entry = $new_entry . "\n\n\$admin_username = \"$_POST[admin_username]\";\n\$admin_password = \"$_POST[admin_password]\";";
		$new_entry = $new_entry . "\n\n\$font_colour = \"#000000\";\n\$font_face = \"Verdana,Arial,Sans-Serif\";\n\$font_size = \"9\";";
		$new_entry = $new_entry . "\n\n\$bold = \"0\";\n\$italic = \"1\";\n\$underline = \"0\";\n\n?>";

		$fl=fopen("trainlog_variables.php","w"); 
		if (!fwrite($fl,$new_entry)){
			echo"<p align='left' class='prose'>Sorry, an error occured when trying to edit the <i>trainlog_variables.php</i> file. Please make certain that <i>trainlog_install.php</i> is in the same directory as <i>trainlog_variables.php</i>, and that <i>trainlog_variables.php</i> is chmoded to 666. Then, please go back and try again.</p>"; admin_footer(); exit;
		}
		fclose($fl);

		echo"<p align='left' class='prose'>";

		$conn = mysql_connect("$_POST[db_location]","$_POST[db_username]","$_POST[db_password]"); 
		if (!$conn) die("Error: " . mysql_error()); 
		mysql_select_db($_POST[db_database],$conn) or die("Error: " . mysql_error());

		if(mysql_query("CREATE TABLE IF NOT EXISTS ".$_POST[db_prefix]."entry (uin int(11) NOT NULL auto_increment, date text NOT NULL, name text NOT NULL, dist float NOT NULL default '0', time text NOT NULL, weight text NOT NULL, notes text NOT NULL, type text NOT NULL, KEY uin (uin)) TYPE=MyISAM")){echo"Congratulations, the TrainLog script has been installed successfully. Please now DELETE <i>trainlog_install.php</i> from your server.<br /><br /><a href='trainlog_admin.php'>Click here</a> to proceed to the administration area.<br />";}else{echo"Error: TrainLog MySQL database table not created.<br />";}

		mysql_close();

		echo"</p>";

		admin_footer();

	break;
}

?>
